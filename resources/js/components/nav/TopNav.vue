<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
        <div class="container">
            <a class="navbar-brand" href="#">{{ appName }}</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <categories />
                    </li>
                   <category-filter />
                </ul>
                <search />
                <avatar />
            </div>
        </div>
    </nav>
</template>

<script>
import CategoryFilter from './CategoryFilter';
import Search from './Search';
import Avatar from './Avatar';
import Categories from './Categories';

export default {
  name: 'TopNav',
  components: {
    Categories, Avatar, Search, CategoryFilter,
  },
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
