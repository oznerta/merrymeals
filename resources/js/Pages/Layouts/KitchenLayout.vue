<template>
    <BaseLayout>
        <template #default>
            <header class="text-base">
                <nav
                    class="items-center justify-between w-full px-8 py-4 mx-auto shadow md:hidden md-custom:flex bg-accent"
                    style="
                        position: fixed;
                        top: 0;
                        left: 0;
                        right: 0;
                        z-index: 99;
                    "
                >
                    <div>
                        <a href="/member/dashboard">
                            <img
                                class="mr-20 w-100"
                                src="../../../assets/logo.png"
                                alt="logo"
                            />
                        </a>
                    </div>
                    <div>
                        <DropdownMenu>
                            <DropdownMenuTrigger> User </DropdownMenuTrigger>
                            <DropdownMenuContent class="mt-10 mr-3">
                                <DropdownMenuItem>
                                    <a
                                        href="/members/profile"
                                        class="hover:text-primary"
                                    >
                                        Profile
                                    </a>
                                </DropdownMenuItem>

                                <DropdownMenuItem>
                                    <a
                                        href="/members/orders"
                                        class="hover:text-primary"
                                    >
                                        Orders
                                    </a>
                                </DropdownMenuItem>

                                <DropdownMenuItem>
                                    <a
                                        href="/members/help"
                                        class="hover:text-primary"
                                    >
                                        Help Center
                                    </a>
                                </DropdownMenuItem>

                                <hr />

                                <DropdownMenuItem>
                                    <a href="/logout"> Logout </a>
                                </DropdownMenuItem>
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </div>
                </nav>
            </header>

            <slot></slot>
        </template>
    </BaseLayout>
</template>

<script>
import BaseLayout from "./BaseLayout.vue";
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "../../shadcn/ui/dropdown-menu";

export default {
    name: "KitchenLayout",
    components: {
        DropdownMenu,
        DropdownMenuContent,
        DropdownMenuItem,
        DropdownMenuLabel,
        DropdownMenuSeparator,
        DropdownMenuTrigger,
        BaseLayout,
    },
};
</script>
