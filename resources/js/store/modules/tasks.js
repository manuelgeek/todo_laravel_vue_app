/* eslint-disable no-shadow,no-param-reassign */
import axios from '../../plugins/axios';

const state = () => ({
  tasks: [],
});

const getters = {
  tasks: (state) => state.tasks,
};

const mutations = {
  SET_TASKS(state, value) {
    state.tasks = value;
  },
  ADD_TASK(state, value) {
    state.tasks.unshift(value);
  },
  UPDATE_TASK_STATUS(state, task) {
    const index = state.tasks.findIndex((t) => t.slug === task.slug);
    state.tasks[index].status = task.status;
  },
  REMOVE_TASK(state, slug) {
    state.tasks = state.tasks.filter((i) => i.slug !== slug);
  },
};

const actions = {
  getTasks({ commit }) {
    return axios.get('/tasks').then((response) => {
      commit('SET_TASKS', response.data.tasks);
    });
  },
  updateStatus({ commit }, { slug, status }) {
    return axios.put(`/tasks/${slug}/status`, { status }).then((response) => {
      commit('UPDATE_TASK_STATUS', response.data.task);
    });
  },
  deleteTask({ commit }, slug) {
    return axios.delete(`/tasks/${slug}`).then(() => {
      commit('REMOVE_TASK', slug);
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
