<template>
    <ul class="nav nav-pills todo-nav">
        <li role="presentation" class="nav-item all-task"><a href="#" class="nav-link text-black-50 font-weight-bold">All</a></li>
        <li role="presentation" class="nav-item all-task"><a href="#" class="nav-link text-info font-weight-bold">To Do</a></li>
        <li role="presentation" class="nav-item active-task"><a href="#" class="nav-link font-weight-bold text-warning">In Progress</a></li>
        <li role="presentation" class="nav-item completed-task"><a href="#" class="nav-link text-success font-weight-bold">Done</a></li>
    </ul>
    <div class="todo-list">
        <div class="todo-item todo-item-info align-items-center">
            <div>
                <span>Create theme dsddsdscfwerfrwfvsdfbgdfvsasfdgfhndfs</span>
                <div class="float-right d-flex align-items-center remove-todo-item">
                    <span><i class="fa fa-eye text-primary mx-2" title="Public/Private" style="cursor: pointer; font-size: 15px"></i></span>
                    <i class="fa fa-trash text-danger mx-2" title="Delete Task" style="cursor: pointer; font-size: 15px"></i>
                    <select class="form-control form-control-sm">
                        <option value="done">Done</option>
                        <option value="doing">Doing</option>
                        <option value="todo">To Do</option>
                    </select>
                </div>
            </div>
            <task-comments />
        </div>
        <div class="todo-item todo-item-warning">
            <span>Work on wordpress</span>
            <span class="float-right remove-todo-item"><i class="icon-close text-warning"></i></span>
        </div>

        <div class="todo-item todo-item-success">
            <span>Organize office main department</span>
            <a href="#" class="float-right remove-todo-item"><i class="icon-close"></i></a>
        </div>
        <div class="todo-item">
            <span>Error solve in HTML template</span>
            <a href="#" class="float-right remove-todo-item"><i class="icon-close"></i></a>
        </div>
    </div>
</template>

<script>
import TaskComments from './TaskComments';

export default {
  name: 'Tasks',
  components: { TaskComments },
};
</script>

<style scoped>

</style>
