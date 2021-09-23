<template>
    <guest>
        <div class="card-body">
            <h4 class="card-title">Register</h4>
            <form method="POST" class="my-login-validation text-left" @submit.prevent="register">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input id="name" type="text" class="form-control" v-model="form.name" autofocus="">
                    <div v-if="validateErrors.name" class="invalid-feedback d-block">
                        {{ validateErrors.name[0] }}
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" v-model="form.email">
                    <div v-if="validateErrors.email" class="invalid-feedback d-block">
                        {{ validateErrors.email[0] }}
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div style="position:relative" id="eye-password-0">
                        <input id="password" type="password" class="form-control" v-model="form.password" style="padding-right: 60px;">
                        <div v-if="validateErrors.password" class="invalid-feedback d-block">
                            {{ validateErrors.password[0] }}
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password"> Confirm Password</label>
                    <div style="position:relative" id="eye-password-1">
                        <input id="password_confirmation" type="password" class="form-control" v-model="form.password_confirmation" style="padding-right: 60px;">
                    </div>
                </div>

                <div class="form-group m-0">
                    <button type="submit" class="btn btn-primary btn-block" :disabled="loading">
                        Login
                    </button>
                </div>
                <div class="mt-4 text-center">
                    Already have an account? <router-link :to="{name: 'Login'}">Login</router-link>
                </div>
            </form>
        </div>
    </guest>
</template>

<script>
/* eslint-disable no-undef */
import { reactive, ref } from 'vue';
import { useStore } from 'vuex';
import Guest from '../../layouts/Guest';
import router from '../../router';

export default {
  name: 'Register',
  components: { Guest },
  setup() {
    const form = reactive({
      name: '',
      email: '',
      password: '',
      password_confirmation: '',
    });
    const validateErrors = ref([]);
    const loading = ref(false);
    const store = useStore();

    const register = async () => {
      loading.value = true;
      validateErrors.value = [];
      const api2 = axios.create();
      await api2.get(`${process.env.MIX_BASE_URL}/sanctum/csrf-cookie`).then((r) => {
        axios.post('/register', form)
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
      validateErrors,
      loading,
      register,
    };
  },
};
</script>

<style scoped>

</style>
