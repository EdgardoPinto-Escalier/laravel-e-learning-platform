<!-- Bootstrap modal window -->
<div class="modal fade" id="appModal" tabindex="-1" role="dialog" aria-labelledby="appModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <!-- Modal header-->
            <div class="modal-header">
                <h6 class="modal-title" id="appModalLabel"><!-- Content will be added dynamically here --></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal body-->
            <div class="modal-body">
            <!-- Content will be added dynamically here -->
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btnModalClose" data-dismiss="modal"><i class="far fa-window-close"></i> {{ ("CLOSE") }}</button>
                <button type="button" class="btn btnModal" id="modalAction"><i class="fab fa-telegram-plane"></i> </button>
            </div>
        </div>
    </div>
</div>
