<?php

class MeasurementController extends Controller
{
   public function create()
{
    if (!isset($_GET['order_id'])) {

        header("Location:index.php?page=customers");
        exit;

    }
    $optionModel = new StitchingOption();

    $orderModel = new Order();

    $measurementModel = new Measurement();

    $options = $optionModel->getGrouped();

    $order = $orderModel->find($_GET['order_id']);

    if (!$order) {

        header("Location:index.php?page=customers");
        exit;

    }

    $types = $measurementModel->getTypes($order['garment_type']);

    $this->view(
        'measurements/create',
        compact('order', 'types','options')
    );
}

    public function store()
    {
        $measurement = new Measurement();

        $measurement->save(

            $_POST['order_id'],

            $_POST['measurements']

        );
        $measurement->saveOptions(

        $_POST['order_id'],

        $_POST['options'] ?? []

    );

        header("Location:index.php?page=dashboard");

        exit;
    }


   public function edit()
    {
        $orderId=$_GET['order_id'];

        $measurement=new Measurement();

        $orderModel=new Order();

        $stitching=new StitchingOption();

        $order=$orderModel->find($orderId);

        $types=$measurement->getTypes(

            $order['garment_type']

        );

        $values=$measurement->getMeasurements(

            $orderId

        );

        $selected=$measurement->getSelectedOptions(

            $orderId

        );

        $options=$stitching->getGrouped();

        $this->view(

            'measurements/edit',

            compact(

                'order',

                'types',

                'values',

                'selected',

                'options'

            )

        );
    }


   public function update()
    {
        $measurement=new Measurement();

        $measurement->updateMeasurements(

            $_POST['order_id'],

            $_POST['measurements']

        );

        $measurement->saveOptions(

            $_POST['order_id'],

            $_POST['options'] ?? []

        );

        header(

            "Location:index.php?page=view-order&id=".$_POST['order_id']

        );

        exit;
    }

    public function printSlip()
        {
            $measurement = new Measurement();

            $rows = $measurement->getSlip($_GET['id']);

            if(empty($rows)){
                die("No data found.");
            }

            // Selected options for this order
            $options = $measurement->getOptions($_GET['id']);

            // All available options
            $stitching = new StitchingOption();

            $allOptions = $stitching->getGrouped();

            $this->view(
                'measurements/print',
                compact(
                    'rows',
                    'options',
                    'allOptions'
                )
            );
        }
}