<!-- Delete Model -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <a href="" type="button" class="btn btn-danger confirmdelete">Delete</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Reject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to Reject?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <a href="" type="button" class="btn btn-danger confirmdelete">Reject</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="staticBackdrop3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure to perform this action?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <a href="" type="button" class="btn btn-info confirmdelete">Comfirm</a>
            </div>
        </div>
    </div>
</div>
<!-- Delete Model -->

<script>
    $(document).ready(function() {
        $(".delete").click(function(e) {
            e.preventDefault();
            var href = $(this).attr("href");

            $(".confirmdelete").attr("href", href);
        })
        $(".reject").click(function(e) {
            e.preventDefault();
            var href = $(this).attr("href");

            $(".confirmdelete").attr("href", href);
        })
        $(".makeactive").click(function(e) {
            e.preventDefault();
            var href = $(this).attr("href");
            console.log(href)

            $(".confirmdelete").attr("href", href);
        })
   


    })
</script>