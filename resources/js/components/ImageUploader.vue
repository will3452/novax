<template>
<div>
    <div class="avatar online relative" @mouseenter="isMouseOver = true" @mouseleave="isMouseOver = false">
        <div class="rounded-full w-32 h-32 bg-gray-200">
            <img :src="image">
        </div>
        <label href="" v-if="isMouseOver" for="image-form" id="upload_link" class="font-bold absolute w-32 h-32 items-center flex justify-center text-center">
            <span class="material-icons">
                file_upload
            </span>
        </label>
    </div>
    <input type="checkbox" id="image-form" class="modal-toggle">
    <div class="modal">
    <form class="modal-box" :action="'/profile-update-picture/' + user" enctype="multipart/form-data" method="POST">
        <slot></slot>
        <input type="file" name="picture" accept="image/*" required>
        <div class="modal-action">
        <button for="image-form" class="btn btn-primary">Upload</button>
        <label for="image-form" class="btn">Cancel</label>
        </div>
    </form>
    </div>
    </div>
</template>

<script>
    export default {
        props:['image', 'user'],
        data(){
            return {
                isMouseOver:false,
            };
        }
    }
</script>
<style scoped>
    .avatar:hover img{
        filter:blur(3px);
    }
    .material-icons {
        font-size: 52px;
    }
    #upload_link {
        cursor: pointer;
    }
</style>
