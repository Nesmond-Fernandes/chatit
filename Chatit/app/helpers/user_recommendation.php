<?php

session_start();
/// GET USERS FOR RECOMMENDATIONS
// LIMIT 10 - 15 USERS ONLY 
try {

    require '../../config/config.php';
    require '../../config/db_conn.php';
    require '../models/User.php';
    require '../models/Chats.php';

    if (isset($_POST['action'])) {
        $action = $_POST['action'];
        switch ($action) {
            case 'getUserRecommendations':
                showRecommendations();
                break;
            case 'sendChatRequest':
                sendChatRequest();
                break;
            case 'getChatAllRequests':
                get_AllChatRequests();
                break;
            case 'acceptChatRequests':
                acceptChatRequests();
                break;
            case 'rejectChatRequests':
                rejectChatRequests();
                break;
            case 'getChatAllRequests':
                get_AllChatRequests();
                break;
            case 'getAllChatRooms':
                get_AllChatRooms();
                break;
            case 'getChat':
                get_Chat();
                break;
            case 'getChatMessages':
                get_ChatMessages();
                break;
            case 'sendMessage':
                get_sendMessage();
                break;

            default:
                echo 'deafult';
                break;
        }
    }
} catch (Exception $e) {
    $e->getMessage();
}
# DYNAMIC DATE FOR CHAT ROOMS
function get_Date($date)
{
    $date = new DateTime($date);
    $now = new DateTime();
    $diff = $now->diff($date);

    if ($diff->d === 0 && $diff->m === 0 && $diff->y === 0) {
        // Message sent today
        echo $date->format('h:i A');  // Output: 12:26 PM
    } elseif ($diff->d < 7) {
        // Message sent within the last 7 days
        echo $date->format('l, h:i A');  // Output: Tuesday, 12:26 PM
    } else {
        // Message sent more than a week ago
        echo $date->format('M d Y, h:i A');  // Output: Sep 17 2024, 12:26 PM
    }
    // date_create($chat_room['last_active'])->format('h:i a')
}

# Accept Chat Requests
function acceptChatRequests()
{
    try {
        if (isset($_POST['request_id'])) {
            $req_id = $_POST['request_id'];
            createChatRoom($req_id);
        } else {
            throw new Exception('Which Request to Acceot');
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

# REJECT CHAT REQUESTS
function rejectChatRequests()
{
    try {
        if (isset($_POST['request_id'])) {
            $req_id = $_POST['request_id'];
            rejectChatRequest($req_id);
        } {
            throw new Exception('Which Request to Acceot');
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

# GET ALL THE CHAT REQUESTS FOR THE USER
function get_AllChatRequests()
{
    try {
        $req_for = $_SESSION['user']['userId'];
        $chat_requests = getAllChatRequests($req_for);
        if (count($chat_requests) > 0) {
            echo '<div class="d-flex flex-column h-100 py-2 overflow-hidden">
            <div class="h-100 overflow-y-scroll px-2" style="flex: 1 0 0;">';
            foreach ($chat_requests as $chat_request) {
                //             echo '
                //         <div class="list-group  mb-2 ">
                //     <div  class="list-group-item shadow" aria-current="true">
                //         <div class="d-flex w-100 justify-content-between">
                //             <h5 class="my-1 text-capitalize">' . $chat_request['firstname'] . ' ' . $chat_request['lastname'] . '</h5>
                //             <small>3 days ago</small>
                //         </div>
                //         <p class="mb-1">has sent you a chat request.</p>
                //        <div class="container d-flex flex-row ps-0 py-2 gap-2">
                //         <button onclick="acceptChatReq(' . $chat_request['id'] . ')" class="btn btn-primary ">accept</button>
                //         <button onclick="rejectChatReq(' . $chat_request['id'] . ')" class="btn ">ignore</button>
                //        </div>
                //     </div>
                // </div>';
                echo '    <div class="list-group  mb-2 ">
                            <div class="list-group-item shadow" aria-current="true">
                                <div class="row row-cols-2 align-items-center py-2 gap-2 justify-content-between ">
                                    <div class="col-auto text-truncate">
                                        <h5 class="m-0">' . $chat_request['firstname'] . ' ' . $chat_request['lastname'] . '</h5>
                                        <p class="m-0 text-secondary">has sent you a chat request</p>
                                    </div>
                                    <div class="col-auto ">
                                        <div class="row row-cols-2  justify-content-center">
                                            <div class="col ">
                                                <button onclick="rejectChatReq(' . $chat_request['id'] . ')"  class="btn btn-light ">ignore</button>
                                            </div>
                                            <div class="col ">
                                            <button onclick="acceptChatReq(' . $chat_request['id'] . ')" class="btn btn-primary">accept</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>';
            }
            echo '</div></div>';
        } else {
            echo ' <p class="position-absolute top-50 start-50 translate-middle fs-4 text-secondary user-select-none">No Chat Requests</p>';
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

# SEND A CHAT REQUEST TO A USER
function sendChatRequest()
{
    try {
        if (isset($_POST['req_to'])) {
            $req_to = $_POST['req_to'];
            makeChatRequest($req_to);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

# GET USER RECOMMENDATIONS
function showRecommendations()
{
    try {
        $users = getUserRecommendations();
        echo    '<div class="row row-cols-1 h-100 flex-nowrap flex-column">
        <div class="col"> <p class=" fs-3 fw-medium px-3 mt-3">Recommendation</p></div>
        <div class="col overflow-hidden pb-1"  style = "flex:1 0 0";>
        
        
        <div style="padding-bottom:20px !important" class=" h-100 overflow-y-scroll row row-cols-2 row-cols-3 row-cols-sm-3 row-cols-lg-4 justify-content-center gap-2 container-fluid  m-0 p-1 ">';
        foreach ($users as $user) {

            echo ' <div class="card  bg-dark-hover col-5 px-0 overflow-hidden">
                    <div class="row d-inline-block  ">
                        <img  src="https://randomuser.me/api/portraits/women/' . $user['user_id'] . '.jpg"  alt=""  class=" rounded-circle mt-2 px-4 object-fit-cover">
                    </div>
                    <div class="card-body row px-4 pt-3 py-1 row-cols-1 gap-2 ">
                        <div class=" col d-flex justify-content-center text-nowrap container-fluid p-0"><a onclick="sendChatRequest(' . $user['user_id'] . ',this)" class="btn btn-primary  w-100 rounded-5">Send Request</a></div>
                        <div class="col p-0 text-center pb-1">
                            <p class=" m-0 lh-1 fw-bold fs-6">' . $user['firstname'] . ' ' . $user['lastname'] . ' </p>
                            <small class="m-0 lh-1 fw-semibold text-primary">' . $user['username'] . '</small>
                        </div>
                    </div>
                </div>';
              }
        echo '</div></div>
                 </div>';
    } catch (Exception $e) {

        echo $e->getMessage();
    }
}

# GET ALL THE CHAT ROOMS 
function get_AllChatRooms()
{
    try {
        $req_for = $_SESSION['user']['userId'];
        $chat_rooms = getAllChatRooms($req_for);
        if (count($chat_rooms) > 0) {
            $i = 0;
            foreach ($chat_rooms as $chat_room) {

                echo '   
                <li data-bs-dismiss="offcanvas" onclick="showMainContent(this,\'chat-messages-tab\',\'' . $chat_room['chat_id'] . '\',)"
                    class="menu-tab-link px-1 mx-1 text-start border-0 rounded btn btn-outline-primary list-group-item d-flex justify-content-between align-items-center">
                <div class="ms-2 me-auto text-truncate">
                <div class="fw-bold text-capitalize">' . $chat_room['firstname'] . ' ' . $chat_room['lastname'] . '</div>';
                if (isset($chat_room['message'])) {
                    echo $chat_room['message'];
                } else {
                    // echo "<small> Ready to chat...</small> ";
                    echo "<small> Tap here to start a converation</small> ";
                }
                echo '</div>
                      <small class="d-inline-block text-nowrap " style="font-size:10px">';
                if (isset($chat_room['last_active']))  get_Date($chat_room['last_active']);
                echo '</small></li>';
                // <span class="badge text-bg-danger rounded-pill">14</span>
                $i++;
            }
        } else {
            echo ' <h5 class="position-absolute top-50 start-50 translate-middle text-secondary">No Chats</h5>';
        }
    } catch (Exception $e) {

        echo $e->getMessage();
    }
}

# GET THE DATA FOR THE CHAT
function get_Chat()
{
    try {
        if (isset($_POST['chat_id'])) {
            $chat_id = htmlspecialchars($_POST['chat_id']);
            $req_for = $_SESSION['user']['userId'];
            $chat = getChat($req_for, $chat_id);
            echo '    <!-- HEADER START -->
                        <div class="container-fluid shadow-sm py-3" style="flex-shrink: 0;">
                            <div class="row">
                                <div class="col-auto d-flex gap-2 flex-row user-select-none">
                                    <div><img src="https://randomuser.me/api/portraits/women/' . $chat['recipient_id'] . '.jpg" width="42" height="42" class="rounded-circle" alt="profile"></div>
                                    <div class="d-flex flex-column justify-content-center">
                                        <p class="m-0 lh-1 teext-nowrap fw-semibold">' . $chat['firstname'] . ' ' . $chat['lastname'] . '</p>
                                        <small class="m-0 lh-1 text-secondary">@' . $chat['username'] . '</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                      <!-- HEADER END -->

                      <!-- CONTENT START -->
                      <div style="flex: 1 0 0;" class="container-fluid d-flex flex-column flex-grow-1 overflow-auto bg-light p-2 position-relative" id="chat-messages-content">
                      </div>
                      <!-- CONTENT END -->
  
                      <!-- FOOTER START -->
                      <div class="container-fluid position-relative py-3" style="flex-shrink: 0;">
                          <div class="input-group align-items-end gap-1">
                              <textarea style="max-height: 100px; resize:auto;" type="text" id="message-input-box" rows="3" class="form-control shadow-none border-primary rounded border-2 mh-50" placeholder="message..." aria-label="message box" aria-describedby="button-addon2"></textarea>
                              <div class=""><button onclick="sendMessage(\'' . htmlspecialchars($chat_id) . '\')" class="btn btn-primary btn" type="button" id="button-addon2">Send</button></div>
                          </div>
                      </div>
                      <!-- FOOTER END -->';
        }
    } catch (Exception $e) {

        echo $e->getMessage();
    }
}

# GET SELECTED CHAT MESSAGES
function get_ChatMessages()
{
    try {
        if (isset($_POST['chat_id'])) {
            $chat_id = htmlspecialchars($_POST['chat_id']);
            $you = $_SESSION['user']['userId'];
            $chat_messages = getChatMessages($chat_id);
            if (count($chat_messages) > 0) {


                foreach ($chat_messages as $chat_message) {
                    if ($chat_message['sent_from'] == $you) {
                        # YOUR MESSAGE
                        echo '<div class="w-100">
                          <div class="bg-primary d-inline-block text-bg-primary rounded py-2 px-3 mb-2 float-end" style="max-width: 60%;word-break:break-word;">
                          ' . $chat_message['message'] . '
                          <p class="m-0 p-0 text-end mt-1" style="font-size:0.7rem">
                          ' . date_create($chat_message['sent_at'])->format('h:i a') . '
                          </p>
                          </div>
                          </div>  ';
                    } else {
                        echo ' <div class="w-100">
                           <div class="text-bg-light border border-1 border-dark-subtle d-inline-block rounded py-2 px-3 mb-2  " style="max-width: 60%;word-break:break-word;">
                           ' . $chat_message['message'] . '
                           <p class="m-0 p-0 text-end mt-1" style="font-size:0.7rem">
                           ' . date_create($chat_message['sent_at'])->format('h:i a') . '
                           </p>
                           </div>
                           </div>';
                        # HIS MESSAGE
                    }
                }
            } else {
                echo '<div class="position-absolute top-50 start-50 translate-middle user-select-none text-secondary">No Messages Yet</div>';
            }
        }
    } catch (Exception $e) {

        echo $e->getMessage();
    }
}

# SEND A CHAT MESSAGE
function get_sendMessage()
{
    try {
        if (isset($_POST['chat_id']) && isset($_POST['message'])) {
            $chat_id = htmlspecialchars($_POST['chat_id']);
            $message = htmlspecialchars($_POST['message']);
            $sender_id = $_SESSION['user']['userId'];
            sendMessage($chat_id, $sender_id, $message);
        }
    } catch (Exception $e) {

        echo $e->getMessage();
    }
}
