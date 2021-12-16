<?php require_once '../src/views/include/header.php'; ?>
    <h1>TODOS CALENDAR</h1>
    <div id="calendar"></div>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Chose Status Event</h4>
                </div>
                <div class="modal-body radioStatus">
                    <div class="form-check form-check-inline">
                        <input name="status" class="form-check-input" type="radio" id="inlineCheckbox1" value="1">
                        <label class="form-check-label" for="inlineCheckbox1">Planning</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="status" class="form-check-input" type="radio" id="inlineCheckbox2" value="2">
                        <label class="form-check-label" for="inlineCheckbox2">Doing</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input name="status" class="form-check-input" type="radio" id="inlineCheckbox3" value="3">
                        <label class="form-check-label" for="inlineCheckbox3">Complete</label>
                    </div>
                    <input type="hidden" class="idEvent">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
<?php require_once '../src/views/include/footer.php'; ?>