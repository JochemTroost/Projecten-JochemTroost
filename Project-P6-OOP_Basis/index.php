<?php
session_start();

// Smarty setup
require_once 'vendor/autoload.php'; // Als je Composer gebruikt
//  require_once 'vendor/smarty/smarty/libs/Smarty.class.php'; Als je Smarty handmatig hebt gedownload

use Smarty\Smarty;

// Include alle classes
require_once 'src/Product.php';
require_once 'src/ShoppingCart.php';
require_once 'src/Order.php';

// Smarty initialiseren


$smarty = new Smarty();
$smarty->setTemplateDir('templates/');
$smarty->setCompileDir('templates_c/');

// URL parameters ophalen
$page = $_GET['page'] ?? 'home';
$action = $_GET['action'] ?? '';

// Shopping cart instance maken (Student B)
//$cart = new ShoppingCart();

// ACTIONS - Deze worden eerst uitgevoerd voordat pagina's getoond worden
if ($action) {
    switch ($action) {
        // Student B - Cart Actions
        case 'add_to_cart':
            $productId = $_GET['product_id'] ?? '';
            if ($productId) {
                $cart->addItem($productId);
                // Redirect om dubbele form submissions te voorkomen
                header('Location: index.php?page=cart');
                exit;
            }
            break;

        case 'remove_from_cart':
            $productId = $_GET['product_id'] ?? '';
            if ($productId) {
                $cart->removeItem($productId);
                header('Location: index.php?page=cart');
                exit;
            }
            break;

        case 'update_cart':
            $productId = $_GET['product_id'] ?? '';
            $quantity = (int)($_GET['quantity'] ?? 0);
            if ($productId && $quantity >= 0) {
                $cart->updateQuantity($productId, $quantity);
                header('Location: index.php?page=cart');
                exit;
            }
            break;

        case 'clear_cart':
            $cart->clearCart();
            header('Location: index.php');
            exit;
            break;

        // Student C - Order Actions
        case 'place_order':
            // POST data verwerken van checkout formulier
            if ($_POST) {
                // Valideer form data
                $customerInfo = [
                    'name' => $_POST['name'] ?? '',
                    'email' => $_POST['email'] ?? '',
                    'phone' => $_POST['phone'] ?? '',
                    'address' => $_POST['address'] ?? '',
                    'city' => $_POST['city'] ?? '',
                    'postal_code' => $_POST['postal_code'] ?? ''
                ];

                // Hier zou Student C validatie logica toevoegen
                // Als validatie OK:
                $order = new Order();
                $orderId = $order->createOrder($customerInfo, $cart->getItems());

                if ($orderId) {
                    $cart->clearCart(); // Cart legen na succesvolle order
                    header('Location: index.php?page=order_success&order_id=' . $orderId);
                    exit;
                }
            }
            // Als er een fout is, terug naar checkout
            header('Location: index.php?page=checkout&error=1');
            exit;
            break;
    }
}

// PAGES - Hier worden de verschillende pagina's getoond
switch ($page) {
    // Student A - Product Pages
    case 'productList':
//        // Alle producten laden en tonen
       $products = Product::getAllProducts();
       $smarty->assign('products', $products);
       $smarty->display('product_list.tpl');
       break;

    case 'product':
        // Specifiek product tonen
        $productId = $_GET['id'] ?? '';
       $product = Product::getProductById($productId);
       $smarty->assign('product', $product);
       $smarty->display('product_detail.tpl');
       break;

    // Student B - Cart Page
    case 'cart':
        // Winkelwagen tonen
//        $cartItems = $cart->getItems();
//        $cartTotal = $cart->getTotal();
//        $itemCount = $cart->getItemCount();

//        $smarty->assign('cart_items', $cartItems);
//        $smarty->assign('cart_total', $cartTotal);
//        $smarty->assign('item_count', $itemCount);
//        $smarty->display('cart.tpl');
        break;

    // Student C - Order Pages
    case 'checkout':
        // Checkout formulier tonen
//        $cartItems = $cart->getItems();
//        $cartTotal = $cart->getTotal();

        // Check of cart niet leeg is
        if (empty($cartItems)) {
            header('Location: index.php?page=cart');
            exit;
        }

//        $smarty->assign('cart_items', $cartItems);
//        $smarty->assign('cart_total', $cartTotal);
//        $smarty->assign('error', $_GET['error'] ?? '');
//        $smarty->display('checkout.tpl');
        break;

    case 'order_success':
        // Order bevestiging tonen
        $orderId = $_GET['order_id'] ?? '';
        if ($orderId) {
            $order = Order::getOrderById($orderId);
            $smarty->assign('order', $order);
            $smarty->assign('order_id', $orderId);
        }
        $smarty->display('order_confirmation.tpl');
        break;

    // Default - redirect naar home
    case 'home':
    default:
        $smarty->display('home.tpl');
        break;
}
