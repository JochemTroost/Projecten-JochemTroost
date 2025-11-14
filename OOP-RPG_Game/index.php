<?php
require_once 'vendor/autoload.php';

use Game\Character;
use Game\Warrior;
use Game\Mage;
use Game\Rogue;
use Game\Healer;
use Game\Tank;
use Game\CharacterList;
use Game\Battle;
use Game\Item;
use Game\ItemList;
use Game\Mysql;
use Game\DatabaseManager;
use Dotenv\Dotenv;
use Smarty\Smarty;
use PDOException;

session_start();

// Load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Initialize Smarty
$template = new Smarty();
$template->setTemplateDir('templates')->setCompileDir('templates_c');

// Initialize Character session
Character::initializeSession();

// Load CharacterList from session or create new
if (isset($_SESSION['characters']) && $_SESSION['characters'] instanceof CharacterList) {
    $characterList = $_SESSION['characters'];
} else {
    $characterList = new CharacterList();
    $_SESSION['characters'] = $characterList;
}

// Initialize database connection
try {
    $database = new Mysql(
        $_ENV['DB_HOST'],
        $_ENV['DB_NAME'],
        $_ENV['DB_USER'],
        $_ENV['DB_PASS']
    );
    DatabaseManager::setInstance($database);
} catch (PDOException $e) {
    $dbConnectionError = $e->getMessage();
}

$page = $_GET['page'] ?? 'home';

switch ($page) {

    // ---------------- Characters ----------------
    case 'createCharacter':
        $template->display('createCharacterForm.tpl');
        break;

    case 'saveCharacter':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $role = $_POST['role'] ?? '';
            $health = (int)($_POST['health'] ?? 0);
            $defence = (int)($_POST['defence'] ?? 0);
            $range = (int)($_POST['range'] ?? 1);
            $attack = (int)($_POST['attack'] ?? 2);

            switch ($role) {
                case 'Warrior':
                    $character = new Warrior();
                    $character->setCharacter($name, $role, $health, $defence, $range, $attack);
                    if (!empty($_POST['rage'])) $character->setRage((int)$_POST['rage']);
                    break;
                case 'Mage':
                    $character = new Mage();
                    $character->setCharacter($name, $role, $health, $defence, $range, $attack);
                    if (!empty($_POST['mana'])) $character->setMana((int)$_POST['mana']);
                    break;
                case 'Rogue':
                    $character = new Rogue();
                    $character->setCharacter($name, $role, $health, $defence, $range, $attack);
                    if (!empty($_POST['energy'])) $character->setEnergy((int)$_POST['energy']);
                    break;
                case 'Healer':
                    $character = new Healer();
                    $character->setCharacter($name, $role, $health, $defence, $range, $attack);
                    if (!empty($_POST['spirit'])) $character->setSpirit((int)$_POST['spirit']);
                    break;
                case 'Tank':
                    $shield = (int)($_POST['shield'] ?? 50);
                    $character = new Tank($name, $role, $health, $attack, $defence, $range, $shield);
                    break;
                default:
                    die("Error: Invalid role selected.");
            }

            $characterList->addCharacter($character);
            $_SESSION['characters'] = $characterList;
        }

        $template->assign('characterList', $characterList->getCharacters());
        $template->display('characterList.tpl');
        break;

    case 'characterList':
        $template->assign('characterList', $characterList->getCharacters());
        $template->display('characterList.tpl');
        break;

    case 'viewCharacter':
        if (isset($_GET['name'])) {
            $character = $characterList->getCharacter($_GET['name']);
            if ($character instanceof Character) {
                $template->assign('character', $character);
                $template->display('character.tpl');
            } else {
                echo $character;
            }
        }
        break;

    case 'deleteCharacter':
        if (isset($_GET['name'])) {
            $character = $characterList->getCharacter($_GET['name']);
            if ($character instanceof Character) {
                $characterList->removeCharacter($character);
                $_SESSION['characters'] = $characterList;
            }
            header("Location: index.php?page=characterList");
            exit;
        }
        break;

    // ---------------- Battle ----------------
    case 'battleForm':
        $template->assign('characterList', $characterList->getCharacters());
        $template->display('battleForm.tpl');
        break;

    case 'battleStart':
        $fighter1 = $characterList->getCharacter($_POST['fighter1'] ?? '');
        $fighter2 = $characterList->getCharacter($_POST['fighter2'] ?? '');
        if (!$fighter1 || !$fighter2) die("Error: Invalid fighters.");

        $battle = new Battle();
        $battle->setAttackForFighter($fighter1, null);
        $battle->setAttackForFighter($fighter2, null);

        $fighter1->resetTempStats();
        $fighter2->resetTempStats();

        $_SESSION['battle'] = $battle;
        $_SESSION['fighter1'] = $fighter1;
        $_SESSION['fighter2'] = $fighter2;

        $template->assign('fighter1', $fighter1);
        $template->assign('fighter2', $fighter2);
        $template->assign('battleLog', $battle->getBattleLog());
        $template->display('battleResult.tpl');
        break;

    case 'battleRound':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!isset($_SESSION['battle'], $_SESSION['fighter1'], $_SESSION['fighter2'])) die("Error: Battle not initialized.");

            $battle = $_SESSION['battle'];
            $fighter1 = $_SESSION['fighter1'];
            $fighter2 = $_SESSION['fighter2'];

            $attack1 = $_POST['fighter1Attack'] ?? null;
            $attack2 = $_POST['fighter2Attack'] ?? null;

            if ($attack1 === "") $attack1 = null;
            if ($attack2 === "") $attack2 = null;

            $battle->setAttackForFighter($fighter1, $attack1);
            $battle->setAttackForFighter($fighter2, $attack2);
            $battle->executeTurn($fighter1, $fighter2);

            $_SESSION['battle'] = $battle;
            $_SESSION['fighter1'] = $fighter1;
            $_SESSION['fighter2'] = $fighter2;

            $template->assign('fighter1', $fighter1);
            $template->assign('fighter2', $fighter2);
            $template->assign('battleLog', $battle->getBattleLog());
            $template->display('battleResult.tpl');
        }
        break;

    // ---------------- Character Stats ----------------
    case 'characterStats':
        $total = Character::getTotalCharacters();
        $names = Character::getAllCharacterNames();
        $types = ['Warrior', 'Mage', 'Rogue', 'Healer', 'Tank'];
        $typeCounts = [];
        foreach ($types as $type) {
            $count = 0;
            foreach ($characterList->getCharacters() as $character) {
                if ($character->getRole() === $type) $count++;
            }
            if ($count > 0) $typeCounts[$type] = $count;
        }

        $template->assign('totalCharacters', $total);
        $template->assign('characterTypes', $typeCounts);
        $template->assign('existingNames', $names);
        $template->display('characterStatistics.tpl');
        break;

    case 'resetStats':
        Character::resetAllStatistics();
        header('Location: index.php?page=characterStats');
        exit;

    case 'recalculateStats':
        Character::recalculateStatistics($characterList);
        header('Location: index.php?page=characterStats');
        exit;

    // ---------------- Database Test ----------------
    case 'testDatabase':
        $message = "Geen database instance gevonden.";
        $status = "danger";
        if (DatabaseManager::hasInstance()) {
            $db = DatabaseManager::getInstance();
            try {
                if ($db->testConnection()) {
                    $message = "✅ Database connectie succesvol!";
                    $status = "success";
                } else {
                    $message = "⚠️ Database connectie mislukt.";
                    $status = "warning";
                }
            } catch (Exception $e) {
                $message = "❌ Fout bij verbinden: " . $e->getMessage();
                $status = "danger";
            }
        } elseif (isset($dbConnectionError)) {
            $message = "❌ Database fout: " . $dbConnectionError;
            $status = "danger";
        }
        $template->assign('message', $message);
        $template->assign('status', $status);
        $template->display('testDatabase.tpl');
        break;

    // ---------------- Items ----------------
    case 'createItem':
        $template->display('createItemForm.tpl');
        break;

    case 'saveItem':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $type = trim($_POST['type'] ?? '');
            $value = floatval($_POST['value'] ?? 0);

            if ($name === '' || $type === '' || $value < 0) {
                $error = "⚠️ Vul alle velden correct in!";
                $template->assign('error', $error);
                $template->display('createItemForm.tpl');
                break;
            }

            $item = new Item($name, $type, $value);
            try {
                if ($item->save()) {
                    $template->assign('item', $item);
                    $template->display('itemCreated.tpl');
                } else {
                    $error = "❌ Er is een fout opgetreden bij het opslaan van het item.";
                    $template->assign('error', $error);
                    $template->display('createItemForm.tpl');
                }
            } catch (Exception $e) {
                $error = "❌ Fout bij opslaan: " . $e->getMessage();
                $template->assign('error', $error);
                $template->display('createItemForm.tpl');
            }
        }
        break;

    case 'listItems':
        try {
            $itemList = new ItemList();

            $filters = [
                'id' => $_GET['id'] ?? null,
                'type' => $_GET['type'] ?? null,
                'minValue' => $_GET['minValue'] ?? null,
                'name' => $_GET['name'] ?? null,
            ];

            $filters = array_filter($filters, fn($v) => $v !== null && $v !== '');

            $itemList->loadByParams($filters);

            $template->assign('items', $itemList->getItems());
            $template->assign('itemCount', $itemList->count());
            $template->assign('selectedType', $_GET['type'] ?? '');
            $template->assign('minValue', $_GET['minValue'] ?? '');
            $template->assign('selectedId', $_GET['id'] ?? '');
            $template->assign('searchName', $_GET['name'] ?? '');
            $template->display('itemList.tpl');
        } catch (Exception $e) {
            $template->assign('error', "❌ Fout bij ophalen van items: " . $e->getMessage());
            $template->display('itemList.tpl');
        }
        break;

    // ---------------- Items Update ----------------
    case 'updateItem':
        var_dump($_GET);

        if (!isset($_GET['id'])) {
            $template->assign('error', "❌ Geen item ID opgegeven.");
            $template->display('error.tpl');
            break;
        }

        $itemId = (int)$_GET['id'];
        $item = Item::loadFromDatabase($itemId);

        if (!$item) {
            $template->assign('error', "❌ Item met ID {$itemId} bestaat niet.");
            $template->display('error.tpl');
            break;
        }

        $template->assign('item', $item);
        $template->display('updateItemForm.tpl');
        break;

    case 'saveItemUpdate':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $template->assign('error', "❌ Ongeldige request methode.");
            $template->display('error.tpl');
            break;
        }

        $id = (int)($_POST['id'] ?? 0);
        $name = trim($_POST['name'] ?? '');
        $type = trim($_POST['type'] ?? '');
        $value = floatval($_POST['value'] ?? 0);

        if (!$id || $name === '' || $type === '') {
            $template->assign('error', "❌ Alle velden zijn vereist.");
            $template->display('error.tpl');
            break;
        }

        $item = Item::loadFromDatabase($id);
        if (!$item) {
            $template->assign('error', "❌ Item bestaat niet.");
            $template->display('error.tpl');
            break;
        }

        $updatedItem = new Item($name, $type, $value, $id);
        if (in_array($type, ['weapon','armor','consumable'])) {
            $updatedItem->attackBonus = (int)($_POST['attackBonus'] ?? 0);
            $updatedItem->defenseBonus = (int)($_POST['defenseBonus'] ?? 0);
        }
        if ($type === 'consumable') {
            $updatedItem->healthBonus = (int)($_POST['healthBonus'] ?? 0);
            $updatedItem->specialEffect = $_POST['specialEffect'] ?? '';
        }

        if ($updatedItem->update()) {
            $template->assign('item', $updatedItem);
            $template->display('itemUpdated.tpl');
        } else {
            $template->assign('error', "❌ Het updaten van het item is mislukt.");
            $template->display('error.tpl');
        }
        break;

    // ---------------- Items Delete ----------------
    case 'deleteItem':
        if (!isset($_GET['id'])) {
            $template->assign('error', "❌ Geen item ID opgegeven.");
            $template->display('error.tpl');
            break;
        }

        $itemId = (int)$_GET['id'];
        $item = Item::loadFromDatabase($itemId);

        if (!$item) {
            $template->assign('error', "❌ Item met ID {$itemId} bestaat niet.");
            $template->display('error.tpl');
            break;
        }

        $template->assign('item', $item);
        $template->display('deleteItemConfirm.tpl');
        break;

    case 'deleteItemConfirmed':
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $template->assign('error', "❌ Ongeldige request methode.");
            $template->display('error.tpl');
            break;
        }

        if (!isset($_POST['id'])) {
            $template->assign('error', "❌ Geen item ID opgegeven.");
            $template->display('error.tpl');
            break;
        }

        $itemId = (int)$_POST['id'];
        $item = Item::loadFromDatabase($itemId);

        if (!$item) {
            $template->assign('error', "❌ Item met ID {$itemId} bestaat niet.");
            $template->display('error.tpl');
            break;
        }

        try {
            if ($item->delete()) {
                $template->assign('item', $item);
                $template->display('itemDeleted.tpl');
            } else {
                $template->assign('error', "❌ Het verwijderen van het item is mislukt.");
                $template->display('error.tpl');
            }
        } catch (Exception $e) {
            $template->assign('error', "❌ Fout bij verwijderen: " . $e->getMessage());
            $template->display('error.tpl');
        }
        break;

    // ---------------- Default ----------------
    default:
        $template->display('home.tpl');
        break;
}

// Save session
Character::saveSession();
