<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chat.it</title>
    <script async defer src="./public/js/dashboard.js" type="text/javascript"></script>
    <link rel="stylesheet" href="public/css/style.css" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="vh-100">
    <div class="container-fluid d-flex flex-column bg-body-secondary h-100 p-0 overflow-hidden">
        <!-- NAV BAR -->
        <?php 
        include './app/components/dashboard_nav_bar.php';
        include './app/components/dashboard_chat_menu_tab.php';
        ?>

        <!-- Content -->
        <div class="container-fluid h-100 ">

            <!-- Large screen view -->
            <div class="row d-flex  d-md-flex flex-nowrap h-100">
                <!-- side menu tab bar -->
                <?php require('./app/components/dashboard_side_menu_tab.php') ?>
                <!--main content -->
                <div class=" col-12  col-md-6 col-lg-7  px-sm-0 py-md-2 py-0 px-0">
                    <div style="height: 100%; " class="h-100 rounded bg-white shadow">
                        <!-- Default -->
                        <!-- <?php #require 'tabs/home_tab.php'; 
                                ?> -->
                        <div id="find-friends-tab" style="height:100% !important;"
                            class=" menu-tab-content h-100 container-fluid rounded p-0  overflow-hidden">
                        </div>
                        <!-- Chat Requests -->
                        <div id="chat-requests-tab"
                            class=" menu-tab-content container-fluid rounded p-0 h-100  position-relative">
                        </div>
                        <?php #require 'tabs/requests_tab.php'; 
                        ?>

                        <!-- Settings -->
                        <div id="settings-tab"
                            class=" menu-tab-content h-100 container-fluid rounded  position-relative">
                            <h2 class="position-absolute top-50 start-50 translate-middle text-secondary">Settings</h2>
                        </div>

                        <!-- About -->
                        <div id="about-tab"
                            class=" menu-tab-content h-100 container-fluid rounded position-relative">
                            <h2 class="position-absolute top-50 start-50 translate-middle text-secondary">About</h2>
                        </div>

                        <!-- Messages -->
                        <?php require 'tabs/chat_messages_tab.php'; ?>


                    </div>
                </div>
                <!-- Messages menu  -->
                <div class="d-none d-md-block col-4 col-sm-4 col-md-3 col-lg-3  p-2">
                    <div class="h-100 d-flex flex-column overflow-hidden  rounded bg-white shadow py-2 position-relative">
                        <div class="d-flex flex-row justify-content-between px-3">
                            <span class="p-2  h4 user-select-none text-dark">
                                Chats
                            </span>
                            <button class="btn btn-sm  text-primary fw-semibold" onclick="getChatRooms()">refresh</button>
                        </div>
                        <ol class="list-group flex-grow-1 gap-1 list-group-flush overflow-y-scroll" id="chat-room-tab">
                        </ol>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>