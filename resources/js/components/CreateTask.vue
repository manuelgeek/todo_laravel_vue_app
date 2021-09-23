<template>
    <h5>Create New Task</h5>
    <form action="#" class="row px-2 align-items-center">
        <div class="col-md-3 px-1 mt-2">
            <input type="text" class="form-control add-task" placeholder="New Task...">
        </div>
        <div class="col-md-3 px-1 mt-2">
            <select name="category" id="cat" class="form-control">
                <option value="0">None</option>
                <option value="1">Cast</option>
            </select>
        </div>
        <div class="col-md-2 px-1 px-md-4 mt-2">
            <label><input type="checkbox" class="form-check-inline" name="is_public" id="">Make Public</label>
        </div>
        <div class="col-md-2 px-1 mt-2 d-flex justify-content-end">
            <button class="btn btn-info btn-sm">Create</button>
        </div>
    </form>
</template>

<script>
export default {
  name: 'CreateTask',
};
</script>
