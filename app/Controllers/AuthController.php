<?php

class AuthController extends Controller
{

    public function login()
    {

        if($_SERVER['REQUEST_METHOD']=="POST"){

            $userModel = new User();

            $user = $userModel->login($_POST['username']);

            if(

                $user &&

                password_verify(

                    $_POST['password'],

                    $user['password']

                )

            ){

                session_start();

                $_SESSION['admin']=$user['username'];

                $this->redirect("dashboard");

            }else{

                echo "Invalid Username or Password";

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