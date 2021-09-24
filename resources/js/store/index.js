import { createStore } from 'vuex';
import auth from './modules/auth';
import category from './modules/category';
import tasks from './modules/tasks';

export default createStore({
  modules: {
    auth,
    category,
    tasks,
  },
  strict: false,
});
