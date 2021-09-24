import { useStore } from 'vuex';
import { reactive, ref } from 'vue';
import axios from '../plugins/axios';

export default function taskComments(task) {
  const store = useStore();
  const form = reactive({
    body: '',
  });
  const validateErrors = ref([]);
  const loading = ref(false);
  const comments = ref(('comments' in task) ? task.comments : []);

  const { slug } = task;

  const getComments = () => {
    axios.get(`/tasks/${slug}/comments`).then((response) => {
      comments.value = response.data.comments;
    });
  };

  const createComment = async () => {
    loading.value = true;
    validateErrors.value = [];
    await axios.post(`/tasks/${slug}/comments`, form)
      .then((response) => {
        comments.value.unshift(response.data.comment);
        loading.value = false;
        form.body = '';
      }).catch((error) => {
        if (error.response && error.response.status === 422) {
          validateErrors.value = error.response.data.errors;
        }
        loading.value = false;
      });
  };

  const deleteComment = async (id) => {
    await axios.delete(`/tasks/${slug}/comments/${id}`, form)
      .then(() => {
        comments.value = comments.value.filter((i) => i.id !== id);
      });
  };

  return {
    comments,
    getComments,
    createComment,
    deleteComment,
    loading,
    form,
    validateErrors,
  };
}
