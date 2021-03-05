<div class="modal fade" id="taskCreateModal" tabindex="-1" role="dialog" style="display: none;"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create a new task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="taskCreateForm" novalidate data-parsley-validate
                  data-parsley-exclude="button[data-dismiss='modal']">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Task name</label>
                        <textarea class="form-control task-name" name="task-name" placeholder="Enter task name" required
                                  maxlength="255"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success create-task">Create now</button>
                </div>
            </form>
        </div>
    </div>
</div>
