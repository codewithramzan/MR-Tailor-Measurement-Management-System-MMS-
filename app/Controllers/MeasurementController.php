<?php

class MeasurementController extends Controller
{
    public function create()
    {
        // -----------------------------
        // Validate Order ID
        // -----------------------------
        $orderId = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);

        if (!$orderId) {

            return $this->redirectWithMessage(
                "orders",
                "danger",
                "Invalid order selected."
            );
        }

        // -----------------------------
        // Load Models
        // -----------------------------
        $orderModel        = new Order();
        $measurementModel  = new Measurement();
        $stitchingModel    = new StitchingOption();

        // -----------------------------
        // Fetch Order
        // -----------------------------
        $order = $orderModel->find($orderId);

        if (!$order) {

            return $this->redirectWithMessage(
                "orders",
                "danger",
                "Order not found."
            );
        }

        // -----------------------------
        // Fetch Measurement Types
        // -----------------------------
        $types = $measurementModel->getTypes($order['garment_type_id']);

        // -----------------------------
        // Group Measurements by Section
        // -----------------------------
        $sections = [];

        foreach ($types as $type) {

            $section = trim($type['section'] ?? '');

            if ($section === '') {
                $section = 'General';
            }

            $sections[$section][] = $type;
        }

        // -----------------------------
        // Fetch Stitching Options
        // -----------------------------
        $options = $stitchingModel->getGrouped(

            $order["garment_type_id"]

        );

        // -----------------------------
        // Render View
        // -----------------------------
        $this->view(
            'measurements/create',
            [
                'order'    => $order,
                'sections' => $sections,
                'options'  => $options
            ]
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

                "orders",

                "success",

                "📏 Measurements saved successfully."

            );
        }
    }


   public function edit()
    {
        $orderId = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);

        if (!$orderId) {

            return $this->redirectWithMessage(
                "orders",
                "danger",
                "Invalid order selected."
            );
        }

        $orderModel = new Order();
        $measurementModel = new Measurement();
        $stitchingModel = new StitchingOption();

        // Order
        $order = $orderModel->find($orderId);

        if (!$order) {

            return $this->redirectWithMessage(
                "orders",
                "danger",
                "Order not found."
            );
        }

        // Measurement fields
        $types = $measurementModel->getTypes($order['garment_type_id']);

        // Existing measurements
        $savedMeasurements = $measurementModel->getMeasurements($orderId);

        // Selected stitching options
        $selectedOptions = $measurementModel->getSelectedOptionIds($orderId);

        // Group by section
        $sections = [];

        foreach ($types as $type) {

            $section = trim($type['section'] ?? '');

            if ($section === '') {
                $section = 'General';
            }

            $sections[$section][] = $type;
        }

        // All stitching options
            $options = $stitchingModel->getGrouped(
                $order['garment_type_id']
            );

        $this->view(
            'measurements/edit',
            [
                'order' => $order,
                'sections' => $sections,
                'savedMeasurements' => $savedMeasurements,
                'selectedOptions' => $selectedOptions,
                'options' => $options
            ]
        );
    }
    


    public function updateMeasurement()
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

            $measurement->updateMeasurements(

                $_POST['order_id'],

                $_POST['measurements']

            );

            $options = $_POST['options'] ?? [];

            if (!empty($_POST['options_radio'])) {

                foreach ($_POST['options_radio'] as $value) {

                    $options[] = $value;
                }
   
                $measurement->saveOptions(
                $_POST['order_id'],
                $options
            );
            OldInput::clear();

            $this->redirectWithMessage(

                "view-order&id=" . $_POST['order_id'],

                "success",

                "✅ Measurement updated successfully."

            );
        }
    }
    }

   public function printSlip()
    {
        $measurement = new Measurement();

        $rows = $measurement->getSlip($_GET['id']);

        if (empty($rows)) {
            die("No data found.");
        }

        $options = $measurement->getOptions($_GET['id']);

        $this->view(
            'measurements/print',
            compact(
                'rows',
                'options'
            )
        );
    }
}
