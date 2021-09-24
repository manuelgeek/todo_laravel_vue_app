import { reactive, ref } from 'vue';
import { useStore } from 'vuex';
import axios from '../plugins/axios';
import { clearForm } from '../utils/helpers';

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
        clearForm(form);
      }).catch((error) => {
        if (error.response && error.response.status === 422) {
          validateErrors.value = error.response.data.errors;
        }
        loading.value = false;
      });
  };

  return {
    form,
    loading,
    createCategory,
    validateErrors,
  };
}
