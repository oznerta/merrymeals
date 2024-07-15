<script>
import { Tabs, TabsContent, TabsList, TabsTrigger } from "../../shadcn/ui/tabs";
import { Input } from '../../shadcn/ui/input';

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

<template>
    <div class="flex flex-col bg-accent text-text py-8 px-4 md:px-8 mx-auto max-w-[1900px]">
        <div class="mb-10">
            <a href="/" class="flex items-center gap-2 hover:text-primary">
                <i class="uil uil-backspace text-h2"> </i>
                Back
            </a>
        </div>

        <div class="">
            Login
            <a href="register">register</a>
            <div>
                <form>
                    <div class="flex flex-col gap-3 w-[1500px]">
                    <Input type="email" name="email" id="email" placeholder="Email"/>
                    <Input type="password" name="password" id="password" placeholder="Password"/>
                </div>
                </form>
            </div> 
        </div>
    </div>
</template>