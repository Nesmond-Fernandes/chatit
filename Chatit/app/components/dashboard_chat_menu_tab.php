<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample2" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Chats</h5>
        <button class="btn btn-sm  text-primary border-0 fw-semibold" onclick="getChatRooms()">refresh</button>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body d-flex p-0">
        <!-- Messages menu  -->
        <div class="p-0  flex-grow-1">
            <div class="h-100 d-flex flex-column overflow-hidden  rounded bg-white  py-2 position-relative">
                <ol class="list-group gap-1 list-group-flush overflow-y-scroll" id="chat-room-tab2">
                </ol>
            </div>
        </div>
    </div>
</div>