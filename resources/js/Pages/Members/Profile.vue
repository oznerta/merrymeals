<script>
import MemberLayout from "../Layouts/MemberLayout.vue";
import { Input } from "../../shadcn/ui/input";
import { Button } from "../../shadcn/ui/button";

export default {
    components: {
        MemberLayout,
        Input,
        Button,
    },
};
</script>

<script setup>
import { useForm } from "@inertiajs/vue3";

const updateForm = useForm({
    first_name: "",
    last_name: "",
    phone_number: "",
    street_address: "",
    city: "",
    state: "",
    postal_code: "",
});

const updateUser = () => {
    // Send form data to the backend using Inertia
    updateForm.put("/member/profile");
};

const updateEmailForm = useForm({
    email: "",
});

const updateEmail = () => {
    // Send form data to the backend using Inertia
    updateEmailForm.put("/member/profile");
};

const updatePasswordForm = useForm({
    password: "",
    password_confirmation: "",
});

const updatePassword = () => {
    // Send form data to the backend using Inertia
    updatePasswordForm.put("/member/profile");
};
</script>

<template>
    <MemberLayout />

    <main
        class="px-8 md-custom:px-24 mt-44 max-w-[1500px] mx-auto relative mb-11"
    >
        <div class="mb-10">
            <h2 class="mb-5 font-semibold text-secondary">My Profile</h2>

            <form @submit.prevent="updateUser" class="flex flex-col gap-3">
                <div class="flex flex-row gap-3">
                    <Input
                        type="text"
                        v-model="updateForm.first_name"
                        placeholder="First Name"
                        required
                    />
                    <Input
                        type="text"
                        v-model="updateForm.last_name"
                        placeholder="Last Name"
                        required
                    />
                </div>

                <Input
                    type="tel"
                    v-model="updateForm.phone_number"
                    placeholder="Phone Number"
                    required
                />

                <Input
                    type="text"
                    v-model="updateForm.street_address"
                    placeholder="Street"
                    required
                />

                <Input
                    type="text"
                    v-model="updateForm.city"
                    placeholder="City"
                    required
                />

                <Input
                    type="text"
                    v-model="updateForm.state"
                    placeholder="State"
                    required
                />

                <Input
                    type="text"
                    v-model="updateForm.postal_code"
                    placeholder="Postal Code"
                    required
                />

                <Button type="submit" class="bg-primary text-secondary-accent"
                    >Save</Button
                >
            </form>
        </div>

        <hr class="mb-10" />

        <div class="mb-10">
            <h2 class="mb-5 font-semibold text-secondary">Change Email</h2>
            <form @submit.prevent="updateEmail" class="flex flex-col gap-3">
                <Input
                    type="email"
                    v-model="updateEmailForm.email"
                    placeholder="Email"
                />
                <Button type="submit" class="bg-primary text-secondary-accent"
                    >Save</Button
                >
            </form>
        </div>

        <hr class="mb-10" />

        <div>
            <h2 class="mb-5 font-semibold text-secondary">Change Password</h2>
            <form @submit.prevent="updatePassword" class="flex flex-col gap-3">
                <Input
                    v-model="updatePasswordForm.password"
                    type="password"
                    placeholder="Password"
                />
                <Input
                    v-model="updatePasswordForm.password_confirmation"
                    type="password"
                    placeholder="Confirm Password"
                />
                <Button type="submit" class="bg-primary text-secondary-accent">
                    Save
                </Button>
            </form>
        </div>
    </main>
</template>
