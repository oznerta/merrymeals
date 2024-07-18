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
        <div class="w-12 mb-10">
            <a href="/" class="flex items-center gap-2 hover:text-primary">
                <i class="uil uil-backspace text-h2"> </i>
                Back
            </a>
        </div>

        <div
            class="flex-row p-24 items-center justify-center mx-auto max-w-[1500px]"
        >
            <div class="flex gap-2 justify-center max-w-[1500px]">
                <img
                    class="w-32 h-auto md-custom:w-48"
                    src="../../../assets/logo.png"
                    alt="logo"
                />
                <p class="mb-10 text-primary text-h2">Meals on Wheels</p>
            </div>
            <div>
                <p class="my-2 font-medium text-center text-h3">
                    Log in to your account
                </p>
                <p
                    class="mb-8 text-center text-gray-600 font-base text-smaller"
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
