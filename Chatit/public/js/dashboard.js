// SET Var To Reset SetInterval
let chatInterval;

// SET A Default View 
document.getElementById('default-menu-tab-link').click();

// GET Chat Rooms On Document Load
document.onload = getChatRooms();

// CHANGE Tab View 
function showMainContent(evt, tabId, params) {
  var i, tabcontent, tablinks;

  // Get all elements with class="menu-tab-content" and hide them
  tabcontent = document.getElementsByClassName("menu-tab-content");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="menu-tab-link" and remove the class "active"
  tablinks = document.getElementsByClassName("menu-tab-link");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the link that opened the tab
  document.getElementById(tabId).style.display = "block";
  evt.className += " active";
  fetchData(tabId, params);

}

// FETCH Data As Per View 
function fetchData(type, params) {
  switch (type) {
    case "find-friends-tab":
      getRecommendations();
      break;
    case "chat-requests-tab":
      getAllChatRequests();
      break;
    case "chat-messages-tab":
      getChat(params);
      break;

    default:
      break;
  }
}

// GET All Chat Requests For the User
function getAllChatRequests() {
  var Xhr = new XMLHttpRequest();
  Xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('chat-requests-tab').innerHTML = this.responseText;
    }
  };
  Xhr.open("POST", "app/helpers/user_recommendation.php", true);
  Xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  Xhr.send("action=getChatAllRequests");
}

// SEND A Chat Request To A User 
function sendChatRequest(req_to, ele) {
  var Xhr = new XMLHttpRequest();
  Xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      ele.innerText = this.responseText;
    }
  };
  Xhr.open("POST", "app/helpers/user_recommendation.php", true);
  Xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  Xhr.send("action=sendChatRequest&req_to=" + encodeURIComponent(req_to));

}

// Reject A Chat Request
function rejectChatReq(req_id) {
  var Xhr = new XMLHttpRequest();
  Xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      getAllChatRequests();
    }
  };
  Xhr.open("POST", "app/helpers/user_recommendation.php", true);
  Xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  Xhr.send("action=rejectChatRequests&request_id=" + encodeURIComponent(req_id));
}

// Accept A Chat Request
function acceptChatReq(req_id) {
  var Xhr = new XMLHttpRequest();
  Xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      getAllChatRequests();
      getChatRooms();
    }
  };
  Xhr.open("POST", "app/helpers/user_recommendation.php", true);
  Xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  Xhr.send("action=acceptChatRequests&request_id=" + encodeURIComponent(req_id));
}

// GET User Recommendations
function getRecommendations() {
  var Xhr = new XMLHttpRequest();
  Xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('find-friends-tab').innerHTML = this.responseText;
    }
  };
  Xhr.open("POST", "app/helpers/user_recommendation.php", true);
  Xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  Xhr.send("action=getUserRecommendations");
}

// LOGOUT 
function logout() {
  var Xhr = new XMLHttpRequest();
  Xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      window.location.reload();
    }
  };
  Xhr.open("GET", "app/helpers/logout.php", true);
  Xhr.send();
}

// GET All Chat Rooms 
function getChatRooms() {
  const ele = document.getElementById('chat-room-tab');
  const ele2 = document.getElementById('chat-room-tab2');
  if (ele) {
    var Xhr = new XMLHttpRequest();
    Xhr.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        ele.innerHTML = this.responseText;
        ele2.innerHTML = this.responseText;

      }
    };
    Xhr.open("POST", "app/helpers/user_recommendation.php", true);
    Xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    Xhr.send("action=getAllChatRooms");
  }

}

// GET Selected Chat Data
function getChat(chat_id) {
  var Xhr = new XMLHttpRequest();
  Xhr.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('chat-messages-tab').innerHTML = this.responseText;
      getChatMessages(chat_id);
    }
  };
  Xhr.open("POST", "app/helpers/user_recommendation.php", true);
  Xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  Xhr.send("action=getChat&chat_id=" + encodeURIComponent(chat_id));
}

// GET Selected Chat Messages
function getChatMessages(chat_id) {
  if (chatInterval) {
    clearInterval(chatInterval); // Clear the previous interval
  }

  chatInterval = setInterval(() => {
    const elem = document.getElementById('chat-messages-content');

    // Check if the user is close to the bottom with some tolerance
    const isAtBottom = Math.abs(elem.scrollHeight - elem.scrollTop - elem.clientHeight) < 5;

    // console.log("elem.scrollHeight :" + elem.scrollHeight);
    // console.log("elem.clientHeight :" + elem.clientHeight);
    // console.log("elem.scrollTop :" + elem.scrollTop);
    // console.log("isAtBottom : " + isAtBottom);

    var Xhr = new XMLHttpRequest();
    Xhr.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        elem.innerHTML = this.responseText;

        // Only scroll if the user is already at the bottom
        if (isAtBottom) {
          elem.style.scrollBehavior = "smooth";
          elem.scrollTo(0, elem.scrollHeight);
        }
      }
    };
    Xhr.open("POST", "app/helpers/user_recommendation.php", true);
    Xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    Xhr.send("action=getChatMessages&chat_id=" + encodeURIComponent(chat_id));
  }, 1000); // get messages every 2 seconds
}


// SEND Messages
function sendMessage(chat_id) {
  const messageInput = document.getElementById('message-input-box');
  message = messageInput.value.toString().trim();
  if (message != "" && chat_id) {
    var Xhr = new XMLHttpRequest();
    Xhr.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        getChatMessages(chat_id);
        messageInput.value = "";
      }
    };
    Xhr.open("POST", "app/helpers/user_recommendation.php", true);
    Xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    Xhr.send("action=sendMessage&chat_id=" + encodeURIComponent(chat_id) + '&message=' + encodeURIComponent(message));
  }
}