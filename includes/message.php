<div class="modal fade" id="messageModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">MESSAGGIO</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="CHIUDI"></button>
            </div>
            <div class="modal-body">
                <p><?php echo(strtoupper(trim($_GET['msg']))); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CHIUDI</button>
            </div>
        </div>
    </div>
</div>