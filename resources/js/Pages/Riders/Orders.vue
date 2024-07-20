<script setup lang="ts">
import { ref } from "vue";
import RiderLayout from "../Layouts/RiderLayout.vue";
import OrderBox from "../../SharedComponent/OrderBox.vue";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "../../shadcn/ui/tabs";
import { ScrollArea } from "../../shadcn/ui/scroll-area";
import { usePage } from "@inertiajs/vue3";
import { Button } from "../../shadcn/ui/button";

interface OrderDetails {
    id: number;
    menu: {
        id: number;
        meal_name: string;
        description: string;
        image: string;
    };
    member: {
        id: number;
        first_name: string;
        last_name: string;
        phone_number: string;
        street_address: string;
        city: string;
        state: string;
        postal_code: string;
    };
    notes?: string;
}

// Access shared data from Inertia
const pageProps = usePage().props as unknown as { orders?: OrderDetails[] };
console.log("Orders from Inertia:", pageProps.orders);

// Define methods for accepting and canceling orders
const onAcceptOrder = (orderId: number) => {
    console.log(`Accepting order with ID: ${orderId}`);
};

const onCancelOrder = (orderId: number) => {
    console.log(`Canceling order with ID: ${orderId}`);
};
</script>

<template>
    <div>
        <RiderLayout />
        <main
            class="px-8 mt-20 md-custom:px-24 md-custom:mt-28 max-w-[1500px] mx-auto relative"
        >
            <section class="orders">
                <Tabs default-value="Order-list" class="w-full">
                    <TabsList class="grid w-full grid-cols-2 gap-4">
                        <TabsTrigger value="In-preparation"
                            >In Preparation</TabsTrigger
                        >
                        <TabsTrigger value="Rf-pickup"
                            >Ready for Pick-up</TabsTrigger
                        >
                        <TabsTrigger value="C-orders"
                            >Completed Orders</TabsTrigger
                        >
                    </TabsList>

                    <TabsContent
                        value="In-preparation"
                        class="mt-10 border-t border-text"
                    >
                        <!-- In-preparation content -->
                    </TabsContent>

                    <TabsContent
                        value="Rf-pickup"
                        class="mt-10 border-t border-text"
                    >
                        <!-- Ready for Pick-up content -->
                    </TabsContent>

                    <TabsContent
                        value="C-orders"
                        class="mt-10 border-t border-text"
                    >
                        <!-- Completed Orders content -->
                    </TabsContent>
                </Tabs>
            </section>
        </main>
    </div>
</template>
