<template>
    <a-layout id="components-layout-demo-custom-trigger">
      <a-layout-sider v-model="collapsed" :trigger="null" collapsible>
        <div class="logo" style="height:50px !important; "></div>
        <a-menu theme="dark" mode="inline" :default-selected-keys="['1']">
          <a-menu-item key="1" @click="$inertia.visit('/dashboard')">
            <a-icon type="dashboard" />
            <span>Home</span>
          </a-menu-item>
          <a-menu-item key="bell" @click="$inertia.visit('/notifications')">
            <a-icon type="bell" />
            <span>Notifications</span>
          </a-menu-item>
          <a-menu-item key="bookings" @click="$inertia.visit('/dashboard')">
            <a-icon type="retweet" />
            <span>Transactions</span>
          </a-menu-item>
          <a-menu-item key="2">
            <a-icon type="table" />
            <span>Activity Logs</span>
          </a-menu-item>
          <a-menu-item key="3" @click="$inertia.visit('/logout')">
            <a-icon type="logout" />
            <span>Logout</span>
          </a-menu-item>
        </a-menu>
      </a-layout-sider>
      <a-layout>
        <a-layout-header style="background: #fff; padding: 0">
          <a-icon
            style="padding: 1em; "
            :type="collapsed ? 'menu-unfold' : 'menu-fold'"
            @click="() => (collapsed = !collapsed)"
          />
        </a-layout-header>
        <a-layout-content style="height: 100vh !important; background: #fff; padding: 1em; ">
          <slot></slot>
        </a-layout-content>
      </a-layout>
    </a-layout>
  </template>
  <script>
  export default {
    data() {
      return {
        collapsed: false,
      };
    },
  };
  </script>
