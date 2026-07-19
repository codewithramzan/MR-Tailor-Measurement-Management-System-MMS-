<?php

class OrderController extends Controller
{
    public function show()
    {
        $orderModel = new Order();

        $measurementModel = new Measurement();

        $order = $orderModel->findWithMeasurements($_GET['id']);

        $measurements = $measurementModel->getByOrder($_GET['id']);

        $this->view(
            'orders/view',
            compact(
                'order',
                'measurements'
            )
        );
    }

    public function create()
    {
        if (!isset($_GET['customer_id'])) {
                Flash::set(
                    "success",
                    "📦 Order created successfully."
                );
                header("Location:index.php?page=customers");
            exit;
        }

        $customerModel = new Customer();

        $customer = $customerModel->find($_GET['customer_id']);

        $this->view('orders/create', [

            'customer' => $customer

        ]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $order = new Order();

            $orderId = $order->create($_POST);

            header("Location:index.php?page=measurement-create&order_id=".$orderId);

            exit;
        }
    }
   public function index()
    {
        $order = new Order();

        $orders = $order->getAll();

        parent::view(
            'orders/index',
            compact('orders')
        );
    }

    public function edit()
    {
        $order = new Order();

        $data = $order->find($_GET['id']);

        parent::view(
            'orders/edit',
            compact('data')
        );
    }
  public function update()
    {
        $order = new Order();

        $order->update(
            $_POST['id'],
            $_POST
        );

        header("Location:index.php?page=orders");

        exit;
    }

    public function delete()
    {
        $order = new Order();

        $order->delete($_GET['id']);

        header("Location:index.php?page=orders");

        exit;
    }
        
}