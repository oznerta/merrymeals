<script>
import { ref } from "vue";
import { useForm, usePage } from "@inertiajs/vue3";
import KitchenLayout from "../Layouts/KitchenLayout.vue";
import {
    Card,
    CardContent,
    CardFooter,
    CardHeader,
    CardTitle,
} from "../../shadcn/ui/card";
import { Button } from "../../shadcn/ui/button";
import { Input } from "../../shadcn/ui/input";
import { Textarea } from "../../shadcn/ui/textarea";
import KitchenMenu from "../../SharedComponent/KitchenMenu.vue";

export default {
    components: {
        Button,
        Card,
        CardContent,
        CardFooter,
        CardHeader,
        CardTitle,
        KitchenLayout,
        Input,
        Textarea,
        KitchenMenu,
    },
    props: {
        menus: {
            type: Array,
            required: true,
        },
    },
    methods: {
        getMenuImageUrl(imagePath) {
            return `/storage/${imagePath}`;
        },
        deleteMenu(menuId) {
            this.$inertia.delete(`/menus/${menuId}`, {
                onSuccess: () => {
                    // Remove the menu from the list after successful deletion
                    this.menus = this.menus.filter(
                        (menu) => menu.id !== menuId
                    );
                },
            });
        },
    },
    setup() {
        const fileInputRef = ref(null);

        const showForm = ref(false);
        const form = useForm({
            meal_name: "",
            description: "",
            image: null,
        });

        const toggleForm = () => {
            
            showForm.value = !showForm.value;
        };

        const handleFileChange = (event) => {
            form.image = event.target.files[0];
        };

        const submitForm = () => {
            form.post("/menus", {
                onSuccess: () => {
                    showForm.value = false;
                    form.reset();
                    fileInputRef.value.value = '';
                },
            });
        };

        

        return {
            showForm,
            form,
            toggleForm,
            handleFileChange,
            submitForm,
        };
    },
};
</script>

<template>
    <div class="flex flex-col min-h-screen bg-accent">
        <KitchenLayout />

        <main class="px-8 md-custom:px-24 mt-44 max-w-[1500px] gap-4 mx-auto relative">
            <section class="menu">
                <div class="flex gap-4 between w-full">
                    <h1 class="text-primary text-h3">Menu</h1>
                    <button v-if="menus.length > 0" @click="toggleForm" title="Add new menu"
                        class="bg-transparent border border-primary text-primary px-4 hover:bg-secondary rounded-lg hover:text-accent">
                        
                        <i class="uil uil-plus"></i>
                    </button>
                </div>

                <div v-show="showForm" class="absolute bg-accent rounded-lg w-full mt-10 z-10 max-w-[500px]">
                    <Card>
                        <CardHeader>
                            <CardTitle class="text-primary">Add New Menu</CardTitle>
                        </CardHeader>
                        <CardContent>
                            <form @submit.prevent="submitForm">
                                <div class="mb-4">
                                    <Input v-model="form.meal_name" type="text" id="meal_name" placeholder="Meal Name"
                                        required />
                                </div>
                                <div class="mb-4">
                                    <Textarea v-model="form.description" id="description" placeholder="Description"
                                        required></Textarea>
                                </div>
                                <div class="mb-4">
                                    <Input ref="fileInput" @change="handleFileChange" type="file" id="image" accept="image/*"
                                        required />
                                </div>
                                <CardFooter>
                                    <button type="submit" class="bg-primary text-white px-4 py-2 rounded-md">
                                        Submit
                                    </button>
                                    <button @click="toggleForm"  type="button"
                                        class="ml-2 bg-gray-300 text-gray-700 px-4 py-2 rounded-md">
                                        Cancel
                                    </button>
                                </CardFooter>
                            </form>
                        </CardContent>
                    </Card>
                </div>

                <div class="relative mt-7">

                    <div v-if="menus.length === 0" class="text-center py-10">
                        <img src="../../../assets/empty-menu.png" class="object-cover h-[300px] w-full" alt="">
                        <button @click="toggleForm" class="mt-4 bg-primary text-white px-6 py-2 rounded-md">
                            Add New Menu
                        </button>
                    </div>

                    <div v-else class="grid md-custom:grid-cols-2 gap-4 ">
                        <div v-for="menu in menus" :key="menu.id"
                            class=" grid border rounded-lg  overflow-hidden mb-4 md-custom:grid-cols-2 gap-2 relative ">
                            <!-- Delete Icon -->
                            <button title="Delete menu" @click="deleteMenu(menu.id)"
                                class="absolute bottom-1 right-1 text-accent bg-red-500 border  w-8 h-8 rounded-full">
                                <i class="uil uil-trash"></i>
                            </button>

                            <div class="p-4">
                                <h3 class="text-base text-primary font-semibold mb-2">
                                    {{ menu.meal_name }}
                                </h3>
                                <p class="text-gray-600 text-tiny max-w-sm break-words">
                                    {{ menu.description }}
                                </p>
                            </div>

                            <div class="overflow-hidden my-auto p-3 rounded-lg">
                                <img :src="getMenuImageUrl(menu.image)" :alt="menu.meal_name + ' Image'"
                                class=" w-full md-custom:w-42 h-32 rounded-lg md-custom:h-40 object-cover" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>
