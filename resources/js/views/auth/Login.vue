<template>
    <guest>
        <div class="card-body">
            <h4 class="card-title">Login</h4>
            <form id="login" method="POST" class="my-login-validation text-left" @submit.prevent="login">
                <div class="form-group">
                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" v-model="form.email" autofocus="">
                    <div v-if="validateErrors.email" class="invalid-feedback d-block">
                        {{ validateErrors.email[0] }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password
                        <a href="#" class="float-right">
                            Forgot Password?
                        </a>
                    </label>
                    <div style="position:relative" id="eye-password-0">
                        <input id="password" type="password" class="form-control" v-model="form.password" style="padding-right: 60px;">
                        <div v-if="validateErrors.password" class="invalid-feedback d-block">
                            {{ validateErrors.password[0] }}
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox" v-model="form.remember" id="remember" class="custom-control-input">
                        <label for="remember" class="custom-control-label">Remember Me</label>
                    </div>
                </div>

                <div class="form-group m-0">
                    <button type="submit" class="btn btn-primary btn-block" :disabled="loading">
                        Login
                    </button>
                </div>
                <div class="mt-4 text-center">
                    Don't have an account? <router-link :to="{name: 'Register'}">Create One</router-link>
                </div>
            </form>
        </div>
    </guest>
</template>

<script>
import { reactive, ref } from 'vue';
import { useStore } from 'vuex';
import Guest from '../../layouts/Guest';
import axios from '../../plugins/axios';
import router from '../../router';

export default {
  name: 'Login',
  components: { Guest },
  setup() {
    const form = reactive({
      email: '',
      password: '',
      remember: false,
    });
    const validateErrors = ref([]);
    const loading = ref(false);
    const store = useStore();

    const login = async () => {
      loading.value = true;
      validateErrors.value = [];
      const api2 = axios.create();
      await api2.get('/sanctum/csrf-cookie').then(() => {
        axios.post('login', form)
          .then((response) => {
            store.dispatch('auth/signIn', response.data.user).then(() => {
              router.push({ name: 'Home' });
            });
            loading.value = false;
          }).catch((error) => {
            if (error.response && error.response.status === 422) {
              validateErrors.value = error.response.data.errors;
            }
            loading.value = false;
          });
      });
    };

    return {
      form,
      login,
      validateErrors,
      loading,
    };
  },
};
</script>
