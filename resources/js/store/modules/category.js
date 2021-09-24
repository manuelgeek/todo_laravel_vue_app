/* eslint-disable no-shadow,no-param-reassign */
import axios from '../../plugins/axios';

const state = () => ({
  categories: [],
});

const getters = {
  categories: (state) => state.categories,
};

const mutations = {
  SET_CATEGORY(state, value) {
    state.categories = value;
  },
  ADD_CATEGORY(state, value) {
    state.categories.unshift(value);
  },
};

const actions = {
  getCategories({ commit }) {
    return axios.get('/categories').then((response) => {
      commit('SET_CATEGORY', response.data.categories);
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
