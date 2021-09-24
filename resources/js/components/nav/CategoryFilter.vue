<template>
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Filter with Category
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#">Default</a>
            <a v-for="(c, i) of categories" :key="i" class="dropdown-item" href="#">{{ c.name }}</a>
        </div>
    </li>
</template>

<script>
import { computed } from 'vue';
import { useStore } from 'vuex';

export default {
  name: 'CategoryFilter',
  setup() {
    const store = useStore();
    const categories = computed(() => store.getters['category/categories']);

    return {
      categories,
    };
  },
};
</script>

<style scoped>

</style>
