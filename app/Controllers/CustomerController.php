<?php

class CustomerController extends Controller
{
    public function index()
    {
        $customer = new Customer();

        $customers = $customer->getAll();

        $this->view('customers/index', compact('customers'));
    }

    public function create()
      {
          $customer = new Customer();

          $bookingNo = $customer->generateBookingNo();

          $this->view('customers/create', [
              'bookingNo' => $bookingNo
          ]);
    }

  public function store()
    {
        if($_SERVER['REQUEST_METHOD']=="POST"){

            $customer = new Customer();

            $id = $customer->create($_POST);
             Flash::set(
            "success",
            "✅ Customer added successfully."
            );
           // Temporary redirect
          header("Location: index.php?page=customers");
          exit;
        } else{
         Flash::set(
            "danger",
            "Phone number is required."
            );

            header("Location:index.php?page=add-customer");
            exit;   
        }
 
    }

    public function search()
    {
        $customers = [];

        if(isset($_GET['keyword'])){

            $customer = new Customer();

            $customers = $customer->search($_GET['keyword']);
        }

        $this->view('customers/search',[
            'customers'=>$customers
        ]);
        }
        public function edit()
        {
            $model = new Customer();

            $customer = $model->find($_GET['id']);

            $this->view('customers/edit', [
                'customer' => $customer
            ]);
        }

        public function update()
        {
            $customer = new Customer();

            $customer->update(
                $_POST['id'],
                $_POST
            );
            Flash::set(
                "success",
                "✏️ Customer updated successfully."
            );
            header("Location:index.php?page=customers");

            exit;
        }

        public function delete()
        {
            $customer=new Customer();

            $customer->delete($_GET['id']);
            Flash::set(
                "danger",
                "🗑 Customer deleted successfully."
            );
            header("Location:index.php?page=customers");

            exit;
        }
}