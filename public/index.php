<?php
require_once "../config/config.php";
require_once "../app/Core/Autoload.php";

$page = $_GET['page'] ?? 'login';


switch($page){

    case 'dashboard':

        $controller = new DashboardController();
        $controller->index();

        break;

    case 'logout':

        $controller = new AuthController();
        $controller->logout();

        break;

    case 'customers':

        $controller = new CustomerController();
        $controller->index();

        break;

     case 'add-customer':

            $controller = new CustomerController();
            $controller->create();

        break;

     case 'save-customer':

            $controller = new CustomerController();
            $controller->store();

        break;
            
    case 'create-order':

            $controller = new OrderController();
            $controller->create();
            break;

    case 'save-order':

            $controller = new OrderController();
            $controller->store();

        break;

    case "orders":

            (new OrderController())->index();

        break;
    case 'create-measurement':

            $controller = new MeasurementController();
            $controller->create();

        break;

    case 'save-measurements':

            $controller = new MeasurementController();
            $controller->store();

        break;

    case 'search-customer':

            $controller= new CustomerController();
            $controller->search();

        break;

    case "edit-customer":

           (new CustomerController())->edit();

        break;

    case "update-customer":

           (new CustomerController())->update();

        break;
    case "customer-profile":

           (new CustomerController())->profile();

        break; 

    case "delete-customer":

        (new CustomerController())->delete();

        break;

    case 'login':

        $controller = new AuthController();
        $controller->login();

        break;

    case "view-order":

            (new OrderController())->show();

        break;

    case "edit-order":

           (new OrderController())->edit();

        break;

    case "edit-measurement":

            (new MeasurementController())->edit();

        break;

     case "print-measurement":

           (new MeasurementController())->printSlip();

        break;

    case "update-measurement":

            (new MeasurementController())->update();

    break;

    case "delete-order":

           (new OrderController())->delete();

        break;
    case "update-order":

    (new OrderController())->update();

   break;

    default:

        $controller = new AuthController();
        $controller->login();

}