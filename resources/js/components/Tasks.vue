<template>
    <ul class="nav nav-pills todo-nav">
        <li role="presentation" class="nav-item all-task"><a href="#" class="nav-link text-black-50 font-weight-bold">All</a></li>
        <li role="presentation" class="nav-item all-task"><a href="#" class="nav-link text-info font-weight-bold">To Do</a></li>
        <li role="presentation" class="nav-item active-task"><a href="#" class="nav-link font-weight-bold text-warning">In Progress</a></li>
        <li role="presentation" class="nav-item completed-task"><a href="#" class="nav-link text-success font-weight-bold">Done</a></li>
    </ul>
    <div class="todo-list">
        <template v-if="tasks.length > 0">
            <div v-for="(t, i) in tasks" :key="i" :class="['todo-item align-items-center', statusClass(t.status) ]">
                <div>
                    <span>{{ t.title }}</span><br>
                    <small><strong>{{ t.category.name }}</strong></small>
                    <div class="float-right d-flex align-items-center remove-todo-item">
                        <span @click="changeVisibility(t.slug)">
                            <em :class="['fa text-primary mx-2', t.visibility === 'public' ? 'fa-eye' : 'fa-eye-slash']" title="Public/Private" style="cursor: pointer; font-size: 15px"></em>
                        </span>
                        <em @click="deleteCategory(t.slug)" class="fa fa-trash text-danger mx-2" title="Delete Task" style="cursor: pointer; font-size: 15px"></em>
                        <select v-model="t.status" class="form-control form-control-sm" @change="changeStatus(t.slug, t.status)">
                            <option value="done">Done</option>
                            <option value="doing">Doing</option>
                            <option value="todo">To Do</option>
                        </select>
                    </div>
                </div>
                <task-comments />
            </div>
        </template>
        <div v-else class="todo-item todo-item-info">
            <p>No Tasks Yet !!!</p>
        </div>
    </div>
</template>

<script>
import { computed, onMounted } from 'vue';
import { useStore } from 'vuex';
import TaskComments from './TaskComments';
import taskOps from '../composables/tasks';

export default {
  name: 'Tasks',
  components: { TaskComments },
  setup() {
    const store = useStore();
    onMounted(() => {
      store.dispatch('tasks/getTasks');
    });

    const { changeStatus, changeVisibility, deleteCategory } = taskOps();

    const statusClass = (status) => {
      if (status === 'done') {
        return 'todo-item-success';
      }
      if (status === 'doing') {
        return 'todo-item-warning';
      }
      return 'todo-item-info';
    };

    const tasks = computed(() => store.getters['tasks/tasks']);

    return {
      tasks,
      statusClass,
      changeStatus,
      changeVisibility,
      deleteCategory,
    };
  },
};
</script>
