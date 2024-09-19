<?php
session_start();
# LOAD CONFIGURATION DATABASE AND CONFIG FILE 
require_once './config/config.php';
require_once './config/db_conn.php';


# CHECK IF USER LOGGED IN
function is_LoggedIn()
{
    if (isset($_SESSION['user']["isLoggedIn"]) && $_SESSION['user']["isLoggedIn"] == true) {
        header('Location:./dashboard');
    }
}

# CHECK IF USER NOT LOGGED IN 
function is_Not_LoggedIn()
{
    if (!isset($_SESSION['user']["isLoggedIn"]) || $_SESSION['user']["isLoggedIn"] == false) {
        header('Location:./login');
    }
}

# DISPLAY SUCCESS ALERT TOAST 
function show_alertSuccess($msg)
{
    echo '<div class="alert alert-success position-absolute top-0 start-0 mt-2 ms-1 d-flex alert-dismissible fade show align-items-center" role="alert">
            <div>
             ' . $msg . '
            </div>
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}

# DISPLAY ERROR ALERT TOAST 
function show_alertError($msg)
{
    echo '<div class="alert alert-danger position-absolute top-0 start-0   mt-2 ms-1  d-flex alert-dismissible fade show align-items-center" role="alert">
            <div>
             ' . $msg . '
            </div>
             <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}

# GET PARAMS FROM GET REQUESTS 
function get_params($param, $default)
{
    return $_GET[$param] ?? $default;
}

# FILTER & SANITIZE DATA 
function check_sanitize_Data(mixed $data, mixed $DEFAULT_VALUE, int $FILTER, mixed $VALIDATOR = null): mixed
{
    $filtered = isset($data) ? filter_var($data, $FILTER, array('options' => array('default' => $DEFAULT_VALUE))) : $DEFAULT_VALUE;
    if (!is_null($VALIDATOR)) {
        return filter_var($filtered, $VALIDATOR, array('options' => array('default' => $DEFAULT_VALUE)));
    }
    return $filtered;
}

# FILTER DATA FOR GET PARAMS
function filter_Data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

# Determine the base path dynamically
$base_path = str_replace($_SERVER['DOCUMENT_ROOT'], '', dirname($_SERVER['SCRIPT_NAME']));

# Get the request URI and remove the base path from it
$request = str_ireplace($base_path, '', strtok($_SERVER['REQUEST_URI'], '?'));

# Remove query strings and sanitize the URL
$request = strtok($request, '?');
switch ($request) {
    case '/':
    case '/dashboard':
        include './app/controllers/dashboard_controller.php';
        break;
    case '/login':
        require './app/controllers/login_controller.php';
        break;
    case '/register':
        require './app/controllers/register_controller.php';
        break;
    case '/about':
        require './app/views/about.php';
        break;
    default:
        http_response_code(404);
        require './app/views/404.php';
        break;
}
