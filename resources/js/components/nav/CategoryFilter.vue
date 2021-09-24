<template>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Filter with Category
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a v-for="(c, i) of categories" :key="i" class="dropdown-item" href="#" @click.prevent="filterWithCategory(c.id)">{{ c.name }}</a>
        </div>
    </li>
</template>

<script>
import { computed } from 'vue';
import { useStore } from 'vuex';
import tasks from '../../composables/tasks';

export default {
  name: 'CategoryFilter',
  setup() {
    const store = useStore();
    const categories = computed(() => store.getters['category/categories']);

    const { filterWithCategory } = tasks();

    return {
      categories,
      filterWithCategory,
    };
  },
};
</script>

<style scoped>

</style>
