import { reactive, ref } from 'vue';
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

  const changeStatus = (slug, status) => {
    store.dispatch('tasks/updateStatus', { slug, status });
  };

  return {
    form,
    loading,
    validateErrors,
    createTask,
      changeStatus
  };
}
