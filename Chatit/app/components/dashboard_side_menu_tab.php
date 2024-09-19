<div class=" col-3 col-sm-3 col-md-3 col-lg-2  p-2 d-none d-md-block">
    <div class="h-100 conatiner rounded bg-white shadow">
        <p class="px-3 pt-3 mx-1 h4 user-select-none text-primary">
            <strong>Chat !t</strong>
        </p>
        <ul class="list-group  gap-1 list-group-flush p-2">
            <!-- <li class="list-group-item border-0 text-start rounded btn btn-outline-dark active">Messages</li> -->
            <li onclick="showMainContent(this,'find-friends-tab')" id="default-menu-tab-link"
                class=" active menu-tab-link list-group-item border-0 text-start rounded btn btn-outline-dark">Recommendation
            </li>
            <li onclick="showMainContent(this,'chat-requests-tab')"
                class="menu-tab-link list-group-item border-0 text-start rounded btn btn-outline-dark">Chat Requests
            </li>
            <li onclick="showMainContent(this,'settings-tab')"
                class="menu-tab-link list-group-item border-0 text-start rounded btn btn-outline-dark">Settings</li>
            <li onclick="showMainContent(this,'about-tab')"
                class="menu-tab-link list-group-item border-0 text-start rounded btn btn-outline-dark">About</li>
            <li onclick="logout()" class="list-group-item border-0 text-start rounded btn btn-outline-danger ">Logout
            </li>
        </ul>
    </div>
</div>