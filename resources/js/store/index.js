import { createStore } from 'vuex';
import auth from './modules/auth';
import category from './modules/category';

export default createStore({
  modules: {
    auth,
    category,
  },
  strict: false,
});
