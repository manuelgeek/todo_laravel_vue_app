<template>
    <div class="mt-2">
        <div><a href="#" @click.prevent="show = !show">{{!show ? 'Show' : 'Hide'}} Comments</a></div>
        <div v-if="show">

            <form action="">
                <input type="text" name="comment" class="form-control mt-2 mt-sm-0" placeholder="Add Comment ... click Enter to add">
            </form>
            <ul class="list-unstyled">
                <li class="comment-item p-2 mt-2">Lorem ipsum dolor sit amet <i class="fa fa-trash text-danger mx-2 float-right" title="Delete comment" style="cursor: pointer; font-size: 15px"></i> </li>
                <li class="comment-item p-2 mt-2">Lorem ipsum dolor sit amet <i class="fa fa-trash text-danger mx-2 float-right" title="Delete comment" style="cursor: pointer; font-size: 15px"></i> </li>
                <li class="comment-item p-2 mt-2">No comments yet</li>
            </ul>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';

export default {
  name: 'TaskComments',
  setup() {
    const show = ref(false);
    return {
      show,
    };
  },
};
</script>

<style scoped>

</style>
