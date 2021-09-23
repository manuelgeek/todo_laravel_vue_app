<template>
    <a class="nav-link" href="#" data-toggle="modal" data-target="#exampleModal">Categories</a>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Categories</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <input type="text" name="comment" class="form-control mt-2 mt-sm-0" placeholder="Add Category ... click Enter to add">
                    </form>
                    <ul class="list-unstyled">
                        <li class="comment-item p-2 mt-2">Lorem ipsum dolor sit amet <i class="fa fa-trash text-danger mx-2 float-right" title="Delete category" style="cursor: pointer; font-size: 15px"></i> </li>
                        <li class="comment-item p-2 mt-2">Lorem ipsum dolor sit amet <i class="fa fa-trash text-danger mx-2 float-right" title="Delete category" style="cursor: pointer; font-size: 15px"></i> </li>
                        <li class="comment-item p-2 mt-2">No Categories yet</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Categories"
}
</script>

<style scoped>

</style>
