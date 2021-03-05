const initCreateTask = () => {
    $('#taskCreateModal').modal('show');
};

const collectCreateTaskFormData = () => {
    return {
        task: $('#taskCreateForm .task-name').val().trim(),
    };
};

const createTask = e => {
    e.preventDefault();

    if (!checkFormIsValid($(e.currentTarget))) {
        return false;
    }

    const data = collectCreateTaskFormData();

    return new Promise(resolve => {
        $.ajax({
            url: `${URL}/task`,
            type: 'POST',
            success: function (response) {
                resolve(response);
            },
            data: {...data}
        });
    });
};

const getTask = id => new Promise(resolve => {
    $.ajax({
        url: `${URL}/task/${id}`,
        type: 'GET',
        success: function (response) {
            resolve(response);
        }
    });
});

const fillUpdateForm = task => {
    const $updateForm = $('#taskUpdateForm');

    $updateForm.find('.task-name').val(task.task);
    $updateForm.find('.task-status').prop('checked', task.is_done);
};

const initUpdateTask = e => {
    const id = parseInt($(e.currentTarget).closest('tr').attr('data-id'));

    getTask(id)
        .then(fillUpdateForm)
        .then(() => {
            $('.update-task').data('id', id);
            $('#taskUpdateModal').modal('show');
        });
};

const checkFormIsValid = $form => {
    const validator = $form.parsley();

    validator.validate();

    return validator.isValid();
};

const collectUpdateTaskFormData = () => {
    return {
        task: $('#taskUpdateForm .task-name').val().trim(),
        is_done: $('#taskUpdateForm .task-status').prop('checked') ? 1 : 0
    };
};

const updateTask = e => {
    e.preventDefault();

    if (!checkFormIsValid($(e.currentTarget))) {
        return false;
    }

    const id = parseInt($('.update-task').data('id'));
    const data = collectUpdateTaskFormData();

    return new Promise(resolve => {
        $.ajax({
            url: `${URL}/task/${id}`,
            type: 'PUT',
            success: function (response) {
                resolve(response);
            },
            data: {...data}
        });
    });
};

const initDeleteTask = e => {
    const id = parseInt($(e.currentTarget).closest('tr').attr('data-id'));

    $('.delete-task').data('id', id);

    $('#taskDeleteModal').modal('show');
};

const deleteTask = e => {
    const id = parseInt($(e.currentTarget).data('id'));

    return new Promise(resolve => {
        $.ajax({
            url: `${URL}/task/${id}`,
            type: 'DELETE',
            success: function (response) {
                resolve(response);
            },
        });
    });
};

const resolveTaskStatusBadgeView = ($taskRow, status) => {
    if (parseInt(status) === 1) {
        $taskRow.find('.task-status')
            .removeClass('badge-secondary').addClass('badge-success').text('Done');
    } else if (parseInt(status) === 0) {
        $taskRow.find('.task-status')
            .removeClass('badge-success').addClass('badge-secondary').text('In progress');
    }
};

const renderCreatedTask = task => new Promise(resolve => {
    const $taskView = $('#createdTaskTableRowLayout').clone();

    $taskView.attr('data-id', task.id).find('.task-id').text(task.id);
    $taskView.find('.task-name').text(task.task);

    resolveTaskStatusBadgeView($taskView, task.is_done);

    $(`#tasksTable tbody`).prepend($taskView);
    resolve(true);
});

const renderUpdatedTask = task => {
    const $taskView = $(`#tasksTable tr[data-id=${task.id}]`);

    $taskView.find('.task-name').text(task.task);
    resolveTaskStatusBadgeView($taskView, task.is_done);
};

const hideDeletedTask = id => new Promise(resolve => {
    $(`#tasksTable tr[data-id=${id}]`).remove();
    resolve(true);
});

const renderNoTasksMessage = () => {
    const isEmptyTable = $('#tasksTable tbody tr:not(#noTasksYetRowLayout)').length === 0;

    $('#noTasksYetRowLayout')
        .removeClass(isEmptyTable ? 'd-none' : '')
        .addClass(isEmptyTable ? '' : 'd-none');
};

$(document).on('click', '.init-create-task', initCreateTask);
$(document).on('submit', '#taskCreateForm', e => createTask(e).then(task => {
    renderCreatedTask(task).then(renderNoTasksMessage);
    $('#taskCreateModal').modal('hide');
}));

$(document).on('click', '.init-update-task', initUpdateTask);
$(document).on('submit', '#taskUpdateForm', e => updateTask(e).then(task => {
    renderUpdatedTask(task);
    $('#taskUpdateModal').modal('hide');
}));

$(document).on('click', '.init-delete-task', initDeleteTask);
$(document).on('click', '.delete-task', e => deleteTask(e).then(isDeleted => {
    hideDeletedTask($('.delete-task').data('id')).then(renderNoTasksMessage);
    $('#taskDeleteModal').modal('hide');
}));

$(document).on('hidden.bs.modal', '#taskCreateModal, #taskUpdateModal', e => {
    $(e.currentTarget).find('textarea.task-name').val(null);

    $(e.currentTarget).find('form').parsley().reset();
});

$(document).ready(() => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajaxPrefilter((options, originalOptions) => {
        options.data = $.param({...originalOptions.data, _token: $('meta[name="csrf-token"]').prop('content')});
    });
});
