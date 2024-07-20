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
                    <p class="text-tiny">Accept</p>
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
                <Button
                    class="bg-primary text-accent hover:bg-secondary"
                    @click="handleAcceptOrder"
                >
                    Accept Order
                </Button>
                <Button
                    class="border bg-accent border-primary text-primary hover:bg-secondary hover:text-accent hover:border-none"
                    @click="handleCancelOrder"
                >
                    Reject Order
                </Button>
            </DrawerFooter>
        </DrawerContent>
    </Drawer>
</template>

<script setup lang="ts">
import { defineComponent, ref } from "vue";
import {
    Drawer,
    DrawerClose,
    DrawerContent,
    DrawerDescription,
    DrawerFooter,
    DrawerHeader,
    DrawerTitle,
    DrawerTrigger,
} from "../shadcn/ui/drawer";
import { Input } from "@/shadcn/ui/input";
import { Textarea } from "@/shadcn/ui/textarea";
import { ScrollArea } from "@/shadcn/ui/scroll-area";
import { Button } from "@/shadcn/ui/button";
import axios from "axios";

const props = defineProps<{
    menuName: string;
    memberName: string;
    memberInfo: {
        firstName: string;
        lastName: string;
        phoneNumber: string;
        streetAddress: string;
        city: string;
        state: string;
        postalCode: string;
        notes: string;
    };
    onAcceptOrder: (orderId: number) => void;
    onCancelOrder: (orderId: number) => void;
    orderId: number;
}>();

const isOpen = ref(false);

const handleAcceptOrder = async () => {
    try {
        const response = await axios.post(
            `/api/orders/${props.orderId}/accept`
        );
        if (response.data.success) {
            props.onAcceptOrder(props.orderId);
            console.log("order accepted");
        } else {
            console.error("Failed to accept order:", response.data.error);
        }
    } catch (error) {
        console.error(
            "Failed to accept order:",
            error.response?.data?.message || error.message
        );
    }
};

const handleCancelOrder = async () => {
    try {
        const response = await axios.post(
            `/api/orders/${props.orderId}/cancel`
        );
        if (response.data.success) {
            props.onCancelOrder(props.orderId);
            console.log("Order cancelled");
        } else {
            console.error("Failed to cancel order:", response.data.error);
        }
    } catch (error) {
        console.error(
            "Failed to cancel order:",
            error.response?.data?.message || error.message
        );
    }
};

console.log("Member Info:", props.memberInfo);
</script>

<style>
.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    margin-bottom: 0.5rem;
}

.placeholder-style::placeholder {
    color: #888;
    /* Adjust color as needed */
    font-size: 0.875rem;
    /* Adjust size as needed */
    font-style: italic;
    /* Italicize for better readability */
}
</style>
