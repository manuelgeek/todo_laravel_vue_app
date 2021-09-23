<template>
    <guest>
        <div class="card-body">
            <h4 class="card-title">Register</h4>
            <form method="POST" class="my-login-validation text-left" novalidate="">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input id="name" type="text" class="form-control" name="name" value="" required="" autofocus="">
                    <div class="invalid-feedback">
                        Name is invalid
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">E-Mail Address</label>
                    <input id="email" type="email" class="form-control" name="email" value="" required="" autofocus="">
                    <div class="invalid-feedback">
                        Email is invalid
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div style="position:relative" id="eye-password-0">
                        <input id="password" type="password" class="form-control" name="password" required="" data-eye="" style="padding-right: 60px;">
                        <div class="invalid-feedback">
                            Password is required
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password"> Confirm Password</label>
                    <div style="position:relative" id="eye-password-1">
                        <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required="" data-eye="" style="padding-right: 60px;">
                    </div>
                </div>

                <div class="form-group m-0">
                    <button type="submit" class="btn btn-primary btn-block">
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
import Guest from '../../layouts/Guest';

export default {
  name: 'Register',
  components: { Guest },
};
</script>

<style scoped>

</style>
