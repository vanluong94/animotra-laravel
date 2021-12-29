<!-- Confirm delete Modal-->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Confirm Deletion</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Are you sure you want to delete <span class="object-type"></span> <strong>"<span class="object-name"></span>"</strong>?</div>
        <div class="modal-footer">
            <button class="btn btn-secondary btn-icon-split" type="button" data-dismiss="modal">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text text-center">Nope! Bring me back!</span>
            </button>
            <a class="btn btn-danger btn-icon-split object-delete-url" href="#">
                <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text text-center">Go ahead</span>
            </a>
        </div>
    </div>
</div>
</div>