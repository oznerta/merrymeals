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
    <Card>
        <CardHeader class="mb-5 bg-primary text-secondary-accent">
            <CardTitle
                ><h3 id="restaurant_name">{$kitchens.restaurant_name}</h3>
            </CardTitle>
        </CardHeader>

        <CardContent><p id="address">{$kitchens.address}</p> </CardContent>
    </Card>
</template>
