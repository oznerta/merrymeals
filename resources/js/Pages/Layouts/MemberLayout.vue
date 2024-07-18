<template>
    <header class="text-base">
      <nav class="flex items-center justify-between w-full px-8 md-custom:px-10 py-4 mx-auto shadow  bg-accent" style="
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                z-index: 10;
            ">
  
  
        <div class="flex flex-grow">
          <a href="/member/dashboard">
            <img class="w-32 h-auto md-custom:w-48" src="../../../assets/logo.png" alt="logo" />
          </a>
        </div>
        <div>
          <DropdownMenu>
            <DropdownMenuTrigger>
              {{ $page.props.auth.user.first_name }} {{ $page.props.auth.user.last_name }}
              <i class="uil uil-angle-down"></i>
            </DropdownMenuTrigger>
            <DropdownMenuContent class="mr-2 z-50 w-52 px-4 py-2 bg-accent">
              <DropdownMenuItem>
                <a href="/members/profile" class="hover:text-primary">
                  Profile
                </a>
              </DropdownMenuItem>
  
              <DropdownMenuItem>
                <a href="/members/orders" class="hover:text-primary">
                  Orders
                </a>
              </DropdownMenuItem>
  
  
              <DropdownMenuItem>
                <a href="/members/orders" class="hover:text-primary">
                  Restaurant
                </a>
              </DropdownMenuItem>
  
              <DropdownMenuItem>
                <a href="/members/history" class="hover:text-primary">
                  History
                </a>
              </DropdownMenuItem>
  
              <DropdownMenuItem>
                <a href="/members/help" class="hover:text-primary">
                  Help Center
                </a>
              </DropdownMenuItem>
  
              <hr class="mt-3" />
  
              <DropdownMenuItem >
                <form method="POST" action="/logout">
                  <button type="submit" class="hover:text-primary">
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
  };
  </script>
  