import MockAdapter from 'axios-mock-adapter';
import axios from 'axios';
import { mount } from '@vue/test-utils';
import Tasks from '../../components/Tasks';
import store from '../../store';
import router from '../../router';
import tasks from '../__mocks__/tasks.json';

window.scrollTo = jest.fn();

describe('TaskComponent', () => {
  let http;

  beforeAll(() => {
    http = new MockAdapter(axios);
  });

  beforeEach(() => {
    http.onGet('/tasks').reply(200, tasks);
  });

  afterEach(() => {
    http.reset();
  });

  afterAll(() => {
    http.restore();
  });

  test('is a Vue instance', () => {
    const wrapper = mount(Tasks,
      {
        global: {
          plugins: [store, router],
        },
      });
    expect(wrapper.vm).toBeTruthy();
    expect(wrapper.html()).toContain('Done');
  });
});
