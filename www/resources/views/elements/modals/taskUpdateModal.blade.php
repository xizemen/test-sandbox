<div class="modal fade" id="taskUpdateModal" tabindex="-1" role="dialog" style="display: none;"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="#" id="taskUpdateForm" novalidate data-parsley-validate
                  data-parsley-exclude="button[data-dismiss='modal']">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Task name</label>
                        <textarea class="form-control task-name" name="task-name" placeholder="Enter task name" required
                                  maxlength="255"></textarea>
                    </div>
                    <hr>
                    <div class="form-group ml-4 pt-3">
                        <input type="checkbox" name="task-status" class="task-status">
                        <label class="form-check-label text- text-md ml-2">Task is completed</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline btn-outline-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success update-task">Update now</button>
                </div>
            </form>
        </div>
    </div>
</div>
