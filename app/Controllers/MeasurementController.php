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

        // Separate measurements by category
        $qameesMeasurements = [];
        $shalwarMeasurements = [];

        foreach ($types as $type) {

            switch ($type['category']) {

            case 'Shirt':
                $qameesMeasurements[] = $type;
                break;

            case 'Trouser':
                $shalwarMeasurements[] = $type;
                break;
        }
    }

    $this->view(
        'measurements/create',
        compact(
            'order',
            'qameesMeasurements',
            'shalwarMeasurements',
            'options'
        )
    );
    }

   public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $validator = new Validator();

            $validator
                ->required(
                    "order_id",
                    $_POST['order_id'],
                    "Order"
                );

            // Check if at least one measurement is entered
            $hasMeasurement = false;

            if (!empty($_POST['measurements']) && is_array($_POST['measurements']))
            {
                foreach ($_POST['measurements'] as $value)
                {
                    if (trim($value) !== "")
                    {
                        $hasMeasurement = true;
                        break;
                    }
                }
            }

            if (!$hasMeasurement)
            {
                OldInput::set($_POST);

                $this->redirectWithMessage(

                    "measurement-create&order_id=" . $_POST['order_id'],

                    "danger",

                    "Please enter at least one measurement."

                );
            }

            if ($validator->hasErrors())
            {
                OldInput::set($_POST);

                $this->redirectWithMessage(

                    "measurement-create&order_id=" . $_POST['order_id'],

                    "danger",

                    $validator->first()

                );
            }

            $measurement = new Measurement();

            $measurement->save(

                $_POST['order_id'],

                $_POST['measurements'] ?? []

            );

            $options = $_POST['options'] ?? [];

            if (!empty($_POST['options_radio'])) {

                foreach ($_POST['options_radio'] as $value) {

                    $options[] = $value;

                }
            }

            $measurement->saveOptions(
                $_POST['order_id'],
                $options
            );

            OldInput::clear();

            $this->redirectWithMessage(

                "customers",

                "success",

                "📏 Measurements saved successfully."

            );
        }
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
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $validator = new Validator();

            $validator->required(
                "order_id",
                $_POST['order_id'],
                "Order"
            );

            // Check if at least one measurement is entered
            $hasMeasurement = false;

            if (!empty($_POST['measurements']) && is_array($_POST['measurements']))
            {
                foreach ($_POST['measurements'] as $value)
                {
                    if (trim($value) !== "")
                    {
                        $hasMeasurement = true;
                        break;
                    }
                }
            }

            if (!$hasMeasurement)
            {
                OldInput::set($_POST);

                $this->redirectWithMessage(

                    "edit-measurement&order_id=" . $_POST['order_id'],

                    "danger",

                    "Please enter at least one measurement."

                );
            }

            if ($validator->hasErrors())
            {
                OldInput::set($_POST);

                $this->redirectWithMessage(

                    "edit-measurement&order_id=" . $_POST['order_id'],

                    "danger",

                    $validator->first()

                );
            }

            $measurement = new Measurement();

            $measurement->update(

                $_POST['order_id'],

                $_POST['measurements']

            );

            $measurement->updateOptions(

                $_POST['order_id'],

                $_POST['options'] ?? []

            );

            OldInput::clear();

            $this->redirectWithMessage(

                "view-order&id=" . $_POST['order_id'],

                "success",

                "✅ Measurement updated successfully."

            );
        }
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