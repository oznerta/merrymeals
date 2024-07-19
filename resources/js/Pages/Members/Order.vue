<script>
import MemberLayout from "../Layouts/MemberLayout.vue";
import KitchenCard from "../../SharedComponent/KitchenCard.vue";

export default {
    components: {
        MemberLayout,
        KitchenCard,
    },
    props: {
        menus: {
            type: Array,
            required: true,
        },
        selectedKitchen: {
            type: Object,
            required: true,
        },
    },
    methods: {
        getMenuImageUrl(imagePath) {
            return `/storage/${imagePath}`;
        },
    },
    
};
</script>

<template>
    <div>
        
    </div>
</template>