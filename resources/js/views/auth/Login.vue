<template>
    <guest>
        <div class="card-body">
            <h4 class="card-title">Login</h4>
            <form method="POST" class="my-login-validation text-left" novalidate="">
                <div class="form-group">
                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="" required="" autofocus="">
                    <div class="invalid-feedback">
                        Email is invalid
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password
                        <a href="#" class="float-right">
                            Forgot Password?
                        </a>
                    </label>
                    <div style="position:relative" id="eye-password-0">
                        <input id="password" type="password" class="form-control" name="password" required="" data-eye="" style="padding-right: 60px;">
                        <div class="invalid-feedback">
                            Password is required
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="custom-checkbox custom-control">
                        <input type="checkbox" name="remember" id="remember" class="custom-control-input">
                        <label for="remember" class="custom-control-label">Remember Me</label>
                    </div>
                </div>

                <div class="form-group m-0">
                    <button type="submit" class="btn btn-primary btn-block">
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
import Guest from '../../layouts/Guest';

export default {
  name: 'Login',
  components: { Guest },
};
</script>

<style scoped>

</style>
