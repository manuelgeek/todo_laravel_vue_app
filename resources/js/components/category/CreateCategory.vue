<template>
    <form action="POST" @submit.prevent="createCategory">
        <input type="text" v-model="form.name" class="form-control mt-2 mt-sm-0" placeholder="Add Category ... click Enter to add" :readonly="loading">
        <div v-if="validateErrors.name" class="invalid-feedback d-block">
            {{ validateErrors.name[0] }}
        </div>
    </form>
</template>

<script>
import category from '../../composables/category';

export default {
  name: 'CreateCategory',
  setup() {
    const {
      form, createCategory, loading, validateErrors,
    } = category();

    return {
      createCategory, loading, validateErrors, form,
    };
  },
};
</script>

<style scoped>

</style>
