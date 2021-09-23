<template>
    <section class="h-100">
        <div class="container h-100">
            <div class="h-100 row justify-content-center align-items-center">
                <div class="card-wrapper">
                    <div class="card fat">
                        <slot></slot>
                    </div>
                    <div class="footer mt-5">
                        Copyright © {{new Date().getFullYear()}} — {{ appName }}
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
  name: 'Guest',
  setup() {
    const appName = process.env.MIX_APP_NAME;
    return {
      appName,
    };
  },
};
</script>

<style scoped>

</style>
