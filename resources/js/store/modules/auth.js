/* eslint-disable no-shadow,no-param-reassign */
import axios from '../../bootstrap';

const state = () => ({
  user: {},
  authenticated: false,
});

const getters = {
  isAuthenticated: (state) => state.authenticated,
  currentUser: (state) => state.user,
};

const mutations = {
  SET_AUTHENTICATED(state, value) {
    state.authenticated = value;
  },
  SET_USER(state, value) {
    state.user = value;
  },
};

const actions = {
  async signIn({ commit }, user) {
    commit('SET_AUTHENTICATED', true);
    commit('SET_USER', user);
  },
  getUser({ commit }) {
    return axios.get('/profile').then((response) => {
      commit('SET_AUTHENTICATED', true);
      commit('SET_USER', response.data.user);
    }).catch(() => {
      commit('SET_AUTHENTICATED', false);
      commit('SET_USER', {});
    });
  },
  signOut({ commit }) {
    commit('SET_AUTHENTICATED', false);
    commit('SET_USER', {});
  },
};

export default {
  namespaced: true,
  state,
  getters,
  actions,
  mutations,
};
