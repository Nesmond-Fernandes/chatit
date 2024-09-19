<?php
# IF USER LOGGEDIN GOTO -> Dashboard
is_LoggedIn();

# USER MODELS
require './app/models/User.php';

$emailErr = $passwordErr = "";

# CHECK IF USER SUBMITTED THE FORM 
if (isset($_POST['submit'])) {
    $email = $password = "";
    $email = filter_Data($_POST["email"]);
    $password = filter_Data($_POST["password"]);

    # VALIDATE  EMAIL
    if (empty($email)) {
        $emailErr = "Email required";
    } else {
        if (!preg_match("/^[A-z](?!.*\.\.)[A-z0-9\.]{3,14}\@(gmail|email|hotmail)\.(com|co|in|uk)$/", $email)) {
            $emailErr = "Enter a valid email-Id";
            $email = "";
        }
    }

    # VALIDATE PASSWORD
    if (empty($password)) {
        $passwordErr = "Password required";
    } else {
        if (strlen($password) >= 8 && strlen($password) <= 16) {
            $passwordErr = "";
        } else {
            $passwordErr = "password length should be 8-16";
        }
    }
    
    # IF FIELDS ARE VALID & NOT EMPTY
    if (!empty($email)  && !empty($password)) {
        try {
            
            $user = getUser($email); // GET USER FROM USER 

            // IF USER EMPTY OR NOT 
            if (isset($user) && $user) {
                // USER  FOUNND 
                
                // GET PASSWORD HASH FROM  FETCHED USER DATA
                $userPassword = $user["password"];

                // VERIFY PASSWORD WITH USER ENTERED PASSWORD
                if (password_verify($password, $userPassword)) {

                    // LOGIN SUCCESSFUL 

                    // UPDATE USER LOGIN TIME
                    updateLog($user['id']);
                    
                    // SET USER SESSION
                    $_SESSION["user"]["userId"] = $user['id'];
                    $_SESSION["user"]["name"] = $user['firstname'] . ' ' . $user['lastname'];
                    $_SESSION["user"]['isLoggedIn'] = true;

                    // GOTO DASHBOARD
                    header("Location: ./dashboard");
                } else {
                    // LOGIN FAILED

                    // Display error alert
                    show_alertError("Incorrect password. Please try again."); 
                }
            } else {
                // USER NOT FOUND 

                // Display error alert
                show_alertError("Invalid credential. please enter a valid email");
            }
        } catch (Exception $e) {
            show_alertError($e->getMessage());
        }
    }
}

// LOGIN VIEW
require './app/views/login.php';
