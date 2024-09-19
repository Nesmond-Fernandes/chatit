<nav class="navbar bg-body-tertiary shadow-sm rounded d-block d-md-none">
    <div class="container-fluid">
        <a class="navbar-brand text-primary" href="#offcanvasExample2" aria-controls="offcanvasExample2" data-bs-toggle="offcanvas"><b>Chat !t</b></a>
        <div>
            <!-- <button class="btn btn-outline-danger me-2 d-none d-sm-block " id="logout" onclick="logout()" type="button">Logout</button> -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header ps-0">
                    <!-- <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Chat !t</h5> -->
                    <p class="px-3 fs-3 pt-3 mx-1 h4 user-select-none text-primary">
                        <strong>Chat !t</strong>
                    </p>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>

                <!-- list of navigations -->
                <div class="offcanvas-body p-0">
                    <ul class="list-group  gap-1 list-group-flush p-0">
                        <!-- <li class="list-group-item border-0 text-start rounded btn btn-outline-dark active">Messages</li> -->
                        <li data-bs-dismiss="offcanvas" onclick="showMainContent(this,'find-friends-tab')" id="default-menu-tab-link"
                            class=" active menu-tab-link list-group-item  text-start  btn rounded-0 btn-outline-dark">Recommendation
                        </li>
                        <li data-bs-dismiss="offcanvas" onclick="showMainContent(this,'chat-requests-tab')"
                            class="menu-tab-link list-group-item  text-start  btn rounded-0 btn-outline-dark">Chat Requests
                        </li>
                        <li data-bs-dismiss="offcanvas" onclick="showMainContent(this,'settings-tab')"
                            class="menu-tab-link list-group-item  text-start  btn rounded-0 btn-outline-dark">Settings</li>
                        <li data-bs-dismiss="offcanvas" onclick="showMainContent(this,'about-tab')"
                            class="menu-tab-link list-group-item  text-start  btn rounded-0 btn-outline-dark">About</li>
                        <li data-bs-dismiss="offcanvas" onclick="logout()" class="list-group-item border-0 text-start  btn rounded-0 btn-outline-danger ">Logout
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>
<!-- <script>
        function logout()
        {
            var Xhr = new XMLHttpRequest();
            Xhr.onreadystatechange = function()
            {
                if(this.readyState == 4 && this.status == 200)
                {
                    window.location.reload();
                }
            };
            Xhr.open("GET","/ChatFeature/src/components/logout.php",true);
            Xhr.send();
        }
    </script> -->