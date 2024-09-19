<?php

# IF USER LOGGEDIN GOTO -> Dashboard
is_LoggedIn();

# USER MODELS
require './app/models/User.php';

$usernameErr = $fNameErr = $lNameErr = $emailErr = $passwordErr = $cpasswordErr = "";

# CHECK IF USER SUBMITTED THE FORM 
if (isset($_POST['submit'])) {
    $username = $fName = $lName = $email = $password = $cpassword = "";
    $username = filter_Data($_POST["username"]);
    $fName = filter_Data($_POST["fName"]);
    $lName = filter_Data($_POST["lName"]);
    $email = filter_Data($_POST["email"]);
    $password = filter_Data($_POST["password"]);
    $cpassword = filter_Data($_POST["cpassword"]);

    # VALIDATE  USERNAME
    if (empty($username)) {
        $usernameErr = "Username required";
    } else {
        if (!preg_match("/^[A-z][A-z0-9\.]{2,}$/", $username)) {
            $usernameErr = "Only letters,numeric, period and underscores are allowed.";
            $username = "";
        } else {
        }
    }

    # VALIDATE  FIRSTNAME
    if (empty($fName)) {
        $fNameErr = "required";
    }

    # VALIDATE  LASTNAME
    if (empty($lName)) {
        $lNameErr = "required";
    }

    # VALIDATE  EMAIL
    if (empty($email)) {
        $emailErr = "Email required";
    } else {
        if (!preg_match("/^[A-z](?!.*\.\.)[A-z0-9\.]{3,14}\@(gmail|email|hotmail)\.(com|co|in|uk)$/", $email)) {
            $emailErr = "Enter a valid email-Id";
            $email = "";
        }
    }

     # VALIDATE  PASSWORD
    if (empty($password)) {
        $passwordErr = "Password required";
    } else {
        if (strlen($password) >= 8 && strlen($password) <= 16) {
            if (!preg_match("/^(?=.*\W)[A-Za-z0-9\W]{8,16}$/", $password)) {
                $password = "";
                $passwordErr = "password should contain atleast one special character.";
            }
        } else {
            $passwordErr = "password length should be 8-16";
        }

       # VALIDATE  CONFIRM PASSWORD
        if (empty($cpassword)) {
            $cpasswordErr = "Confirm password required";
        } else {
            // $cpassword = filterData($_POST["cpassword"]);
            if ($password != $cpassword) {
                $cpassword = "";
                $cpasswordErr = "Password does not match";
            }
        }
    }

    # IF ALL FIELDS ARE VALID 
    if (!empty($username) && !empty($email) && !empty($password) && !empty($cpassword) && !empty($fName) && !empty($lName)) {

        // CHECK IF PASSWORD AND CONFIRM PASSWORD MATCH
        if ($password == $cpassword) {

            // IF PASSWORD MATCH GENERATE PASSWORD HASH
            $password_hash = password_hash($password, PASSWORD_BCRYPT);
            try {

                // CHECK IF USER EXISTS OR NOT  
                if (!isNewUser($email, $username)) {

                    // IF NEW USER CREATE/ADD USER 
                    addNewUser($fName, $fName, $email, $username, $password_hash);
                } else {

                    // Display Error Alert
                    show_alertError("User Already Exits...");
                }
            } catch (PDOException $e) {
                show_alertError($e->getMessage());
            }
        }
    } 
}

// REGISTER VIEW
require './app/views/register.php';
