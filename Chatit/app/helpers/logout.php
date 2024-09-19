<?php
session_start();
if (isset($_SESSION["user"]["isLoggedIn"]) && $_SESSION["user"]["isLoggedIn"] == true) {
    unset($_SESSION["user"]);
} 

?>