<script>
import { ref } from "vue";
import MemberLayout from "../Layouts/MemberLayout.vue";
import KitchenCard from "../../SharedComponent/KitchenCard.vue";

export default {
    components: {
        MemberLayout,
        KitchenCard,
    },
    props: {
        menus: {
            type: Array,
            required: true,
        },
        selectedKitchen: {
            type: Object,
            required: true,
        },
        menus: {
            type: Array,
            required: true,
        },
    },
    methods: {
        getMenuImageUrl(imagePath) {
            return `/storage/${imagePath}`;
        },
        deleteMenu(menuId) {
            this.$inertia.delete(`/menus/${menuId}`, {
                onSuccess: () => {
                    // Remove the menu from the list after successful deletion
                    this.menus = this.menus.filter(
                        (menu) => menu.id !== menuId
                    );
                },
            });
        },
    },
};
</script>

<template>
    <div class="flex flex-col min-h-screen bg-accent">
        <MemberLayout />

        <main class="px-8 md-custom:px-24 mt-44 max-w-[1500px] mx-auto relative">

            <section class="restaurant">
                <div>

                    <div class="flex justify-between mb-10">
                       <div>
                        <a href="/member/restaurant" class="flex items-center gap-2 hover:text-primary">
                            <i class="uil uil-backspace text-h2"> </i>
                            Back
                        </a>
                       </div>

                        <div>
                            <KitchenCard v-if="selectedKitchen"
                                    :kitchenName="selectedKitchen.restaurant_name"
                                    :kitchenStreet="selectedKitchen.street_address"
                                    :kitchenCity="selectedKitchen.city"
                                    :kitchenState="selectedKitchen.state"
                                    :kitchenPostalCode="selectedKitchen.postal_code"
                                    :distance="selectedKitchen.distance"
                            />
                        </div>
                    </div>

                    <section class="menu" v-if="selectedKitchen">
                        <h2 class="text-primary text-h3 mb-4">Menu</h2>

                        <div v-if="menus.length === 0" class="text-center py-10">
                            <p class="text-gray-600">No menus found for this kitchen.</p>
                        </div>

                        <div v-else class="grid md-custom:grid-cols-2 gap-2">
                            <div v-for="menu in menus" :key="menu.id"
                                class="bg-transparent border rounded-lg shadow-md border-primary overflow-hidden mb-4 grid md-custom:grid-cols-2 gap-2 p-2 relative">
                                <!-- Add your menu card layout here -->
                                <div class="p-4">
                                    <h3 class="text-base text-primary font-semibold mb-2">
                                        {{ menu.meal_name }}
                                    </h3>
                                    <p class="text-gray-600 text-tiny max-w-sm break-words">
                                        {{ menu.description }}
                                    </p>
                                </div>

                                <img :src="getMenuImageUrl(menu.image)" :alt="menu.meal_name + ' Image'"
                                    class="h-[180px] p-4 rounded-[20px] w-full object-cover my-auto" />
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        </main>
    </div>
</template>
