import { computed, reactive, ref } from 'vue';
import { useStore } from 'vuex';
import axios from '../plugins/axios';

export default function tasks() {
  const form = reactive({
    title: '',
    category_id: 0,
    is_public: false,
  });

  const validateErrors = ref([]);
  const loading = ref(false);
  const loadingMore = ref(false);
  const store = useStore();

  const createTask = () => {
    loading.value = true;
    validateErrors.value = [];
    axios.post('/tasks', form)
      .then((response) => {
        store.commit('tasks/ADD_TASK', response.data.task);
        loading.value = false;
        form.title = '';
        form.category_id = 0;
        form.is_public = false;
      }).catch((error) => {
        if (error.response && error.response.status === 422) {
          validateErrors.value = error.response.data.errors;
        }
        loading.value = false;
      });
  };

  const changeStatus = async (slug, status) => {
    await store.dispatch('tasks/updateStatus', { slug, status });
  };

  const changeVisibility = async (slug) => {
    await store.dispatch('tasks/updateVisibility', slug);
  };

  const deleteCategory = async (slug) => {
    await store.dispatch('tasks/deleteTask', slug);
  };

  const pagination = computed(() => store.getters['tasks/pagination']);

  const loadMore = async () => {
    loadingMore.value = true;
    if (pagination.value.next_page !== null) {
      await store.dispatch('tasks/loadMoreTasks', pagination.value.next_page_url).then(() => {
        loadingMore.value = false;
      });
    } else {
      loadingMore.value = false;
    }
  };

  // ? filtering is done in backend due to paginated data
  const filterWithStatus = async (status) => {
    await store.dispatch('tasks/getTasks', `/tasks?status=${status}`);
  };

  const filterWithCategory = async (id) => {
    await store.dispatch('tasks/getTasks', `/tasks?category=${id}`);
  };

  return {
    form,
    loading,
    validateErrors,
    createTask,
    changeStatus,
    changeVisibility,
    deleteCategory,
    loadMore,
    pagination,
    loadingMore,
    filterWithStatus,
    filterWithCategory,
  };
}
