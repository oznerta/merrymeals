<script>
import { ref } from "vue";
import KitchenLayout from "../Layouts/KitchenLayout.vue";
import OrderBox from "../../SharedComponent/OrderBox.vue";
import { Tabs, TabsContent, TabsList, TabsTrigger } from "../../shadcn/ui/tabs";
import { ScrollArea } from "../../shadcn/ui/scroll-area";
import { usePage } from "@inertiajs/vue3";
import { Button } from "../../shadcn/ui/button";

export default {
    components: {
        KitchenLayout,
        OrderBox,
        Tabs,
        TabsContent,
        TabsList,
        TabsTrigger,
        ScrollArea,
        Button,
    },
    data(){
        return{
            shouldHideButton:true,
        };
    },
    setup() {
        const pageProps = usePage().props;

        const orders = ref(pageProps.orders);
        const inPreparationOrders = ref(pageProps.inPreparationOrders || []);
        const readyForPickupOrders = ref(pageProps.readyForPickupOrders || []);
        const onItsWayOrder = ref(pageProps.onItsWayOrder || []);
        const completedOrders = ref(pageProps.completedOrders || []);

        const moveOrder = (orderId, fromList, toList) => {
            const orderIndex = fromList.value.findIndex(
                (order) => order.id === orderId
            );
            if (orderIndex !== -1) {
                const [order] = fromList.value.splice(orderIndex, 1);
                toList.value.push(order);
            }
        };

        const removeOrder = (orderId, fromList) => {
            const orderIndex = fromList.value.findIndex(
                (order) => order.id === orderId
            );
            if (orderIndex !== -1) {
                fromList.value.splice(orderIndex, 1);
            }
        };

        const onAcceptOrder = (orderId) => {
            Inertia.post(
                `/orders/${orderId}/accept`,
                {},
                {
                    onSuccess: () => {
                        moveOrder(orderId, orders, inPreparationOrders);
                    },
                    onError: () => {
                        // Handle errors if necessary
                    },
                }
            );
        };

        const onCancelOrder = (orderId) => {
            Inertia.post(
                `/orders/${orderId}/cancel`,
                {},
                {
                    onSuccess: () => {
                        removeOrder(orderId, orders);
                        removeOrder(orderId, inPreparationOrders);
                        removeOrder(orderId, readyForPickupOrders);
                        removeOrder(orderId, completedOrders);
                    },
                    onError: () => {
                        // Handle errors if necessary
                    },
                }
            );
        };

        const onOrderCooked = (orderId) => {
            Inertia.post(
                `/orders/${orderId}/cooked`,
                {},
                {
                    onSuccess: () => {
                        moveOrder(
                            orderId,
                            inPreparationOrders,
                            readyForPickupOrders
                        );
                    },
                    onError: () => {
                        // Handle errors if necessary
                    },
                }
            );
        };

        const onOrderOnItsWay = (orderId) => {
            Inertia.post(
                `/orders/${orderId}/on-its-way`,
                {},
                {
                    onSuccess: () => {
                        moveOrder(
                            orderId,
                            readyForPickupOrders,
                            completedOrders
                        );
                    },
                    onError: () => {
                        // Handle errors if necessary
                    },
                }
            );
        };

        const onOrderComplete = (orderId) => {
            Inertia.post(
                `/orders/${orderId}/complete`,
                {},
                {
                    onSuccess: () => {
                        moveOrder(orderId, completedOrders, completedOrders); // You might need to define a new list if there's another status after completion
                    },
                    onError: () => {
                        // Handle errors if necessary
                    },
                }
            );
        };

        return {
            pageProps,
            orders,
            inPreparationOrders,
            readyForPickupOrders,
            onItsWayOrder,
            completedOrders,
            onAcceptOrder,
            onCancelOrder,
            onOrderCooked,
            onOrderOnItsWay,
            onOrderComplete,
        };
    },
};
</script>

<template>
    <div>
        <KitchenLayout />
        <main class="px-8 mt-20 md-custom:px-24 md-custom:mt-28 max-w-[1500px] mx-auto relative">
            <section class="orders">
                <Tabs default-value="Order-list" class="w-full">
                    <TabsList class="grid w-full grid-cols-4 gap-4">
                        <TabsTrigger value="Order-list">Order List</TabsTrigger>
                        <TabsTrigger value="In-preparation">In Preparation</TabsTrigger>
                        <TabsTrigger value="Rf-pickup">Ready for Pick-up</TabsTrigger>
                        <TabsTrigger value="delivering">Picked up Meals</TabsTrigger>
                        <TabsTrigger value="C-orders">Completed Orders</TabsTrigger>
                    </TabsList>

                    <TabsContent value="Order-list" class="mt-10 border-t-2">
                        <ScrollArea class="h-[700px] p-4 rounded-lg">
                            <div class="flex flex-col gap-2 mt-2">
                                <OrderBox v-for="order in orders" :key="order.id" :menuName="order.menu.meal_name" :menuDescription="order.menu.description"
                                    :memberName="`${order.member.first_name} ${order.member.last_name}`" :memberInfo="{
                                        firstName: order.member.first_name,
                                        lastName: order.member.last_name,
                                        phoneNumber: order.member.phone_number,
                                        streetAddress: order.member.street_address,
                                        city: order.member.city,
                                        state: order.member.state,
                                        country: order.member.country,
                                    }" :orderId="order.id" :status="order.status" :onAcceptOrder="onAcceptOrder" :onCancelOrder="onCancelOrder"
                                    :onOrderCooked="onOrderCooked" :onOrderOnItsWay="onOrderOnItsWay"
                                    :onOrderComplete="onOrderComplete" />

                            </div>
                        </ScrollArea>
                    </TabsContent>

                    <TabsContent value="In-preparation" class="mt-10 border-t-2">
                        <ScrollArea class="h-[700px] p-4 rounded-lg">
                            <div class="flex flex-col gap-2 mt-2">
                                <OrderBox v-for="order in inPreparationOrders" :key="order.id" :menuName="order.menu.meal_name" :menuDescription="order.menu.description"
                                    :memberName="`${order.member.first_name} ${order.member.last_name}`" :memberInfo="{
                                        firstName: order.member.first_name,
                                        lastName: order.member.last_name,
                                        phoneNumber: order.member.phone_number,
                                        streetAddress: order.member.street_address,
                                        city: order.member.city,
                                        state: order.member.state,
                                        country: order.member.country,
                                    }" :orderId="order.id" :status="order.status" :onAcceptOrder="onAcceptOrder" :onCancelOrder="onCancelOrder"
                                    :onOrderCooked="onOrderCooked" :onOrderOnItsWay="onOrderOnItsWay"
                                    :onOrderComplete="onOrderComplete" />
                            </div>
                        </ScrollArea>
                    </TabsContent>

                    <TabsContent value="Rf-pickup" class="mt-10 border-t-2">
                        <ScrollArea class="h-[700px] p-4 rounded-lg">
                            <div class="flex flex-col gap-2 mt-2">
                                <OrderBox v-for="order in readyForPickupOrders" :key="order.id" :menuName="order.menu.meal_name" :menuDescription="order.menu.description"
                                    :memberName="`${order.member.first_name} ${order.member.last_name}`" :memberInfo="{
                                        firstName: order.member.first_name,
                                        lastName: order.member.last_name,
                                        phoneNumber: order.member.phone_number,
                                        streetAddress: order.member.street_address,
                                        city: order.member.city,
                                        state: order.member.state,
                                        country: order.member.country,
                                    }" :orderId="order.id" :status="order.status" :onAcceptOrder="onAcceptOrder" :onCancelOrder="onCancelOrder"
                                    :onOrderCooked="onOrderCooked" :onOrderOnItsWay="onOrderOnItsWay" :hideButton="shouldHideButton"
                                    :onOrderComplete="onOrderComplete" />
                            </div>
                        </ScrollArea>
                    </TabsContent>

                    <TabsContent value="delivering" class="mt-10 border-t-2">
                        <ScrollArea class="h-[700px] p-4 rounded-lg">
                            <div class="flex flex-col gap-2 mt-2">
                                <OrderBox v-for="order in onItsWayOrder" :key="order.id" :menuName="order.menu.meal_name" :menuDescription="order.menu.description"
                                    :memberName="`${order.member.first_name} ${order.member.last_name}`" :memberInfo="{
                                        firstName: order.member.first_name,
                                        lastName: order.member.last_name,
                                        phoneNumber: order.member.phone_number,
                                        streetAddress: order.member.street_address,
                                        city: order.member.city,
                                        state: order.member.state,
                                        country: order.member.country,
                                    }" :orderId="order.id" :status="order.status" :onAcceptOrder="onAcceptOrder" :onCancelOrder="onCancelOrder"
                                    :onOrderOnItsWay="onOrderOnItsWay" :hideButton="shouldHideButton"
                                    :onOrderComplete="onOrderComplete" />
                            </div>
                        </ScrollArea>
                    </TabsContent>

                    <TabsContent value="C-orders" class="mt-10 border-t-2">
                        <ScrollArea class="h-[700px] p-4 rounded-lg">
                            <div class="flex flex-col gap-2 mt-2">
                                <OrderBox v-for="order in completedOrders" :key="order.id" :menuName="order.menu.meal_name" :menuDescription="order.menu.description"
                                    :memberName="`${order.member.first_name} ${order.member.last_name}`" :memberInfo="{
                                        firstName: order.member.first_name,
                                        lastName: order.member.last_name,
                                        phoneNumber: order.member.phone_number,
                                        streetAddress: order.member.street_address,
                                        city: order.member.city,
                                        state: order.member.state,
                                        country: order.member.country,
                                    }" :orderId="order.id" :status="order.status" :onAcceptOrder="onAcceptOrder" :onCancelOrder="onCancelOrder"
                                    :onOrderCooked="onOrderCooked" :onOrderOnItsWay="onOrderOnItsWay"
                                    :onOrderComplete="onOrderComplete" />
                            </div>
                        </ScrollArea>
                    </TabsContent>
                </Tabs>
            </section>
        </main>
    </div>
</template>
