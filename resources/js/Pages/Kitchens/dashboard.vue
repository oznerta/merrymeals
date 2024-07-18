<script>
import KitchenLayout from "../Layouts/KitchenLayout.vue";
// shadcn-vue imports
import { Button } from "../../shadcn/ui/button";
import resto_card from "../../Shared_Component/resto_card.vue";

import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "../../shadcn/ui/card";

export default {
    components: {
        resto_card,
        Button,
        Card,
        CardContent,
        CardDescription,
        CardFooter,
        CardHeader,
        CardTitle,
        KitchenLayout,
    },
};
</script>

<template>
    <div class="flex flex-col min-h-screen bg-accent">
        <KitchenLayout/>

        

    </div>
</template>