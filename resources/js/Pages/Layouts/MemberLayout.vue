<template>
    <BaseLayout>
      <template #default>
        <nav>
          <!-- Member-specific menu -->
          <ul>
            <li><a href="/members/dashboard">Dashboard</a></li>
            <li><a href="/members/profile">Profile</a></li>
            <li><a href="/members/orders">Orders</a></li>
          </ul>
        </nav>
        <slot></slot>
      </template>
    </BaseLayout>
  </template>
  
  <script>
  import BaseLayout from './BaseLayout.vue';
  
  export default {
    name: 'MemberLayout',
    components: {
      BaseLayout,
    },
  };
  </script>
  