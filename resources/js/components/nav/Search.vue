<template>
    <form class="form-inline my-2 my-lg-0">
        <input v-model="param" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
    </form>
</template>

<script>
import { ref, watch } from 'vue';
import tasks from '../../composables/tasks';

export default {
  name: 'Search',
  setup() {
    const param = ref('');

    const { searchTasks } = tasks();
    // eslint-disable-next-line no-unused-vars
    watch(param, (newParam, _prevParam) => {
      if (newParam) searchTasks(newParam);
    });

    return {
      param,
    };
  },
};
</script>

<style scoped>

</style>
