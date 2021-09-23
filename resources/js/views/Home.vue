<template>
  <div class="home">
      <top-nav/>
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="card card-white px-1 px-md-3 text-left">
                      <div class="card-body">
                          <create-task />
                          <tasks/>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
import TopNav from '../components/nav/TopNav';
import Tasks from '../components/Tasks';
import CreateTask from '../components/CreateTask';

export default {
  name: 'Home',
  components: { CreateTask, Tasks, TopNav },
};
</script>
