<template>
    <ul class="nav nav-pills todo-nav">
        <li role="presentation" class="nav-item all-task"><a href="#" class="nav-link text-info font-weight-bold">To Do</a></li>
        <li role="presentation" class="nav-item active-task"><a href="#" class="nav-link font-weight-bold text-warning">In Progress</a></li>
        <li role="presentation" class="nav-item completed-task"><a href="#" class="nav-link text-success font-weight-bold">Done</a></li>
    </ul>
    <div class="todo-list">
        <div class="todo-item todo-item-info">
            <span>Create theme</span>
            <a href="#" class="float-right remove-todo-item"><i class="fa fa-user"></i></a>
        </div>
        <div class="todo-item todo-item-warning">
            <span>Work on wordpress</span>
            <a href="#" class="float-right remove-todo-item"><i class="icon-close"></i></a>
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
export default {
  name: 'Tasks',
};
</script>

<style scoped>

</style>
