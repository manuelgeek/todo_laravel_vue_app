<template>
    <div class="nav-item dropdown">
        <a class="nav-link dropdown-toggle text-black-50" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ user.name }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="#" @click.prevent="logout">Logout</a>
        </div>
    </div>
</template>

<script>
import { computed } from 'vue';
import { useStore } from 'vuex';
import axios from 'axios';
import router from '../../router';

export default {
  name: 'Avatar',
  setup() {
    const store = useStore();
    const user = computed(() => store.state.auth.user);

    const logout = () => {
      axios.post('logout').then(() => {
        store.dispatch('auth/signOut').then(() => {
          router.push({ name: 'Login' });
        });
      });
    };

    return {
      user,
      logout,
    };
  },
};
</script>

<style scoped>

</style>
