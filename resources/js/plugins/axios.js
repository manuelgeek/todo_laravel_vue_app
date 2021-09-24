/* eslint-disable no-param-reassign */
import axios from 'axios';
import NProgress from 'nprogress';

axios.interceptors.request.use(async (config) => {
  NProgress.configure({ showSpinner: false });
  NProgress.start();
  config.withCredentials = true;
  config.headers.common['X-Requested-With'] = 'XMLHttpRequest';
  config.baseURL = '/api/v1';

  return config;
});

axios.interceptors.response.use((response) => {
  NProgress.done();
  return response;
});

axios.interceptors.response.use(null, async (error) => {
  NProgress.done();
  if (error.response) {
    /*
        * The request was made and the server responded with a
        * status code that falls out of the range of 2xx
        */
    if (error.response.status === 404) {
      // handle 404
    }
    if (error.response.status === 500 || error.response.status === 502 || error.response.status === 504) {
      // handle error 500
    }
  } else {
    // no internet/ request errors
  }
  return Promise.reject(error);
});

export default axios;
