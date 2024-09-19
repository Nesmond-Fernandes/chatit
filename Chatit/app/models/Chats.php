<?php

/** GET A CHAT REQUEST USING SENDER AND RECIPIENT USER ID  
 * 
 * @param string $req_from [USER_ID] of the user who made the request 
 * @param string $req_to [USER_ID] of the user whose request was sent to 
 * 
 * @return mixed if Success returns User Data
*/
function getChatRequest($req_from, $req_to)
{
    if (isset($req_from) && isset($req_to)) {

        $conn = dbConn(); // establish Database Connection
        if ($conn) {
            $sql = "SELECT * from `chat_requests` WHERE `req_from`= :req_from AND `req_to` = :req_to ";
            // $sql = "INSERT INTO `chat_requests` ( `req_from`, `req_to`, `status`) VALUES ( :req_from, :req_to, 2)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":req_from", $req_from);
            $stmt->bindParam(":req_to", $req_to);
            if ($stmt->execute()) {
                return $stmt->fetch(PDO::FETCH_ASSOC);
            } else {
                throw new Exception("Error : Error Processing Request");
            }
        } else {
            throw new Exception("Database connection could not be established");
        }
    }
}

/** GET A CHAT REQUEST USING REQUESTID
 * 
 * @param string $req_id ID of the request 
 * 
 * @return mixed if Success returns User Data
*/
function getChatRequestWithID($req_id)
{
    $conn = dbConn();
    if ($conn) {
        $sql = "SELECT * from `chat_requests` WHERE `id`= :req_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":req_id", $req_id);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Error : Error Processing Request");
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}

/** MAKE A CHAT REQUEST 
 * 
 * @param string $req_to user_id of the request Sender
 * 
*/
function makeChatRequest($req_to)
{
    $conn = dbConn();
    if ($conn) {
        $user_id = $_SESSION['user']['userId'];
        if ($user_id != $req_to) {

            // check if user has already  requested
            if (!getChatRequest($user_id, $req_to)) {

                // check if the person has requested 
                $personRequested = getChatRequest($req_to, $user_id);
                if ($personRequested) {

                    // if the other person has already made a request then accept request and create a room
                    createChatRoom($personRequested['id']);
                } else {
                    
                    // make a request 
                    $sql = "INSERT INTO `chat_requests` ( `req_from`, `req_to`, `status_code`) VALUES ( :req_from, :req_to, 1)";
                    $stmt = $conn->prepare($sql);
                    $stmt->bindParam(":req_from", $user_id);
                    $stmt->bindParam(":req_to", $req_to);
                    if ($stmt->execute()) {
                        echo "requested";
                    } else {
                        throw new Exception("Error : Error Processing Request");
                    }
                }
            } else {
                echo "requested";
            }
        } else {
            echo "error";
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}

/** GET ALL CHAT REQUESTS 
 * 
 * @param string $req_for user_id of the user who got the request
 * 
*/
function getAllChatRequests($req_for)
{
    $conn = dbConn();
    if ($conn) {
        // fetch all the chat request made to the user 
        $sql = "SELECT cr.id,u.id as user_id,u.firstname,u.lastname,cr.created_at FROM chat_requests as cr INNER JOIN (SELECT firstname,lastname,id FROM users) as u ON u.id =cr.req_from  WHERE req_to = :req_to AND status_code = 1 ORDER BY created_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":req_to", $req_for);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Error : Error Processing Request");
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}

/** ACCEPT A CHAT REQUEST
 * 
 * @param string $req_id id of the request to accept
 * 
*/
function acceptChatRequest($req_id)
{
    $conn = dbConn();
    if ($conn) {

        // check if the request exists 
        if (getChatRequestWithID($req_id)) {

            // if request exists then accept the request
            $sql = "UPDATE `chat_requests` SET `status_code` = '2' WHERE `chat_requests`.`id` = :req_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":req_id", $req_id);
            if ($stmt->execute()) {
                echo "acccepted";
            } else {
                throw new Exception("Error : Error Processing Request");
            }
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}

/** REJECT A CHAT REQUEST
 * 
 * @param string $req_id id of the request to reject
 * 
*/
function rejectChatRequest($req_id)
{
    $conn = dbConn();
    if ($conn) {

        // check if the request exists 
        if (getChatRequestWithID($req_id)) {

            // if request exists then reject the request
            // $sql = "UPDATE `chat_requests` SET `status_code` = '2' WHERE `chat_requests`.`id` = :req_id";
            $sql = "DELETE FROM `chat_requests` WHERE `chat_requests`.`id` = :req_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":req_id", $req_id);
            if ($stmt->execute()) {
            } else {
                throw new Exception("Error : Error Processing Request");
            }
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}

/** CREATE A CHAT ROOM
 * 
 * @param string $req_id id of the chat request 
 * 
*/
function createChatRoom($req_id)
{
    // get the request using the request id
    $res_request = getChatRequestWithID($req_id);
    $conn = dbConn();
    if ($conn) {
        if ($res_request['status_code'] == '2') {
            echo 'accepted';
        } else {
            // create a unique id for the chatroom
            $chatRoom_id = uniqid('', true);
            if ($chatRoom_id) {
                $sql = "INSERT INTO `chatrooms` (`chat_id`) VALUES ( :chat_id)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":chat_id", $chatRoom_id);
                if ($stmt->execute()) {
                    // if the chatroom created successfully then add members to the chatroom
                    addRecipients($chatRoom_id, $req_id);
                } else {
                    throw new Exception("Error : Error Processing Request");
                }
            } else {
                echo "error";
            }
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}

/** ADD CHAT MEMBERS 
 * 
 * @param string $req_id id of the request to accept
 * @param string $chatRoom_id id of the created chat room
 * 
 */
function addRecipients($chatRoom_id, $req_id)
{
    $conn = dbConn();
    if ($conn) {
        if ($chatRoom_id && $req_id) {
            try {
                // check if the request exists 
                $request = getChatRequestWithID($req_id);
                $recipient_2 = $request['req_to'];
                $recipient_1 = $request['req_from'];
                $sql = "INSERT INTO `chatroom_users` (`chat_id`,`user_id`) VALUES ( :chat_id,:user_id)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(":chat_id", $chatRoom_id);

                $stmt->bindValue(":user_id", $recipient_1);
                $stmt->execute();
                $stmt->bindValue(":user_id", $recipient_2);
                $stmt->execute();
                acceptChatRequest($req_id);
            } catch (Exception $e) {
                throw new Exception($e->getMessage());
            }
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}

/** GET ALL CHAT ROOMS 
 * 
 * @param string $user_id id of the user 
 * 
 * @return array of all the chatrooms of the user  
*/
function getAllChatRooms($user_id)
{
    $conn = dbConn();
    if ($conn) {
        // $sql = "SELECT u.firstname,u.lastname,c.chat_id FROM users as u 
        //         INNER JOIN (SELECT * FROM chatroom_users as chatrooms  
        //         WHERE chat_id 
        //         IN (SELECT cr_u.chat_id FROM  chatroom_users cr_u 
        //         WHERE cr_u.user_id = :user_id) 
        //         AND NOT user_id = :user_id)as c ON c.user_id = u.id";
        // $sql = "SELECT u.firstname,u.lastname,c.chat_id,c.last_active FROM users as u 
        //         INNER JOIN (
        //         SELECT chatrooms.chat_id,chatrooms.user_id,cr.last_active FROM chatroom_users as chatrooms
        //         INNER JOIN (
        //         SELECT last_active,chat_id FROM chatrooms) as cr ON cr.chat_id = chatrooms.chat_id 
        //         WHERE chatrooms.chat_id IN (SELECT cr_u.chat_id FROM chatroom_users cr_u WHERE cr_u.user_id = :user_id) 
        //         AND NOT user_id = :user_id) as c ON c.user_id = u.id";
        $sql = "SELECT us.firstname,us.lastname,p.chat_id,p.message, p.created_at as last_active FROM users AS us
                JOIN (SELECT cus.user_id,cus.chat_id,cus2.message, cus2.created_at FROM chatroom_users as cus 
                JOIN (SELECT crs.chat_id, m.message, m.created_at FROM chatroom_users as crs 
                LEFT JOIN ( SELECT c.chat_id, c.message, MAX(c.created_at) as latest_message_time FROM chats as c GROUP BY chat_id ) m_latest ON crs.chat_id = m_latest.chat_id 
                LEFT JOIN chats m ON m.chat_id = m_latest.chat_id AND m.created_at = m_latest.latest_message_time WHERE crs.user_id =:user_id)cus2 ON cus2.chat_id = cus.chat_id WHERE NOT cus.user_id = :user_id)p ON p.user_id = us.id ORDER BY p.created_at DESC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":user_id", $user_id);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Error : Error Processing Request");
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}

/** GET CHAT DETAILS
 * 
 * @param string $user_id id of the user 
 * @param string $chatRoom_id id of the chatRoom 
 * 
 * @return mixed Chat Room details  
*/
function getChat($user_id, $chatRoom_id)
{
    $conn = dbConn();
    if ($conn) {
        $sql = "SELECT u.id as recipient_id,u.firstname,u.lastname,u.username FROM chatroom_users as cu 
                INNER JOIN users as u ON u.id=cu.user_id 
                WHERE cu.chat_id = :chat_id AND NOT cu.user_id=:user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":chat_id", $chatRoom_id);
        $stmt->bindParam(":user_id", $user_id);
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Error : Error Processing Request");
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}


/** GET ALL CHAT MESSAGES 
 * 
 * @param string $chatRoom_id id of the chatRoom 
 * 
 * @return array Chat Messages  
*/
function getChatMessages($chatRoom_id)
{
    $conn = dbConn();
    if ($conn) {
        $sql = "SELECT c.sent_from,c.message,c.created_at as sent_at FROM `chats` as c WHERE chat_id =:chat_id ORDER BY c.created_at ASC";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":chat_id", $chatRoom_id);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            throw new Exception("Error : Error Processing Request");
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}


/** SEND A CHAT MESSAGE 
 * 
 * @param string $sender_id id of the user who sends the message 
 * @param string $chatRoom_id id of the chatRoom 
 * @param string $message the text message to be sent
 * 
*/
function sendMessage($chatRoom_id, $sender_id, $message)
{
    $conn = dbConn();
    if ($conn) {
        $sql = "INSERT INTO `chats` ( `sent_from`, `message`, `chat_id`) VALUES ( :sender_id, :message,:chat_id);";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":sender_id", $sender_id);
        $stmt->bindParam(":message", $message);
        $stmt->bindParam(":chat_id", $chatRoom_id);
        if ($stmt->execute()) {
        } else {
            throw new Exception("Error : Error Processing Request");
        }
    } else {
        throw new Exception("Database connection could not be established");
    }
}
