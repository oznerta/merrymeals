<script>
import RiderLayout from "../Layouts/RiderLayout.vue";
import KitchenCard from "../../SharedComponent/KitchenCard.vue";

export default {
    components: {
        RiderLayout,
        KitchenCard,
    },
    computed: {
        nearbyKitchens() {
            return this.$page.props.nearbyKitchens.nearby || [];
        },
        allKitchens() {
            return this.$page.props.nearbyKitchens.all || [];
        }
    },
    methods: {
        navigateToMenu(kitchenId) {
            Inertia.get(`/kitchen/menu/${kitchenId}`); // Adjust this route to your actual route
        }
    }
};
</script>

<template>
    <RiderLayout/>
        <main
            class="px-8 md-custom:px-24 mt-44 max-w-[1500px] mx-auto relative"
        >

            <section class="restaurant">
                <div>
                    <h1 class="mb-5">Nearby Restaurants</h1>
                    <div v-if="nearbyKitchens.length === 0">
                        <p>No nearby restaurants found.</p>
                    </div>
                    <div v-else>
                        <div
                            v-for="kitchen in nearbyKitchens"
                            :key="kitchen.id"
                            class="mb-6"
                        >
                            <KitchenCard
                                :kitchenName="kitchen.restaurant_name"
                                :kitchenStreet="kitchen.street_address"
                                :kitchenCity="kitchen.city"
                                :kitchenState="kitchen.state"
                                :kitchenPostalCode="kitchen.postal_code"
                                :distance="kitchen.distance"
                                @click="navigateToMenu(kitchen.id)"
                            />
                        </div>
                    </div>
                </div>

                <div class="mt-12">
                    <h1>All Restaurants</h1>
                    <div v-if="allKitchens.length === 0">
                        <p>No other restaurants found.</p>
                    </div>
                    <div v-else>
                        <div
                            v-for="kitchen in allKitchens"
                            :key="kitchen.id"
                            class="mb-6"
                        >
                            <KitchenCard
                                :kitchenName="kitchen.restaurant_name"
                                :kitchenStreet="kitchen.street_address"
                                :kitchenCity="kitchen.city"
                                :kitchenState="kitchen.state"
                                :kitchenPostalCode="kitchen.postal_code"
                                :distance="kitchen.distance"
                                @click="navigateToMenu(kitchen.id)"
                            />
                        </div>
                    </div>
                </div>
            </section>
        </main>

</template>
