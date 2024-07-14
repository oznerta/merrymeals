<template>
    <BaseLayout>
      <template #default>
        <nav>
          <!-- Kitchen-specific menu -->
          <ul>
            <li><a href="/kitchens/dashboard">Dashboard</a></li>
            <li><a href="/kitchens/profile">Profile</a></li>
            <li><a href="/kitchens/menus">Menus</a></li>
          </ul>
        </nav>
        <slot></slot>
      </template>
    </BaseLayout>
  </template>
  
  <script>
  import BaseLayout from './BaseLayout.vue';
  
  export default {
    name: 'KitchenLayout',
    components: {
      BaseLayout,
    },
  };
  </script>
  