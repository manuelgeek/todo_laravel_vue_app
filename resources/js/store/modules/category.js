/* eslint-disable no-shadow,no-param-reassign */
import axios from '../../plugins/axios';

const state = () => ({
  categories: [],
});

const getters = {
  categories: (state) => state.categories,
};

const mutations = {
  SET_CATEGORIES(state, value) {
    state.categories = value;
  },
  ADD_CATEGORY(state, value) {
    state.categories.unshift(value);
  },
  REMOVE_CATEGORY(state, slug) {
    state.categories = state.categories.filter((i) => i.slug !== slug);
  },
};

const actions = {
  getCategories({ commit }) {
    return axios.get('/categories').then((response) => {
      commit('SET_CATEGORIES', response.data.categories);
    });
  },
  deleteCategory({ commit }, slug) {
    return axios.delete(`/categories/${slug}`).then(() => {
      commit('REMOVE_CATEGORY', slug);
    });
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};
