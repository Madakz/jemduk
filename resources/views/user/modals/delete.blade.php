<div class="row">
    <div class="modal fade m-medium" id="modal_delete_{{$users->id}}" tabindex="-1" role="dialog" aria-labelledby="modal-delete-house">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myModalLabel">Delete Agent?</h4>
                </div>
                <div class="modal-body">
                    <p class="s-text">Remove Agent from your list of Agent? </br><span class="p-text">This cannot be undone.</span></p>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('delete_agent', $users->id)}}" class="btn btn-fill btn-danger pull-right"><i class="menu-icon zmdi zmdi-delete zmdi-hc"></i> Delete</a>
                </div>
            </div>
        </div>
    </div>
</div>