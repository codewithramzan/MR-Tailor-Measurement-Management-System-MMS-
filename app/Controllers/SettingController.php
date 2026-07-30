<?php

class SettingController extends Controller
{
    private $settingModel;

    public function __construct()
    {
        $this->settingModel = new Setting();
    }

    /**
     * Display Settings Page
     */
    public function index()
    {
        $settings = $this->settingModel->getSettings();

        $this->view(
            "settings/index",
            [
                "settings" => $settings
            ]
        );
    }

    /**
     * Save Settings
     */
    public function update()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            header("Location: index.php?page=settings");
            exit;
        }

        $settings = $this->settingModel->getSettings();

        $logo = $settings["logo"] ?? null;

        /*
        |--------------------------------------------------------------------------
        | Logo Upload
        |--------------------------------------------------------------------------
        */

        if (
            isset($_FILES["logo"]) &&
            $_FILES["logo"]["error"] === UPLOAD_ERR_OK
        ) {

            $allowed = ["jpg", "jpeg", "png", "webp"];

            $extension = strtolower(
                pathinfo(
                    $_FILES["logo"]["name"],
                    PATHINFO_EXTENSION
                )
            );

            if (!in_array($extension, $allowed)) {

                $_SESSION["flash"] = [

                    "type" => "danger",

                    "message" => "Only JPG, PNG and WEBP images are allowed."

                ];

                header("Location: index.php?page=settings");
                exit;
            }

            /*
            |--------------------------------------------------------------------------
            | Upload Directory
            |--------------------------------------------------------------------------
            */

            $uploadDir = dirname(__DIR__, 2)
                . "/public/uploads/logo/";

            if (!is_dir($uploadDir)) {

                mkdir($uploadDir, 0777, true);
            }

            /*
            |--------------------------------------------------------------------------
            | Generate Unique Name
            |--------------------------------------------------------------------------
            */

            $logo = "logo_" . time() . "." . $extension;

            move_uploaded_file(

                $_FILES["logo"]["tmp_name"],

                $uploadDir . $logo
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Update Database
        |--------------------------------------------------------------------------
        */

        $data = [

            "shop_name" => trim($_POST["shop_name"] ?? ""),

            "owner_name" => trim($_POST["owner_name"] ?? ""),

            "phone" => trim($_POST["phone"] ?? ""),

            "email" => trim($_POST["email"] ?? ""),

            "website" => trim($_POST["website"] ?? ""),

            "address" => trim($_POST["address"] ?? ""),

            "currency" => trim($_POST["currency"] ?? "Rs."),

            "timezone" => trim($_POST["timezone"] ?? "Asia/Karachi"),

            "invoice_footer" => trim($_POST["invoice_footer"] ?? ""),

            "logo" => $logo

        ];

        $this->settingModel->updateSettings($data);

        $_SESSION["flash"] = [

            "type" => "success",

            "message" => "Settings updated successfully."

        ];

        header("Location: index.php?page=settings");

        exit;
    }


        /*--------------------------------------------------
    | Garment Types
    --------------------------------------------------*/

    public function garments()
    {

    }

    public function createGarment()
    {

    }

    public function storeGarment()
    {

    }

    public function editGarment()
    {

    }

    public function updateGarment()
    {

    }

    public function deleteGarment()
    {

    }

    /*--------------------------------------------------
    | Measurement Types
    --------------------------------------------------*/

/*--------------------------------------------------
| Measurement Types
--------------------------------------------------*/

    public function measurementTypes()
    {
        $types = $this->settingModel->getMeasurementTypes();

        $garments = $this->settingModel->getGarments();

        $this->view(
            "settings/measurement_types/index",
            [
                "types" => $types,
                "garments" => $garments
            ]
        );
    }

    /*--------------------------------------------------
    | Add Measurement Type Form
    --------------------------------------------------*/

    public function createMeasurementType()
    {
        $garments = $this->settingModel->getGarments();

        $this->view(
            "settings/measurement_types/create",
            [
                "title"     => "Add Measurement Field",
                "garments"  => $garments
            ]
        );
    }
    /*--------------------------------------------------
| Save Measurement Type
--------------------------------------------------*/

    public function storeMeasurementType()
    {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {

            header("Location: index.php?page=measurement-types");
            exit;
        }

        /*
        |--------------------------------------------------------------------------
        | Garment Type
        |--------------------------------------------------------------------------
        */

        if ($_POST["garment_select"] === "new") {

            $garment = trim($_POST["new_garment"]);

        } else {

            $garment = trim($_POST["garment_select"]);
        }

        /*
        |--------------------------------------------------------------------------
        | Validation
        |--------------------------------------------------------------------------
        */

        if (empty($garment)) {

            $_SESSION["flash"] = [

                "type" => "danger",

                "message" => "Please select or enter a garment."

            ];

            header("Location: index.php?page=add-measurement-type");

            exit;
        }

            if (empty($_POST["option_name"])) {

                $_SESSION["flash"] = [

                    "type" => "danger",

                    "message" => "Measurement name is required."

                ];

                header("Location: index.php?page=add-measurement-type");

                exit;
            }
            if ($this->settingModel->measurementExists(
            $garment,
            trim($_POST["section"]),
            trim($_POST["option_name"])
            )) {

                $_SESSION["flash"] = [

                    "type" => "warning",

                    "message" => "This measurement field already exists."

                ];

                header("Location: index.php?page=add-measurement-type");

                exit;
            }

        /*
        |--------------------------------------------------------------------------
        | Save Data
        |--------------------------------------------------------------------------
        */

        $data = [

            "garment_type" => $garment,

            "section" => trim($_POST["section"]),

            "option_name" => trim($_POST["option_name"]),

            "urdu_name" => trim($_POST["urdu_name"]),

            "placeholder" => trim($_POST["placeholder"]),

            "display_order" => (int) $_POST["display_order"],

            "status" => $_POST["status"]

        ];

        if ($this->settingModel->addMeasurementType($data)) {

            $_SESSION["flash"] = [

                "type" => "success",

                "message" => "Measurement field added successfully."

            ];

        } else {

            $_SESSION["flash"] = [

                "type" => "danger",

                "message" => "Unable to save measurement field."

            ];

        }

        header("Location: index.php?page=measurement-types");

        exit;
    }

/*--------------------------------------------------
| Edit Measurement Type
--------------------------------------------------*/

    public function editMeasurementType()
    {
        if (!isset($_GET["id"])) {

            header("Location: index.php?page=measurement-types");
            exit;
        }

        $id = (int)$_GET["id"];

        $measurement = $this->settingModel->getMeasurementTypeById($id);

        if (!$measurement) {

            $_SESSION["flash"] = [

                "type" => "danger",

                "message" => "Measurement not found."

            ];

            header("Location: index.php?page=measurement-types");
            exit;
        }

        $garments = $this->settingModel->getGarments();

        $this->view(

            "settings/measurement_types/edit",

            [

                "measurement" => $measurement,

                "garments" => $garments

            ]

        );
    }
/*--------------------------------------------------
| Update Measurement Type
--------------------------------------------------*/

    public function updateMeasurementType()
    {
        if ($_SERVER["REQUEST_METHOD"] != "POST") {

            header("Location: index.php?page=measurement-types");
            exit;
        }

        $id = (int)$_POST["id"];

        if ($_POST["garment_select"] == "new") {

            $garment = trim($_POST["new_garment"]);

        } else {

            $garment = trim($_POST["garment_select"]);
        }

        $data = [

            "garment_type" => $garment,

            "section" => trim($_POST["section"]),

            "option_name" => trim($_POST["option_name"]),

            "urdu_name" => trim($_POST["urdu_name"]),

            "placeholder" => trim($_POST["placeholder"]),

            "display_order" => (int)$_POST["display_order"],

            "status" => $_POST["status"]

        ];

        $this->settingModel->updateMeasurementType($id,$data);

        $_SESSION["flash"] = [

            "type"=>"success",

            "message"=>"Measurement updated successfully."

        ];

        header("Location:index.php?page=measurement-types");

        exit;
    }

/*--------------------------------------------------
| Delete Measurement Type
--------------------------------------------------*/

    public function deleteMeasurementType()
    {
        if (!isset($_GET["id"])) {

            $_SESSION["flash"] = [

                "type" => "danger",

                "message" => "Invalid request."

            ];

            header("Location: index.php?page=measurement-types");

            exit;
        }

        $id = (int) $_GET["id"];

        $measurement = $this->settingModel->getMeasurementTypeById($id);

        if (!$measurement) {

            $_SESSION["flash"] = [

                "type" => "danger",

                "message" => "Measurement field not found."

            ];

            header("Location: index.php?page=measurement-types");

            exit;
        }

        if ($this->settingModel->deleteMeasurementType($id)) {

            $_SESSION["flash"] = [

                "type" => "success",

                "message" => "Measurement field deleted successfully."

            ];

        } else {

            $_SESSION["flash"] = [

                "type" => "danger",

                "message" => "Unable to delete measurement field."

            ];
        }

        header("Location: index.php?page=measurement-types");

        exit;
    }

    /*--------------------------------------------------
    | Stitching Options
    --------------------------------------------------*/

    public function stitchingOptions()
    {

    }

    public function createStitchingOption()
    {

    }

    public function storeStitchingOption()
    {

    }

    public function editStitchingOption()
    {

    }

    public function updateStitchingOption()
    {

    }

    public function deleteStitchingOption()
    {

    }
}