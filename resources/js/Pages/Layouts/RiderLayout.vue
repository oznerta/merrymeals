<template>
    <BaseLayout>
      <template #default>
        <nav>
          <!-- Rider-specific menu -->
          <ul>
            <li><a href="/riders/dashboard">Dashboard</a></li>
            <li><a href="/riders/profile">Profile</a></li>
            <li><a href="/riders/deliveries">Deliveries</a></li>
          </ul>
        </nav>
        <slot></slot>
      </template>
    </BaseLayout>
  </template>
  
  <script>
  import BaseLayout from './BaseLayout.vue';
  
  export default {
    name: 'RiderLayout',
    components: {
      BaseLayout,
    },
  };
  </script>
  