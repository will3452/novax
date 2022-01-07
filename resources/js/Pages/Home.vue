<template>
    <Head>
        <title>
            Home
        </title>
    </Head>
    <the-hero class="my-16"></the-hero>

    <the-card-container>
        <the-card class="-top-20"></the-card>
        <the-card></the-card>
        <the-card class="-top-20"></the-card>
    </the-card-container>

    <the-services></the-services>

    <the-book-form ></the-book-form>

    <the-footer></the-footer>
</template>

<script>
import TheHero from '../Shared/TheHero.vue';
import TheCardContainer from '../Shared/TheCardContainer.vue';
import TheCard from '../Shared/TheCard.vue';
import TheServices from '../Shared/TheServices.vue';
import TheBookForm from '../Shared/TheBookForm.vue';
import TheFooter from '../Shared/TheFooter.vue';

export default {
    components: {
        TheHero,
        TheCardContainer,
        TheCard,
        TheServices,
        TheBookForm,
        TheFooter,
    },
}


</script>
