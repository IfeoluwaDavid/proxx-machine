<?php

include('initialize.php');

$errors = [];
$email = '';
$password = '';

if(request_is_post()) 
{
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if(is_blank($email))
    {
        $errors[] = "Email cannot be blank.";
    }
    if(is_blank($password))
    {
        $errors[] = "Password cannot be blank.";
    }

    // if there were no errors, try to login
    if(empty($errors))
    {
        $userfound = find_user_with_email($email);
        if($userfound)
        {
            if(password_verify(trim($password), trim($userfound['hashedpassword'])))
            {
                $loginStatus = login_user($userfound);
                if($loginStatus)
                {
                    $_SESSION["successFeedback"] = "Welcome Back! You're now logged in!";
                    if($userfound['membertype'] == 1)
                    {
                         redirect_to('../public/adminhome.php');
                    }
                    else
                    {
                         redirect_to('../public/memberhome.php');
                    }
                }
                else
                {
                    $_SESSION["errorFeedback"] = "For some unknown reason, we're unable to log you in.";
                    redirect_to('../public/login.php');
                }
            }
            else
            {
                $_SESSION["errorFeedback"] = "Incorrect Login Credentials! Please try again.";
                redirect_to('../public/login.php');
            }
        }
        else
        {
            $_SESSION["errorFeedback"] = "Incorrect Login Credentials! Please try again.";
            redirect_to('../public/login.php');
        }
    }
}

?>