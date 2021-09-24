<template>
    <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal">Categories</a>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Categories</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <create-category />
                    <ul class="list-unstyled">
                        <template v-if="categories.length > 0">
                            <li v-for="(c, i) of categories" :key="i" class="comment-item p-2 mt-2">{{
                                    c.name }} <i class="fa fa-trash text-danger mx-2 float-right" title="Delete category" style="cursor: pointer; font-size: 15px"></i> </li>
                        </template>
                        <li v-else class="comment-item p-2 mt-2">No Categories yet</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { computed, onMounted } from 'vue';
import { useStore } from 'vuex';
import CreateCategory from '../category/CreateCategory';

export default {
  name: 'Categories',
  components: { CreateCategory },
  setup() {
    const store = useStore();

    onMounted(() => {
      store.dispatch('category/getCategories');
    });

    const categories = computed(() => store.getters['category/categories']);

    return {
      categories,
    };
  },
};
</script>
