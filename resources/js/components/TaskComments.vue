<template>
    <div class="mt-2">
        <div><a href="#" @click.prevent="showComments">{{!show ? 'Show' : 'Hide'}} Comments</a></div>
        <div v-if="show">

            <form action="POST" @submit.prevent="createComment()">
                <input type="text" v-model="form.body" class="form-control mt-2 mt-sm-0" placeholder="Add Comment ... click Enter to add" :disabled="loading">
                <div v-if="validateErrors.body" class="invalid-feedback d-block">
                    {{ validateErrors.body[0] }}
                </div>
            </form>
            <ul class="list-unstyled">
                <template v-if="comments.length > 0">
                    <li v-for="(c, i) in comments" :key="i" class="comment-item p-2 mt-2">{{
                            c.body }} <em @click="deleteComment(c.id)" class="fa fa-trash text-danger mx-2 float-right" title="Delete comment" style="cursor: pointer; font-size: 15px"></em> </li>
                </template>
                <li v-else class="comment-item p-2 mt-2">No comments yet</li>
            </ul>
        </div>
    </div>
</template>

<script>
import { ref } from 'vue';
import taskComments from '../composables/taskComments';

export default {
  name: 'TaskComments',
  props: ['task'],
  setup(props) {
    const show = ref(false);

    const {
      comments, getComments, loading, form, validateErrors, createComment, deleteComment,
    } = taskComments(props.task);

    const showComments = () => {
      if (!('comments' in props.task)) {
        getComments();
      }
      show.value = !show.value;
    };
    return {
      show,
      comments,
      showComments,
      loading,
      form,
      validateErrors,
      createComment,
      deleteComment,
    };
  },
};
</script>
