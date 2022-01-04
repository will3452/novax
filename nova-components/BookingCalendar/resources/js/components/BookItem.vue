<template>
    <div class="w-full mt-2 p-2 border-t-2">
        <div>
            <slot></slot>
        </div>
        <router-link :to="'/resources/bookings/' + book.id" class="block btn-primary btn-default w-full text-center">View Details</router-link>
    </div>
</template>

<script>
export default {
    props: {
        book: Object,
    }
}
</script>
