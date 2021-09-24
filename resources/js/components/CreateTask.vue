<template>
    <h5>Create New Task</h5>
    <form action="#" class="row px-2 align-items-center" @submit.prevent="createTask">
        <div class="col-md-3 px-1 mt-2">
            <input type="text" v-model="form.title" class="form-control add-task" placeholder="New Task...">
            <div v-if="validateErrors.title" class="invalid-feedback d-block">
                {{ validateErrors.title[0] }}
            </div>
        </div>
        <div class="col-md-3 px-1 mt-2">
            <select v-model="form.category_id" id="cat" class="form-control">
                <option value="0">None</option>
                <option v-for="(c, i) of categories" :key="i" :value="c.id">{{ c.name }}</option>
            </select>
        </div>
        <div class="col-md-2 px-1 px-md-4 mt-2">
            <label><input type="checkbox" class="form-check-inline" v-model="form.is_public" id="">Make Public</label>
        </div>
        <div class="col-md-2 px-1 mt-2 d-flex justify-content-end">
            <button type="submit" class="btn btn-info btn-sm">Create</button>
        </div>
    </form>
</template>

<script>
import { computed } from 'vue';
import { useStore } from 'vuex';
import tasks from '../composables/tasks';

export default {
  name: 'CreateTask',
  setup() {
    const store = useStore();
    const {
      loading, validateErrors, form, createTask,
    } = tasks();
    const categories = computed(() => store.getters['category/categories']);

    return {
      categories,
      loading,
      validateErrors,
      createTask,
      form,
    };
  },
};
</script>
