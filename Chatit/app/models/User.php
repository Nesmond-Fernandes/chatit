<?php

/** GET USER  WITH EMAIL
 * 
 * @param string $email emailid of the user  
 * 
 * @return mixed User data
*/
function getUser($email)
{

    $conn = dbConn();
    if ($conn) {
        $sql = "SELECT id,firstname,lastname,password FROM users Where email = :email ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        if ($stmt->execute()) {

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Error : Error Processing Request");
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}


/** UPDATE USER LOGIN TIME 
 * 
 * @param string $userId of the user  
 * 
*/
function updateLog($userId)
{
    $conn = dbConn();
    if ($conn) {
        $sql = "UPDATE `users` SET `last_logged_in` = :last_logged_in WHERE `users`.`id` = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":id", $userId);
        $stmt->bindParam(":last_logged_in", date_create()->format('Y-m-d H:i:s'));
        if (!($stmt->execute())) {
            throw new Exception("Error : Error Processing Request");
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}

/** CHECKS IF THE USER EXISTS
 * 
 * @param string $email of the user  
 * @param string $username of the user  
 * 
 * @return mixed returns user if exists
*/
function isNewUser($email, $username)
{

    $conn = dbConn();
    if ($conn) {
        $sql = "SELECT * FROM users Where email = :email || username = :username";
        // $sql = "SELECT * FROM admins Where email = :email ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":username", $username);
        if ($stmt->execute()) {

            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Error : Error Processing Request");
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}

/** ADD USER / REGISTER NEW USER  
 * 
 * @param string $fName firstname of the user  
 * @param string $lName lastname of the user  
 * @param string $email of the user  
 * @param string $username of the user  
 * @param string $password Password Hash generated from user password  
 * 
*/
function addNewUser($fName, $lName, $email, $username, $password)
{
    $conn = dbConn();
    if ($conn) {
        $sql = "INSERT INTO `users` (firstname,lastname,email,username,password)
            VALUES (:firstname ,:lastname,:email,:username,:password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":firstname", $fName);
        $stmt->bindParam(":lastname", $lName);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":password", $password);
        if ($stmt->execute()) {
            $_SESSION["user"]["userId"] = $conn->lastInsertId();
            $_SESSION["user"]["name"] = $fName . ' ' . $lName;
            $_SESSION["user"]['isLoggedIn'] = true;
            header("Location: ./dashboard"); # GOTO Home...
        } else {
            throw new Exception("Error : Error Processing Request");
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}

/** GET USERS FOR RECOMMENDATIONS 
 * 
 * @return array returns users who are not in chatroom,or previously sent a request 
*/
function getUserRecommendations()
{
    $conn = dbConn();
    if ($conn) {
        $userId = $_SESSION['user']['userId'];
        // $sql = "SELECT username,email,lastname,firstname,id FROM users LIMIT 15";
        // $sql = 
        // "SELECT * 
        // FROM(
        // SELECT u.id as user_id,username,email,lastname,firstname,newcr.status_code,newcr.status
        // FROM users as u 
        // LEFT JOIN (SELECT cr.req_from, cr.req_to,cr.status_code,rs.status FROM chat_requests as cr INNER JOIN request_status as rs ON rs.status_code = cr.status_code WHERE cr.req_from =:user_id) as newcr ON u.id = newcr.req_to 
        // WHERE NOT u.id =:user_id
        // ) as new_users 
        // WHERE new_users.status_code IS NULL";
        $sql = "SELECT u.id as user_id,u.firstname,u.lastname,u.username FROM users as u 
               WHERE NOT u.id IN (SELECT cr.req_to FROM chat_requests as cr WHERE cr.req_from=:user_id) 
               AND NOT u.id IN (SELECT cu1.user_id FROM chatroom_users as cu1 
               WHERE cu1.chat_id IN (SELECT cu.chat_id FROM chatroom_users as cu WHERE cu.user_id = :user_id) 
               AND NOT cu1.user_id = :user_id) AND NOT u.id = :user_id LIMIT 15";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":user_id", $userId);
        // $stmt->bindParam(":username", $username);
        if ($stmt->execute()) {

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Error : Error Processing Request");
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}
