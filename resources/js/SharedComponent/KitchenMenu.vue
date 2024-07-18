<template>
  <div class="flex flex-col">
    <h2 class="text-2xl font-bold mb-4">Menus</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      <div v-for="menu in menus" :key="menu.id" class="bg-white rounded-lg shadow-md overflow-hidden">
        <img :src="menu.image" alt="Menu Image" class="h-64 w-full object-cover">
        <div class="p-4">
          <h3 class="text-lg font-semibold mb-2">{{ menu.meal_name }}</h3>
          <p class="text-gray-600">{{ menu.description }}</p>
        </div>
      </div>
    </div>
    <div class="mt-4">
    </div>
  </div>
</template>

<script>
export default {
  props: {
    menus: {
      type: Array,
      required: true
    }
  }
};
</script>
