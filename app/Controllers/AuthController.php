<?php

class AuthController extends Controller
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST")
        {
            $validator = new Validator();

            $validator
                ->required("username", $_POST['username'], "Username")
                ->required("password", $_POST['password'], "Password");

            if ($validator->hasErrors())
            {
                OldInput::set($_POST);

                $this->redirectWithMessage(

                    "login",

                    "danger",

                    $validator->first()

                );
            }

            $userModel = new User();

            $user = $userModel->login($_POST['username']);

            if (
                $user &&
                password_verify(
                    $_POST['password'],
                    $user['password']
                )
            )
            {
                session_start();

                $_SESSION['admin'] = $user['username'];

                OldInput::clear();

                $this->redirect("dashboard");
            }
            else
            {
                OldInput::set($_POST);

                $this->redirectWithMessage(

                    "login",

                    "danger",

                    "Invalid Username or Password."

                );
            }

            return;
        }

        $this->view('auth/login');
    }


    public function logout()
        {

            session_destroy();

            header("Location: index.php");

            exit;

        }

}