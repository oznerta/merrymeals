<script>
import MemberLayout from "../Layouts/MemberLayout.vue";
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
        MemberLayout,
    },
};
</script>

<template>
    <div class="flex flex-col min-h-screen bg-accent">
        <MemberLayout>
            <main
                class="flex flex-col px-4 py-8 mx-auto bg-accent text-text md:px-8"
                style="max-width: 1800px"
            >
                <section
                    class="flex flex-col items-center md-custom:mt-20 md-custom:flex-row"
                    id="main-menu"
                >
                    <div>
                        <div class="mb-5">
                            <h3
                                class="text-base font-bold text-primary md-custom:text-h1"
                            >
                                Restaurants Near You
                            </h3>

                            <p>
                                A wide selection of charitable kitchens ready to
                                serve hot meals ASAP.
                            </p>
                        </div>

                        <div class="flex gap-3 auto-rows-fr">
                            <resto_card></resto_card>
                        </div>
                    </div>
                </section>
            </main>
        </MemberLayout>
    </div>
</template>
