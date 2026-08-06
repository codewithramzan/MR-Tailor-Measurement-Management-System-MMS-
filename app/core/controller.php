<?php
    class Controller
   {
        protected function view($view, $data = [])
        {
            /*
            |--------------------------------------------------------------------------
            | Global Settings
            |--------------------------------------------------------------------------
            */

            $shop = [

                "shop_name"       => Config::get("shop_name"),

                "owner_name"      => Config::get("owner_name"),

                "phone"           => Config::get("phone"),

                "email"           => Config::get("email"),

                "website"         => Config::get("website"),

                "address"         => Config::get("address"),

                "currency"        => Config::get("currency"),

                "timezone"        => Config::get("timezone"),

                "invoice_footer"  => Config::get("invoice_footer"),

                "logo"            => Config::get("logo")

            ];

            $data["shop"] = $shop;

            extract($data);

            require "../app/Views/" . $view . ".php";
        }

    protected function redirect($page)
    {
        header("Location: index.php?page=".$page);
        exit;
    }

    protected function redirectWithMessage($page, $type, $message)
    {
        Flash::set($type, $message);

        header("Location: index.php?page=".$page);

        exit;
    }
}