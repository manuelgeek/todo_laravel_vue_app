import MockAdapter from 'axios-mock-adapter';
import axios from 'axios';
import { mount } from '@vue/test-utils';
import { nextTick } from 'vue';
import CreateTask from '../../components/CreateTask';
import store from '../../store';
import router from '../../router';
import task from '../__mocks__/task.json';
import taskValidation from '../__mocks__/taskValidations.json';
import categories from '../__mocks__/categories.json';
import loginSuccess from '../__mocks__/loginSuccess.json';

window.scrollTo = jest.fn();

describe('CreateTaskComponent', () => {
  let http;

  beforeAll(() => {
    http = new MockAdapter(axios);
    store.dispatch('auth/signIn', loginSuccess.user);
  });

  beforeEach(() => {
    http.onGet('/categories').reply(200, categories);
  });

  afterEach(() => {
    http.reset();
  });

  afterAll(() => {
    http.restore();
  });

  test('is a Vue instance', () => {
    const wrapper = mount(CreateTask,
      {
        global: {
          plugins: [store, router],
        },
      });
    expect(wrapper.vm).toBeTruthy();
    expect(wrapper.html()).toContain('Create');
  });

  test('create task validations', () => {
    const wrapper = mount(CreateTask,
      {
        global: {
          plugins: [store, router],
        },
      });
    http.onPost('/tasks').reply(422, taskValidation);
    wrapper.find('#task').trigger('submit');

    wrapper.vm.validateErrors = taskValidation.errors;
    nextTick(() => {
      expect(wrapper.html()).toContain('The title field is required.');
    });
  });

  test('create task success', () => {
    const wrapper = mount(CreateTask,
      {
        global: {
          plugins: [store, router],
        },
      });
    http.onPost('/tasks').reply(200, task);

    wrapper.find('#title').element.value = 'Go Shopping';
    wrapper.find('#title').trigger('input');

    // wrapper.vm.createTask();
    nextTick(() => {
      wrapper.find('#task').trigger('submit');
    });
  });
});
