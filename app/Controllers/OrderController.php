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

            header("Location:index.php?page=customers");
            exit;
        }

        $customerModel = new Customer();
        $garmentModel  = new GarmentType();

        $customer = $customerModel->find($_GET['customer_id']);

        if (!$customer) {

            $this->redirectWithMessage(
                "customers",
                "danger",
                "Customer not found."
            );

            return;
        }

        $garments = $garmentModel->getActive();

        $this->view(
            "orders/create",
            [
                "customer"  => $customer,
                "garments"  => $garments
            ]
        );
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $validator = new Validator();

            $validator
                ->required("customer_id", $_POST['customer_id'], "Customer")
                ->required("garment_type_id",$_POST['garment_type_id'],"Garment Type")
                ->required("quantity", $_POST['quantity'], "Quantity")
                ->required("booking_no", $_POST['booking_no'], "Booking Number")
                ->required("order_date", $_POST['order_date'], "Order Date")
                ->required("delivery_date", $_POST['delivery_date'], "Delivery Date")
                ->required("total_amount", $_POST['total_amount'], "Total Amount")

                ->numeric("quantity", $_POST['quantity'], "Quantity")
                ->numeric("total_amount", $_POST['total_amount'], "Total Amount")

                ->min("quantity", $_POST['quantity'], 1, "Quantity")
                ->min("total_amount", $_POST['total_amount'], 1, "Total Amount");

            // Optional Fields
            if (!empty($_POST['advance'])) {
                $validator
                    ->numeric("advance", $_POST['advance'], "Advance")
                    ->min("advance", $_POST['advance'], 0, "Advance");
            }

            if (!empty($_POST['discount'])) {
                $validator
                    ->numeric("discount", $_POST['discount'], "Discount")
                    ->min("discount", $_POST['discount'], 0, "Discount");
            }

            if ($validator->hasErrors())
            {
                OldInput::set($_POST);

                $this->redirectWithMessage(
                    "create-order&customer_id=" . $_POST['customer_id'],
                    "danger",
                    $validator->first()
                );
            }

           try {

            $order = new Order();

            $orderId = $order->create($_POST);

            OldInput::clear();

            $this->redirectWithMessage(
                "create-measurement&order_id=".$orderId,
                "success",
                "📦 Order Created Successfully."
            );

            } catch (PDOException $e) {

                OldInput::set($_POST);

                if ($e->getCode() == 23000) {

                    $this->redirectWithMessage(
                        "create-order&customer_id=".$_POST["customer_id"],
                        "danger",
                        "Booking number already exists. Please create the order again."
                    );

                } else {

                    throw $e;
                }
            }
        }
    }

    public function index()
    {
        $order = new Order();

        if (!empty($_GET['status'])) {

            $orders = $order->getByStatus($_GET['status']);

        } else {

            $orders = $order->getAll();

        }

        $this->view('orders/index', compact('orders'));
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

        $existing = $order->find($_POST['id']);

        $_POST['garment_type_id'] = $existing['garment_type_id'];
        $order->update(
            $_POST['id'],
            $_POST
        );
      $this->redirectWithMessage(
        "orders",
        "success",
        "📦 Order Updated Successfully."
        );
    }

    public function delete()
    {
        $order = new Order();

        $order->delete($_GET['id']);

      $this->redirectWithMessage(
        "orders",
        "danger",
        "🗑 Order delelted Successfully."
        );
        
}
}