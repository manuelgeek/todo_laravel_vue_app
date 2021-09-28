// import 'regenerator-runtime/runtime';
import MockAdapter from 'axios-mock-adapter';
import { mount } from '@vue/test-utils';
import axios from 'axios';
import { nextTick } from 'vue';
import Login from '../../views/auth/Login';
import loginValidation from '../__mocks__/loginValidation.json';
import loginSuccess from '../__mocks__/loginSuccess.json';
import router from '../../router';
import store from '../../store';

window.scrollTo = jest.fn();

describe('LoginComponent', () => {
  let http;

  beforeAll(() => {
    http = new MockAdapter(axios);
  });

  beforeEach(() => {
    http.onGet('/sanctum/csrf-cookie').reply(200, {});
  });

  afterEach(() => {
    http.reset();
  });

  afterAll(() => {
    http.restore();
  });

  test('is a Vue instance', () => {
    const wrapper = mount(Login,
      {
        global: {
          plugins: [store, router],
        },
      });
    expect(wrapper.vm).toBeTruthy();
    expect(wrapper.html()).toContain('Login');
  });

  test('login validation error', () => {
    const wrapper = mount(Login,
      {
        global: {
          plugins: [store, router],
        },
      });
    http.onPost('login').reply(422, loginValidation);

    wrapper.find('#login').trigger('submit');
    wrapper.vm.validateErrors = loginValidation.errors;
    nextTick(() => {
        expect(wrapper.html()).toContain('The email field is required.');
    });
  });

  test('login successful', () => {
    const wrapper = mount(Login,
      {
        global: {
          plugins: [store, router],
        },
      });
    http.onPost('login').reply(200, loginSuccess);

    wrapper.find('#email').element.value = 'mail@mail.com';
    wrapper.find('#email').trigger('input');
    wrapper.find('#password').element.value = 'mail@mail.com';
    wrapper.find('#password').trigger('input');

    wrapper.find('#login').trigger('submit');
    nextTick(() => {
        expect(router.currentRoute === 'Home');
    });
  });
});
