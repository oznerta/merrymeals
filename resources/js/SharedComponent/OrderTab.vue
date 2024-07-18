<template>
    <div
        class="flex justify-between w-full p-5 m-10 text-center rounded-md shadow cursor-pointer bg-slate-500"
    >
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
            <div
                v-for="order in orders"
                :key="menu.id"
                class="overflow-hidden bg-white rounded-lg shadow-md"
            >
                <div class="p-4">
                    <h3 class="mb-2 text-lg font-semibold">
                        {{ order.menu_id }}
                    </h3>
                    <p class="text-gray-600">{{ order.status }}</p>
                </div>
            </div>
            <div class="flex rounded-sm bg-primary text-secondary-accent">
                <slot></slot>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        orders: {
            type: Array,
            required: true,
        },
    },
};
</script>
