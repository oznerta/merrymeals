<script>
import { ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import {
    Drawer,
    DrawerTrigger,
    DrawerContent,
    DrawerHeader,
    DrawerTitle,
    DrawerDescription,
    DrawerFooter,
    DrawerClose,
} from "../shadcn/ui/drawer";
import { Input } from "@/shadcn/ui/input";
import { Textarea } from "@/shadcn/ui/textarea";
import { ScrollArea } from "@/shadcn/ui/scroll-area";
import { Button } from "@/shadcn/ui/button";

export default {
    components: {
        Input,
        Textarea,
        Button,
        ScrollArea,
        Drawer,
        DrawerTrigger,
        DrawerContent,
        DrawerHeader,
        DrawerTitle,
        DrawerDescription,
        DrawerFooter,
        DrawerClose,
    },
    props: {
        menuName: String,
        memberName: String,
        memberInfo: Object,
        orderId: Number,
        status: String, // Add status prop
        onAcceptOrder: Function,
        onCancelOrder: Function,
        onOrderCooked: Function,
        onOrderPickingUp: Function,
        onOrderOnItsWay: Function,
        onOrderComplete: Function,
    },
    setup(props) {
        const isOpen = ref(false);

        const form = useForm({
            orderId: props.orderId,
        });

        const handleAcceptOrder = () => {
            form.post(`/orders/${props.orderId}/accept`, {
                onSuccess: (response) => {
                    if (response && response.props.success) {
                        props.onAcceptOrder(props.orderId);
                    } else {
                        console.error(
                            response.props.message || "Unknown error"
                        );
                    }
                },
                onError: (errors) => {
                    console.error("Error accepting order");
                },
            });
        };

        const handleCancelOrder = () => {
            form.post(`/orders/${props.orderId}/cancel`, {
                onSuccess: (response) => {
                    if (response && response.props.success) {
                        props.onCancelOrder(props.orderId);
                    } else {
                        console.error(
                            response.props.message || "Unknown error"
                        );
                    }
                },
                onError: (errors) => {
                    console.error("Error cancelling order");
                },
            });
        };

        const handleMarkAsCooked = () => {
            form.post(`/orders/${props.orderId}/cooked`, {
                onSuccess: (response) => {
                    if (response && response.props.success) {
                        props.onOrderCooked(props.orderId);
                    } else {
                        console.error(
                            response.props.message || "Unknown error"
                        );
                    }
                },
                onError: (errors) => {
                    console.error("Error marking as cooked");
                },
            });
        };

        const handleMarkAsPickingUp = () => {
            form.post(`/rider/${props.orderId}/pickup`, {
                onSuccess: (response) => {
                    if (response && response.props.success) {
                        props.onOrderPickingUp(props.orderId);
                    } else {
                        console.error(
                            response.props.message || "Unknown error"
                        );
                    }
                },
                onError: (errors) => {
                    console.error("Error marking as picking up");
                },
            });
        };

        const handleMarkAsOnItsWay = () => {
            form.post(`/rider/${props.orderId}/on-its-way`, {
                onSuccess: (response) => {
                    if (response && response.props.success) {
                        props.onOrderOnItsWay(props.orderId);
                    } else {
                        console.error(
                            response.props.message || "Unknown error"
                        );
                    }
                },
                onError: (errors) => {
                    console.error("Error marking as on its way");
                },
            });
        };

        const handleMarkAsComplete = () => {
            form.post(`/orders/${props.orderId}/complete`, {
                onSuccess: (response) => {
                    if (response && response.props.success) {
                        props.onOrderComplete(props.orderId);
                    } else {
                        console.error(
                            response.props.message || "Unknown error"
                        );
                    }
                },
                onError: (errors) => {
                    console.error("Error marking as complete");
                },
            });
        };

        const getButtonText = () => {
            switch (props.status) {
                case "pending":
                    return "Accept Order";
                case "accepted":
                    return "In Preparation";
                case "in preparation":
                    return "Ready for Pickup";
                case "ready for pickup":
                    return "picking up";
                case "picking up":
                    return "On Its Way";
                case "on its way":
                    return "Completed";
                default:
                    return "Order Completed";
            }
        };

        return {
            isOpen,
            handleAcceptOrder,
            handleCancelOrder,
            handleMarkAsCooked,
            handleMarkAsOnItsWay,
            handleMarkAsPickingUp,
            handleMarkAsComplete,
            getButtonText,
        };
    },
};
</script>

<template>
    <Drawer v-model:open="isOpen">
        <DrawerTrigger
            class="p-4 text-left border rounded-lg bg-accent hover:text-primary"
        >
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-base">{{ menuName }}</p>
                    <p class="text-small">{{ memberName }}</p>
                </div>
                <div>
                    <p class="text-tiny">{{ getButtonText() }}</p>
                </div>
            </div>
        </DrawerTrigger>
        <DrawerContent>
            <DrawerHeader>
                <DrawerTitle class="mb-5 text-center text-primary"
                    >Order</DrawerTitle
                >
                <DrawerDescription>
                    <ScrollArea class="h-[700px] max-w-[500px] mx-auto p-4">
                        <div class="grid gap-4">
                            <div
                                class="bg-accent grid border rounded-lg overflow-hidden mb-4 md-custom:grid-cols-2 gap-2 relative max-w-[500px]"
                            >
                                <div class="p-4">
                                    <h3
                                        class="mb-2 text-base font-semibold text-primary"
                                    >
                                        Meal Name
                                    </h3>
                                    <p
                                        class="max-w-sm text-gray-600 break-words text-tiny"
                                    >
                                        {{ menuName }}
                                    </p>
                                </div>
                                <div
                                    class="p-3 my-auto overflow-hidden rounded-lg"
                                >
                                    <img
                                        src="../../assets/pic1.jpg"
                                        alt="Image"
                                        class="object-cover w-full h-32 rounded-lg md-custom:w-42 md-custom:h-40"
                                    />
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 mb-[150px]">
                                <p class="mb-5 text-primary">
                                    Customer Personal Information
                                </p>
                                <div class="form-group">
                                    <label for="firstName">First Name</label>
                                    <Input
                                        id="firstName"
                                        :placeholder="
                                            'First Name: ' +
                                            memberInfo.firstName
                                        "
                                        disabled
                                        class="border-primary placeholder-style"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="lastName">Last Name</label>
                                    <Input
                                        id="lastName"
                                        :placeholder="
                                            'Last Name: ' + memberInfo.lastName
                                        "
                                        disabled
                                        class="border-primary placeholder-style"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="phoneNumber"
                                        >Phone Number</label
                                    >
                                    <Input
                                        id="phoneNumber"
                                        :placeholder="
                                            'Phone Number: ' +
                                            memberInfo.phoneNumber
                                        "
                                        disabled
                                        class="border-primary placeholder-style"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="streetAddress"
                                        >Street Address</label
                                    >
                                    <Input
                                        id="streetAddress"
                                        :placeholder="
                                            'Street Address: ' +
                                            memberInfo.streetAddress
                                        "
                                        disabled
                                        class="border-primary placeholder-style"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="city">City</label>
                                    <Input
                                        id="city"
                                        :placeholder="
                                            'City: ' + memberInfo.city
                                        "
                                        disabled
                                        class="border-primary placeholder-style"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="state">State</label>
                                    <Input
                                        id="state"
                                        :placeholder="
                                            'State: ' + memberInfo.state
                                        "
                                        disabled
                                        class="border-primary placeholder-style"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="postalCode">Postal Code</label>
                                    <Input
                                        id="postalCode"
                                        :placeholder="
                                            'Postal Code: ' +
                                            memberInfo.postalCode
                                        "
                                        disabled
                                        class="border-primary placeholder-style"
                                    />
                                </div>

                                <div class="form-group">
                                    <label for="notes">Notes</label>
                                    <Textarea
                                        id="notes"
                                        :placeholder="
                                            'Notes: ' + memberInfo.notes
                                        "
                                        disabled
                                        class="border-primary placeholder-style"
                                    />
                                </div>
                            </div>
                        </div>
                    </ScrollArea>
                </DrawerDescription>
            </DrawerHeader>
            <DrawerFooter>
                <DrawerClose>
                    <!-- Conditionally Render Buttons Based on Status -->
                    <form
                        v-if="status === 'pending'"
                        @submit.prevent="handleAcceptOrder"
                        class="w-full"
                    >
                        <Button
                            type="submit"
                            class="w-full bg-primary text-accent hover:bg-secondary"
                        >
                            Accept Order
                        </Button>
                    </form>

                    <form
                        v-if="status === 'pending'"
                        @submit.prevent="handleCancelOrder"
                        class="w-full"
                    >
                        <Button
                            type="submit"
                            class="w-full border bg-accent border-primary text-primary hover:bg-secondary hover:text-accent hover:border-none"
                        >
                            Reject Order
                        </Button>
                    </form>

                    <form
                        v-if="status === 'in preparation'"
                        @submit.prevent="handleMarkAsCooked"
                        class="w-full"
                    >
                        <Button
                            type="submit"
                            class="w-full bg-primary text-accent hover:bg-secondary"
                        >
                            Ready for Pickup
                        </Button>
                    </form>

                    <form
                        v-if="status === 'ready for pickup'"
                        @submit.prevent="handleMarkAsPickingUp"
                        class="w-full"
                    >
                        <Button
                            type="submit"
                            class="w-full bg-primary text-accent hover:bg-secondary"
                        >
                            Pick up Order
                        </Button>
                    </form>

                    <form
                        v-if="status === 'picking up'"
                        @submit.prevent="handleMarkAsOnItsWay"
                        class="w-full"
                    >
                        <Button
                            type="submit"
                            class="w-full bg-primary text-accent hover:bg-secondary"
                        >
                            Order On Its Way
                        </Button>
                    </form>

                    <form
                        v-if="status === 'on its way' && $page.props.auth.user.role === 'member'"
                        @submit.prevent="handleMarkAsComplete"
                        class="w-full"
                    >
                        <Button
                            type="submit"
                            class="w-full bg-primary text-accent hover:bg-secondary"
                        >
                            Delivered
                        </Button>
                    </form>
                </DrawerClose>
            </DrawerFooter>
        </DrawerContent>
    </Drawer>
</template>
