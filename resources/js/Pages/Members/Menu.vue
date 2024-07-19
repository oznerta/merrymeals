<script>
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
    },
    methods: {
        getMenuImageUrl(imagePath) {
            return `/storage/${imagePath}`;
        },
    },
    
};
</script>

<template>
    <div class="flex flex-col min-h-screen bg-accent">
        <MemberLayout />

        <main class="px-8 md-custom:px-24 mt-44 max-w-[1500px] mx-auto relative">
            <section class="menu">
                <div>
                    <div class="flex justify-between mb-10">
                        <div>
                            <a href="/member/restaurant" class="flex items-center gap-2 hover:text-primary">
                                <i class="uil uil-backspace text-h2"> </i>
                                Back
                            </a>
                        </div>

                        <div>
                            <KitchenCard v-if="selectedKitchen" :kitchenName="selectedKitchen.restaurant_name"
                                :kitchenStreet="selectedKitchen.street_address" :kitchenCity="selectedKitchen.city"
                                :kitchenState="selectedKitchen.state" :kitchenPostalCode="selectedKitchen.postal_code"
                                :distance="selectedKitchen.distance" :isSelectedKitchen="true" />
                        </div>
                    </div>

                    <section class="menu" v-if="selectedKitchen">
                        <h2 class="text-primary text-h3 mb-4">Menu</h2>

                        <p class="text-smaller mb-4">Choose 1 meal of your choice (1 meal per day)</p>

                        <div v-if="menus.length === 0" class="text-center py-10">
                            <img src="../../../assets/empty-menu-member.png" class="object-cover h-[300px] w-full"
                                alt="" />
                        </div>

                        <div v-else class="grid md-custom:grid-cols-2 gap-8">
                            <div v-for="menu in menus" :key="menu.id"
                                class="bg-accent grid border rounded-lg overflow-hidden mb-4 hover:bg-green-50 hover:scale-105 hover:shadow-lg relative">
                                <!-- Add your menu card layout here -->

                                <a :href="`/member/${selectedKitchen.restaurant_name}/${menu.meal_name}/order`" class="grid md-custom:grid-cols-2 gap-2">
                                    <div class="p-4">
                                        <h3 class="text-base text-primary font-semibold mb-2">
                                            {{ menu.meal_name }}
                                        </h3>
                                        <p class="text-gray-600 text-tiny max-w-sm break-words">
                                            {{ menu.description }}
                                        </p>
                                    </div>

                                    <div class="overflow-hidden my-auto p-3 rounded-lg">
                                        <img :src="getMenuImageUrl(menu.image)" :alt="menu.meal_name + ' Image'"
                                            class="w-full md-custom:w-42 h-32 rounded-lg md-custom:h-40 object-cover" />
                                    </div>
                                </a>
                            </div>
                        </div>
                    </section>
                </div>
            </section>
        </main>
    </div>
</template>
