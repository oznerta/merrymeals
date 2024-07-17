<script>
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "../shadcn/ui/card";

export default {
    components: {
        Card,
        CardContent,
        CardDescription,
        CardFooter,
        CardHeader,
        CardTitle,
    },
};
</script>

<template>
    <Card class="flex items-center">
        <CardContent class="flex flex-row gap-3">
            <div class="flex flex-col">
                <CardTitle>{$menus.meal_name}</CardTitle>
                <CardDescription>{$menus.description}</CardDescription>
            </div>
            <div>
                <img src="" alt="A photo of a delicious meal" />
            </div>
        </CardContent>
    </Card>
</template>
