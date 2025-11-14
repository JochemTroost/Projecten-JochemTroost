<?php
// index.php
declare(strict_types=1);
ini_set('display_errors','1');
error_reporting(E_ALL);

session_start();
require __DIR__ . '/vendor/autoload.php';

use Smarty\Smarty;
use App\Controllers\ShopController;
use App\Controllers\AttractionsController;
use App\Controllers\EmployeeController;
use App\Controllers\RosterController;
use App\Controllers\VisitorController;

// Controllers
$shopController        = new ShopController();
$attractionController  = new AttractionsController();
$visitorController     = new VisitorController();

// Smarty
$smarty = new Smarty();
$smarty->setTemplateDir(__DIR__ . '/app/Views');
$smarty->setCompileDir(__DIR__ . '/var/smarty/compile');
$smarty->setCacheDir(__DIR__ . '/var/smarty/cache');

// Flash
$message = $_SESSION['message'] ?? '';
$error   = $_SESSION['error'] ?? '';
unset($_SESSION['message'], $_SESSION['error']);
$smarty->assign('message', $message);
$smarty->assign('error', $error);

// Shop data
$shopTypes = [
    '00100'=>'Souvenir Shop','00200'=>'Food & Drinks','00300'=>'Clothing','00400'=>'Electronics','00500'=>'Toy Shop',
    '00600'=>'Bookstore','00700'=>'Candy & Sweets','00800'=>'Sports Shop','00900'=>'Art & Crafts','01000'=>'Convenience'
];
$shopLocations = [
    '01'=>'Entree','02'=>'Hotel & Resort','03'=>'Sprookjesbos','04'=>'Anderrijk','05'=>'Ruigrijk',
    '06'=>'Fantasierijk','07'=>'Rijzenrijk','08'=>'Marenrijk','09'=>'Evenement'
];
$smarty->assign('shopTypes', $shopTypes);
$smarty->assign('shopLocations', $shopLocations);

// Ticket types
$ticketTypes = [
    'Standaard' => 35.00,
    'Kind'      => 25.00,
    'Senior'    => 30.00,
    'VIP'       => 55.00
];
$smarty->assign('ticketTypes', $ticketTypes);

// Router
$page = $_GET['page'] ?? 'home';

// ------- SHOP: POST handlers -------
if ($page === 'addShop' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $typeCode = trim($_POST['type_code'] ?? '');
    $typeName = $shopTypes[$typeCode] ?? '';
    $revenue = (float)($_POST['revenue'] ?? 0.0);
    $location = trim($_POST['location'] ?? '');
    $size = (int)($_POST['size'] ?? 0);
    $rating = (int)($_POST['rating'] ?? 0);

    if ($name !== '' && $typeCode !== '') {
        $shopController->addShop($name, $typeCode, $typeName, $location, $size, $rating);
        $_SESSION['message'] = 'Shop added successfully!';
    } else {
        $_SESSION['error'] = 'Name and Type are required.';
    }
    header('Location: index.php?page=addShop'); exit;
}

if ($page === 'editShop' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $shopId = (int)($_GET['id'] ?? 0);
    $shop = $shopController->getShop($shopId);

    if ($shop) {

        if (isset($_POST['delete'])) {
            $shopController->deleteShop($shopId);
            $_SESSION['message'] = 'Shop verwijderd!';
            header('Location: index.php?page=shopList'); exit;
        }
        $name = trim($_POST['name'] ?? '');
        $typeCode = trim($_POST['type_code'] ?? '');
        $typeName = $shopTypes[$typeCode] ?? '';
        $revenue = (float)($_POST['revenue'] ?? 0.0);
        $location = trim($_POST['location'] ?? '');
        $size = (int)($_POST['size'] ?? 0);
        $rating = (int)($_POST['rating'] ?? 0);

        if ($name !== '' && $typeCode !== '') {
            $shopController->updateShop($shopId, $name, $typeCode, $typeName, $location, $size, $rating);
            $_SESSION['message'] = 'Shop updated successfully!';
        } else {
            $_SESSION['error'] = 'Name and Type are required.';
        }
        header("Location: index.php?page=editShop&id={$shopId}"); exit;
    }
    $_SESSION['error'] = 'Shop niet gevonden.'; header('Location: index.php?page=shopList'); exit;
}

// ------- ATTRACTION: POST handlers -------
if ($page === 'addAttraction' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = trim($_POST['name'] ?? '');
    $capacity = (int)($_POST['capacity'] ?? 0);
    $status   = trim($_POST['status'] ?? '');
    $waitTime = (int)($_POST['wait_time'] ?? 0);

    try {
        $attractionController->addAttraction($name, $capacity, $status, $waitTime);
        $_SESSION['message'] = 'Attractie toegevoegd!';
        header('Location: index.php?page=attractionList', true, 303);
        exit;
    } catch (\InvalidArgumentException $e) {
        $errs = json_decode($e->getMessage(), true);
        $_SESSION['error'] = is_array($errs) ? implode(' | ', array_values($errs)) : 'Ongeldige invoer.';

        $_SESSION['old_attraction'] = [
            'name'      => $name,
            'capacity'  => $capacity,
            'status'    => $status,
            'wait_time' => $waitTime,
        ];

        header('Location: index.php?page=addAttraction', true, 303);
        exit;
    }
}

if ($page === 'editAttraction' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_GET['id'] ?? 0);
    $a  = $attractionController->getAttraction($id);

    if ($a) {
        if (isset($_POST['delete'])) {
            $attractionController->deleteAttraction($id);
            $_SESSION['message'] = 'Attractie verwijderd!';
            header('Location: index.php?page=attractionList'); exit;
        }
        $name     = trim($_POST['name'] ?? '');
        $capacity = (int)($_POST['capacity'] ?? 0);
        $status   = trim($_POST['status'] ?? '');
        $waitTime = (int)($_POST['wait_time'] ?? 0);

        try {
            $attractionController->updateAttraction($id, $name, $capacity, $status, $waitTime);
            $_SESSION['message'] = 'Wijzigingen opgeslagen.';
        } catch (\InvalidArgumentException $e) {
            $errs = json_decode($e->getMessage(), true);
            $_SESSION['error'] = is_array($errs) ? implode(' | ', array_values($errs)) : 'Ongeldige invoer.';
        }
        header("Location: index.php?page=editAttraction&id={$id}"); exit;
    }
    $_SESSION['error'] = 'Attractie niet gevonden.'; header('Location: index.php?page=attractionList'); exit;
}

// ------- VISITORS: POST handlers -------
if ($page === 'reserveTicket' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name       = trim($_POST['name'] ?? '');
    $email      = trim($_POST['email'] ?? '');
    $visitDate  = $_POST['visit_date'] ?? '';
    $ticketType = $_POST['ticket_type'] ?? '';
    $persons    = (int)($_POST['persons'] ?? 1);

    $pricePer   = $ticketTypes[$ticketType] ?? 0.0;
    $totalPrice = $pricePer * $persons;
    $ticketNumber = uniqid('TICKET-');

    if ($name && $email && $visitDate && $ticketType) {
        $visitorController->addVisitor($name, $email, $ticketNumber, $visitDate, $ticketType, $persons, $totalPrice);
        $_SESSION['message'] = "Ticket succesvol gereserveerd! Nummer: $ticketNumber<br>Totaalprijs: €" . number_format($totalPrice, 2, ',', '.');
    } else {
        $_SESSION['error'] = 'Alle velden zijn verplicht!';
    }
    header('Location: index.php?page=reserveTicket'); exit;
}

if ($page === 'visitorList' && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $deleteId = (int)$_POST['delete_id'];
    if ($deleteId > 0) {
        $visitorController->deleteVisitor($deleteId);
        $_SESSION['message'] = 'Reservering verwijderd!';
    } else {
        $_SESSION['error'] = 'Ongeldige ID!';
    }
    header('Location: index.php?page=visitorList'); exit;
}

// ------- Prefetch lists -------
if ($page === 'shopList') {
    $smarty->assign('shops', $shopController->getShops());
}
if ($page === 'attractionList') {
    $smarty->assign('attractions', $attractionController->getAttractions());
}

// ------- Render -------
switch ($page) {
    default:
        $smarty->display('home.tpl'); break;

    // Shops
    case 'addShop':
        $smarty->display('addShop.tpl'); break;

    case 'shopList':
        $smarty->display('shops.tpl'); break;

    case 'viewShop':
        $shopId = (int)($_GET['id'] ?? 0);
        $smarty->assign('shop', $shopController->getShop($shopId));
        $smarty->display('viewShop.tpl'); break;

    case 'editShop':
        $shopId = (int)($_GET['id'] ?? 0);
        $smarty->assign('shop', $shopController->getShop($shopId));
        $smarty->display('editShop.tpl'); break;

    // Attractions
    case 'attractionList':
        $smarty->display('attractions/list.tpl'); break;

    case 'addAttraction':
        $smarty->assign('isEdit', false);
        $smarty->display('attractions/form.tpl'); break;

    case 'editAttraction':
        $id = (int)($_GET['id'] ?? 0);
        $smarty->assign('attraction', $attractionController->getAttraction($id));
        $smarty->assign('isEdit', true);
        $smarty->display('attractions/form.tpl'); break;

    // Visitors
    case 'reserveTicket':
        $smarty->display('reserveTicket.tpl'); break;

    case 'visitorList':
        $search = trim($_GET['search'] ?? '');
        $visitors = $visitorController->getVisitors();

        // Filter op naam
        if ($search !== '') {
            $visitors = array_filter($visitors, fn($v) => stripos($v->name, $search) !== false);
        }

        // Sorteer recentste bezoek eerst
        usort($visitors, fn($a, $b) => strcmp($b->visitDate, $a->visitDate));

        $smarty->assign('visitors', $visitors);
        $smarty->assign('search', $search);
        $smarty->display('visitorList.tpl');
        break;

    case 'visitorStats':
        $stats = $visitorController->getMonthlyStats();
        $smarty->assign('stats', $stats);
        $smarty->display('visitorStats.tpl'); break;

    case 'monthlyStats':
        $currentYear  = date('Y');
        $currentMonth = date('m');
        $year  = (int)($_GET['year'] ?? $currentYear);
        $month = (int)($_GET['month'] ?? $currentMonth);
        $stats = $visitorController->getStatsByMonth($year, $month);
        $months = [1=>'Januari',2=>'Februari',3=>'Maart',4=>'April',5=>'Mei',6=>'Juni',7=>'Juli',8=>'Augustus',9=>'September',10=>'Oktober',11=>'November',12=>'December'];
        $years  = range(2020, (int)$currentYear + 5);
        $smarty->assign(compact('stats','year','month','months','years'));
        $smarty->display('monthlyStats.tpl'); break;

    // Employees
    case 'employees': {
        $action     = $_GET['a'] ?? 'index';
        $controller = new EmployeeController($smarty);

        if     ($action === 'index') { $controller->index();  exit; }
        elseif ($action === 'create' && $_SERVER['REQUEST_METHOD'] === 'GET')  { $controller->create(); exit; }
        elseif ($action === 'store'  && $_SERVER['REQUEST_METHOD'] === 'POST') { $controller->store($_POST); exit; }
        elseif ($action === 'edit'   && isset($_GET['id'])) { $controller->edit((int)$_GET['id']); exit; }
        elseif ($action === 'update' && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) { $controller->update((int)$_GET['id'], $_POST); exit; }
        elseif ($action === 'delete' && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) { $controller->delete((int)$_GET['id']); exit; }

        http_response_code(404); echo 'Niet gevonden'; exit;
    }

    // Roster
    case 'roster': {
        $action     = $_GET['a'] ?? 'index';
        $controller = new RosterController($smarty);
        if ($action === 'index') { $controller->index(); exit; }
        http_response_code(404); echo 'Niet gevonden'; exit;
    }
}
