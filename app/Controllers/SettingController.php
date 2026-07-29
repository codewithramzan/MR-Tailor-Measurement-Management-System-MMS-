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
}