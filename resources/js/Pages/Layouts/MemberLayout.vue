<template>
            <header class="text-base">
                <nav
                    class="flex items-center justify-between w-full px-8 py-4 mx-auto shadow  bg-accent"
                    style="
                        position: fixed;
                        top: 0;
                        left: 0;
                        right: 0;
                        z-index: 10;
                    "
                >
                    

                    <div class="flex flex-grow">
                        <a href="/member/dashboard">
                            <img
                                class="w-32 md:w-48"
                                src="../../../assets/logo.png"
                                alt="logo"
                            />
                        </a>
                    </div>
                    <div>
                        <DropdownMenu>
                            <DropdownMenuTrigger> 
                                User
                                <i class="uil uil-angle-down"></i>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent class=" z-50 w-52 px-4 bg-accent">
                                <DropdownMenuItem>
                                    <a
                                        href="/members/dashboard"
                                        class="hover:text-primary"
                                    >
                                        dashboard
                                    </a>
                                </DropdownMenuItem>

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
</template>

<script>
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "../../shadcn/ui/dropdown-menu";

export default {
    name: "MemberLayout",
    components: {
        DropdownMenu,
        DropdownMenuContent,
        DropdownMenuItem,
        DropdownMenuLabel,
        DropdownMenuSeparator,
        DropdownMenuTrigger,
    },
};
</script>
