<template>
  <a-col :span="4" style="position: relative; ">
    <a-affix>
        <a-button style="position: absolute; bottom: 10px;" type="link" @click="collapse = ! collapse">
            <a-icon :type="collapse ? 'menu-fold' : 'menu-unfold'"></a-icon>
        </a-button>
        <a-menu  mode="vertical" :inline-collapsed="collapse" style="height: 100vh !important">
        <a-menu-item :key="label" v-for="{label, link, icon} in items" @click="handleClick(link)">
            <a-icon :type="icon" />
            <span>{{label}}</span>
        </a-menu-item>
        </a-menu>
    </a-affix>
  </a-col>
</template>
<script>
export default {
    data () {
        return {
            collapse: false,
        }
    },
    props: [
        'items'
    ],
    methods: {
        handleClick(link) {
            window.location.href = link
        },
  },
};
</script>
