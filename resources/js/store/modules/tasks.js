/* eslint-disable no-shadow,no-param-reassign */
import axios from '../../plugins/axios';

const state = () => ({
  tasks: [],
  pagination: {},
});

const getters = {
  tasks: (state) => state.tasks,
  pagination: (state) => state.pagination,
};

const mutations = {
  SET_TASKS(state, data) {
    state.tasks = data.tasks;
    state.pagination = data.pagination;
  },
  UPDATE_TASKS(state, data) {
    state.tasks = state.tasks.concat(data.tasks);
    state.pagination = data.pagination;
  },
  ADD_TASK(state, value) {
    state.tasks.unshift(value);
  },
  UPDATE_TASK_STATUS(state, task) {
    const index = state.tasks.findIndex((t) => t.slug === task.slug);
    state.tasks[index].status = task.status;
  },
  UPDATE_TASK_VISIBILITY(state, task) {
    const index = state.tasks.findIndex((t) => t.slug === task.slug);
    state.tasks[index].visibility = task.visibility;
  },
  REMOVE_TASK(state, slug) {
    state.tasks = state.tasks.filter((i) => i.slug !== slug);
  },
};

const actions = {
  getTasks({ commit }, url = '/tasks') {
    return axios.get(url).then((response) => {
      commit('SET_TASKS', response.data);
    });
  },
  loadMoreTasks({ commit }, url) {
    return axios.get(url).then((response) => {
      commit('UPDATE_TASKS', response.data);
    });
  },
  updateStatus({ commit }, { slug, status }) {
    return axios.put(`/tasks/${slug}/status`, { status }).then((response) => {
      commit('UPDATE_TASK_STATUS', response.data.task);
    });
  },
  updateVisibility({ commit }, slug) {
    return axios.get(`/tasks/${slug}/visibility`).then((response) => {
      commit('UPDATE_TASK_VISIBILITY', response.data.task);
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
