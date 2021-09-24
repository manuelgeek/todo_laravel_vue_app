import { reactive, ref } from 'vue';
import { useStore } from 'vuex';
import axios from '../plugins/axios';

export default function category() {
  const form = reactive({
    name: '',
  });

  const validateErrors = ref([]);
  const loading = ref(false);
  const store = useStore();

  const createCategory = async () => {
    loading.value = true;
    validateErrors.value = [];
    axios.post('/categories', form)
      .then((response) => {
        store.commit('category/ADD_CATEGORY', response.data.category);
        loading.value = false;
        form.name = '';
      }).catch((error) => {
        if (error.response && error.response.status === 422) {
          validateErrors.value = error.response.data.errors;
        }
        loading.value = false;
      });
  };

  const deleteCategory = async (slug) => {
    await store.dispatch('category/deleteCategory', slug);
  };

  return {
    form,
    loading,
    createCategory,
    validateErrors,
    deleteCategory,
  };
}
