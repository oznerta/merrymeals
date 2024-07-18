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
    <div class="flex flex-col bg-accent text-text min-h-screen py-8 px-4 md:px-8">
        <div class="w-12 mb-10">
            <a href="/" class="flex items-center gap-2 hover:text-primary">
                <i class="uil uil-backspace text-h2"></i>
                Back
            </a>
        </div>

        <div class="flex flex-col items-center justify-center flex-1">
            <div class="flex gap-2 justify-center items-center mb-5">
                <img
                    class="h-[50px]"
                    src="../../../assets/logo-mobile.png"
                    alt="logo"
                />
                <p class=" text-primary font-bold text-[20px]">Meals on Wheels</p>
            </div>
            <div class="text-center">
                <p class="my-2 font-medium text-h3">
                    Log in to your account
                </p>
                <p class="mb-8 text-center text-gray-600 font-base text-smaller">
                    Welcome back! We are so pleased to see you again <i class="uil uil-smile-beam text-[16px]"></i>
                </p>
            </div>
            <div class="w-full max-w-md">
                <form @submit.prevent="login" class="flex flex-col gap-6">
                    <div class="flex flex-col gap-3">
                        <Input
                            type="email"
                            placeholder="Email"
                            v-model="form.email"
                        />
                        <small>{{ form.errors.email }}</small>

                        <Input
                            type="password"
                            placeholder="Password"
                            v-model="form.password"
                        />
                        <small>{{ form.errors.password }}</small>
                    </div>

                    <button
                        class="px-4 py-2 text-base text-white rounded bg-primary hover:bg-secondary"
                        type="submit"
                    >
                        Login
                    </button>
                </form>
            </div>
            <div>
                <p class="mt-4 text-center text-gray-600 text-smaller">
                    Don't have an account?
                    <a href="register" class="underline hover:text-primary"
                        >Register Now!</a
                    >
                </p>
            </div>
        </div>
    </div>
</template>
