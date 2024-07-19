<template>
    <header class="text-base">
        <nav
            class="flex items-center justify-between w-full px-8 py-4 mx-auto shadow md-custom:px-10 bg-accent"
            style="position: fixed; top: 0; left: 0; right: 0; z-index: 10"
        >
            <div class="flex flex-grow">
                <a href="/member/restaurant">
                    <img
                        class="w-32 h-auto md-custom:w-48"
                        src="../../../assets/logo.png"
                        alt="logo"
                    />
                </a>
            </div>
            <div>
                <DropdownMenu>
                    <DropdownMenuTrigger>
                        {{ $page.props.auth.user.first_name }}
                        {{ $page.props.auth.user.last_name }}
                        <i class="uil uil-angle-down"></i>
                    </DropdownMenuTrigger>
                    <DropdownMenuContent
                        class="z-50 px-4 py-2 mr-2 w-52 bg-accent"
                    >
                        <DropdownMenuItem>
                            <a
                                href="/member/profile"
                                class="hover:text-primary"
                            >
                                Profile
                            </a>
                        </DropdownMenuItem>

                        <DropdownMenuItem>
                            <a
                                :href="orderUrl"
                                class="hover:text-primary"
                            >
                                Order
                            </a>
                        </DropdownMenuItem>

                        <DropdownMenuItem>
                            <a
                                href="/member/restaurant"
                                class="hover:text-primary"
                            >
                                Restaurant
                            </a>
                        </DropdownMenuItem>

                        <DropdownMenuItem>
                            <a
                                href="/member/history"
                                class="hover:text-primary"
                            >
                                History
                            </a>
                        </DropdownMenuItem>

                        <DropdownMenuItem>
                            <a href="/member/help" class="hover:text-primary">
                                Help Center
                            </a>
                        </DropdownMenuItem>

                        <hr class="mt-3" />

                        <DropdownMenuItem>
                            <form @submit.prevent="logout" method="post">
                                <button
                                    type="submit"
                                    class="hover:text-primary"
                                >
                                    Logout
                                </button>
                            </form>
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
    name: "KitchenLayout",
    components: {
        DropdownMenu,
        DropdownMenuContent,
        DropdownMenuItem,
        DropdownMenuLabel,
        DropdownMenuSeparator,
        DropdownMenuTrigger,
    },
    data() {
    return {
      orderId: null,
    };
  },
  computed: {
    orderUrl() {
      // Return the URL based on whether there's an order ID
      return this.orderId ? `/member/order/${this.orderId}` : '/member/order';
    },
  },
  async mounted() {
    // Fetch the current order ID from the server or state
    try {
      const response = await fetch('/api/current-order');
      const data = await response.json();
      this.orderId = data.orderId; // Set the order ID
    } catch (error) {
      console.error('Failed to fetch current order:', error);
    }
  },
};
</script>

<!-- logout script -->
<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
});

const logout = () => {
    form.post("/logout", {
        onSuccess: () => {
            this.$inertia.post(route("/logout"));
        },

    });
};
</script>
