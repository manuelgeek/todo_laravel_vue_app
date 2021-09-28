import MockAdapter from 'axios-mock-adapter';
import axios from 'axios';
import { mount } from '@vue/test-utils';
import Home from '../../views/Home';
import store from '../../store';
import router from '../../router';
import tasks from '../__mocks__/tasks.json';
import categories from '../__mocks__/categories.json';
import loginSuccess from '../__mocks__/loginSuccess.json';

window.scrollTo = jest.fn();

describe('HomeComponent', () => {
  let http;

  beforeAll(() => {
    http = new MockAdapter(axios);
    store.dispatch('auth/signIn', loginSuccess.user);
  });

  beforeEach(() => {
    http.onGet('/tasks').reply(200, tasks);
    http.onGet('/categories').reply(200, categories);
  });

  afterEach(() => {
    http.reset();
  });

  afterAll(() => {
    http.restore();
  });

  test('is a Vue instance', () => {
    const wrapper = mount(Home,
      {
        global: {
          plugins: [store, router],
        },
      });
    expect(wrapper.vm).toBeTruthy();
    expect(wrapper.html()).toContain('Home');
  });
});
