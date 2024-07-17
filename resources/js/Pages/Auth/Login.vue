<script>
import { Tabs, TabsContent, TabsList, TabsTrigger } from "../../shadcn/ui/tabs";
import { Input } from "../../shadcn/ui/input";

export default {
    components: {
        Tabs,
        TabsContent,
        TabsList,
        TabsTrigger,
        Input,
    },
};
</script>

<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    email: null,
    password: null,
});

const login = () => {
    form.post("/login", {
        onSuccess: (response) => {
            if (response.props.success) {
                window.location.href = response.props.redirect;
            }
        },
        onError: () => form.reset("password"),
    });
};
</script>

<template>
    <div
        class="flex flex-col bg-accent text-text py-8 px-4 md:px-8 mx-auto max-w-[1900px]"
    >
        <div class="mb-10 w-12">
            <a href="/" class="flex items-center gap-2 hover:text-primary">
                <i class="uil uil-backspace text-h2"> </i>
                Back
            </a>
        </div>

        <div
            class="flex-row p-24 items-center justify-center mx-auto max-w-[1500px]"
        >
            <div class="flex gap-2 justify-center max-w-[1500px]">
                <p>[logo]</p>
                <p class="text-primary text-h2 mb-10">Meals on Wheels</p>
            </div>
            <div>
                <p class="text-center font-medium my-2 text-h3">
                    Log in to your account
                </p>
                <p
                    class="text-center font-base mb-8 text-smaller text-gray-600"
                >
                    Welcome back! We are so pleased to see you again :D
                </p>
            </div>
            <div>
                <form 
                    @submit.prevent="login"
                    class="flex flex-col gap-6 max-w-[1500px]"
                    >
                    <div class="flex flex-col gap-3 max-w-[1500px]">
                        <Input
                            type="email"
                            placeholder="Email"
                            class="max-w-[1500px]"
                            v-model="form.email"
                        />
                        <small>{{ form.errors.email }}</small>

                        <Input
                            type="password"
                            placeholder="Password"
                            class="max-w-[1500px]"
                            v-model="form.password"
                        />
                        <small>{{ form.errors.password }}</small>
                    </div>

                    <button
                        class="bg-primary hover:bg-secondary text-white text-base py-2 px-4 rounded"
                        type="submit"
                    >
                        Login
                    </button>
                </form>
            </div>
            <div>
                <p class="text-center mt-4 text-smaller text-gray-600">
                    Don't have an account?
                    <a href="register" class="hover:text-primary underline"
                        >Register Now!</a
                    >
                </p>
            </div>
        </div>
    </div>
</template>
