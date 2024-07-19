<script setup lang="ts">
import { ref } from "vue";
import KitchenLayout from "../Layouts/KitchenLayout.vue";
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
        <KitchenLayout />
        <main
            class="px-8 mt-20 md-custom:px-24 md-custom:mt-28 max-w-[1500px] mx-auto relative"
        >
            <section class="orders">
                <Tabs default-value="Order-list" class="w-full">
                    <TabsList class="grid w-full grid-cols-2 gap-4">
                        <TabsTrigger value="Order-list">Order List</TabsTrigger>
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

                    <TabsContent value="Order-list" class="border-t-2 mt-10">
                        <ScrollArea class="h-[700px] p-4 rounded-lg">
                            <div class="flex flex-col gap-2 mt-2">
                                <OrderBox
                                    v-for="order in pageProps.orders"
                                    :key="order.id"
                                    :menuName="order.menu.meal_name"
                                    :memberName="`${order.member.first_name} ${order.member.last_name}`"
                                    :memberInfo="{
                                        firstName: order.member.first_name,
                                        lastName: order.member.last_name,
                                        phoneNumber: order.member.phone_number,
                                        streetAddress:
                                            order.member.street_address,
                                        city: order.member.city,
                                        state: order.member.state,
                                        postalCode: order.member.postal_code,
                                        notes: order.notes, // Ensure 'notes' is accessed correctly
                                    }"
                                    :onAcceptOrder="onAcceptOrder"
                                    :onCancelOrder="onCancelOrder"
                                    :orderId="order.id"
                                />
                            </div>
                        </ScrollArea>
                    </TabsContent>

                    <TabsContent
                        value="In-preparation"
                        class="border-t border-text mt-10"
                    >
                        <!-- In-preparation content -->
                    </TabsContent>

                    <TabsContent
                        value="Rf-pickup"
                        class="border-t border-text mt-10"
                    >
                        <!-- Ready for Pick-up content -->
                    </TabsContent>

                    <TabsContent
                        value="C-orders"
                        class="border-t border-text mt-10"
                    >
                        <!-- Completed Orders content -->
                    </TabsContent>
                </Tabs>
            </section>
        </main>
    </div>
</template>
