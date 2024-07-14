<script>
import PrimaryButton from "../../components/Button/primary-button.vue";
import SecondaryButton from "../../components/Button/secondary-button.vue";
import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from "../shadcn/ui/accordion";

export default {
    components: {
        PrimaryButton,
        SecondaryButton,
        Accordion,
        AccordionContent,
        AccordionItem,
        AccordionTrigger
    },
    data() {
        return {
            isMenuOpen: false,
        };
    },
    methods: {
        toggleMenu() {
            this.isMenuOpen = !this.isMenuOpen;
        },
        closeMenu() {
            this.isMenuOpen = false;
        },
    },
};
</script>

<template>
    <div class="min-h-screen flex flex-col">
        <!-- Header -->
        <header class="text-base">
            <nav
                class="bg-accent text-text py-4 px-20 flex items-center shadow sticky"
            >
                <div class="mr-14">
                    <img
                        class="h-auto max-w-full"
                        src="../../assets/logo.png"
                        alt=""
                    />
                </div>

                <!-- Burger Menu (Hamburger Menu) for Mobile -->
                <div class="block lg:hidden">
                    <button
                        @click="toggleMenu"
                        class="text-gray-500 focus:outline-none"
                    >
                        <svg
                            class="h-6 w-6"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"
                            ></path>
                        </svg>
                    </button>
                </div>

                <!-- Navigation Links -->
                <nav class="flex-grow hidden lg:flex">
                    <ul class="flex gap-6 justify-center items-center">
                        <li>
                            <a href="/home">Home</a>
                        </li>
                        <li>
                            <a href="/home">About</a>
                        </li>
                        <li>
                            <a href="/home">Services</a>
                        </li>
                        <li>
                            <a href="/home">Contact</a>
                        </li>
                    </ul>
                </nav>

                <!-- Login and Register Buttons -->
                <div class="flex items-center gap-4 hidden lg:flex">
                    <a href="register" class="hidden md:block">Register</a>
                    <button
                        class="bg-primary text-accent py-2 px-6 rounded-lg md:px-12"
                    >
                        <a href="login" class="text-base md:text-sm">Login</a>
                    </button>
                </div>
            </nav>

            <!-- Burger Menu Content (Hidden by default on larger screens) -->
            <div
                :class="{ block: isMenuOpen, hidden: !isMenuOpen }"
                class="lg:hidden"
            >
                <ul class="flex flex-col gap-4 mt-4">
                    <li>
                        <a href="/home" @click="closeMenu">Home</a>
                    </li>
                    <li>
                        <a href="/home" @click="closeMenu">About</a>
                    </li>
                    <li>
                        <a href="/home" @click="closeMenu">Services</a>
                    </li>
                    <li>
                        <a href="/home" @click="closeMenu">Contact</a>
                    </li>
                </ul>
                <div class="flex justify-center mt-4">
                    <a href="register" class="block text-center">Register</a>
                </div>
                <div class="flex justify-center mt-4">
                    <button class="bg-primary text-accent py-2 px-6 rounded-lg">
                        <a href="login" class="text-base">Login</a>
                    </button>
                </div>
            </div>
        </header>

        <!-- Main Body -->
        
        <main class="flex flex-col bg-secondary-accent text-text py-8 px-32">
            <!-- Hero Section -->
            <section class="hero">
                <div class="flex justify-between items-center">
                    <div class="w-1/2 flex flex-col">
                        <div class="" style="width: 700px">
                            <h1 class="text-primary text-big mb-10 font-semi-bold ">
                                Join Us in Bringing Hope and Warmth
                            </h1>

                            <p class="mb-5 text-base font-normal">
                                At MerryMeal, we believe in the power of a warm
                                meal to nourish both body and soul. Dedicated to
                                serving qualified adults who face challenges in
                                preparing their meals, we deliver not just food,
                                but also compassion and companionship. Together,
                                we're making sure no one is left hungry or
                                forgotten.
                            </p>

                            <div class="flex mb-10 items-center gap-3">
                                <img
                                    src="../../assets/volunteers-img.png"
                                    alt=""
                                />
                                <p>1,600+ dedicated volunteers and counting!</p>
                            </div>

                            <div class="flex gap-4 text-base font-normal">
                                <!-- button div -->
                                <PrimaryButton>
                                    <a href="/">Get your meals</a>
                                </PrimaryButton>
                                <SecondaryButton>
                                    <a href="/">Donate Now</a>
                                </SecondaryButton>
                            </div>
                        </div>
                    </div>

                    <div class="w-1/2">
                        <img
                            class=" "
                            src="../../assets/hero-img.png"
                            alt="image of people doing volunteer work"
                        />
                    </div>
                </div>
            </section>

            <!-- About Us -->

            <section class="about mt-32">
                
                <h3 class="text-primary text-h1 mb-5">About Us</h3>
                <p class="mb-5">
                    We are a charitable organization dedicated to ensuring that
                    qualified adults living at home receive nutritious meals
                    they need. Our mission is driven by the belief that no one
                    should go hungry due to age, illness, or disability.
                </p>

                <h4 class="text-primary text-h3 mb-6">
                    Why Choose Merry Meals
                </h4>

                <Accordion class="mb-5" type="single" collapsible>
                    <AccordionItem value="item-1">
                        <AccordionTrigger>Nutritional Excellence</AccordionTrigger>
                        <AccordionContent>
                            We prioritize the health and well-being of our clients by 
                            preparing and delivering hot, nutritious meals every weekday. 
                            For those outside our immediate service area, frozen meals 
                            ensure consistent support over weekends.
                        </AccordionContent>
                    </AccordionItem>
                </Accordion>
                
                <Accordion class=" mb-5" type="single" collapsible>
                    <AccordionItem value="item-1">
                        <AccordionTrigger>Community Partnership</AccordionTrigger>
                        <AccordionContent>
                            Answer the frequently asked question in a simple sentence, 
                            a longish paragraph, or even in a list.
                        </AccordionContent>
                    </AccordionItem>
                </Accordion>
                
                <Accordion class=" mb-5" type="single" collapsible>
                    <AccordionItem value="item-1">
                        <AccordionTrigger>Volunteer and Partner Engagement</AccordionTrigger>
                        <AccordionContent>
                           A huge community of partner and volunteer workers, coming together for a cause.
                        </AccordionContent>
                    </AccordionItem>
                </Accordion>
                
                <Accordion class=" mb-5" type="single" collapsible>
                    <AccordionItem value="item-1">
                        <AccordionTrigger>Transparent Management</AccordionTrigger>
                        <AccordionContent>
                          Transparency in our management ensures every donation is poured into the charity 
                          efforts.
                        </AccordionContent>
                    </AccordionItem>
                </Accordion>
            
                <h4 class="text-primary text-h3 mt-7 mb-5">Join Us in Making a Difference</h4>
                <p class="mb-10">Whether you're considering volunteering, partnering with us, or supporting 
                    our cause through donations, your involvement is vital in helping us 
                    sustain our mission of ending hunger and promoting well-being in our community.
                </p>
                
                <PrimaryButton>Become a Volunteer</PrimaryButton>
            
            </section>

            <!-- Services Section -->

            <section class="Services mt-32">
                <h1 class="text-primary text-h1 mb-10">Our Services</h1>

                <div class="grid grid-cols-2 gap-10 mr-auto ml-auto" style="width: 1500px;">
                    <div class="flex gap-4 bg-secondary-accent p-7 rounded-lg border-b border-primary shadow-md">
                        <div class="overflow-hidden rounded-lg" style="width: 500px; height: 150px;">
                            <img src="../../assets/pic1.jpg" />
                        </div>
                        
                        <div>
                            <h2 class="text-primary text-lg font-medium mb-5">Hot Meal Delivery</h2>
                            <p class="text-base">
                            Enjoy freshly prepared, hot meals delivered to your
                            doorstep every weekday, ensuring comfort and
                            nutrition.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4 bg-secondary-accent p-7 rounded-lg border-b border-primary shadow-md">
                        <div class="overflow-hidden rounded-lg" style="width: 500px; height: 150px;">
                            <img class="w-full h-auto" src="../../assets/pic2.jpg" />
                        </div>
                        <div>
                            <h2 class="text-primary text-lg font-medium mb-5">Frozen Meal Service</h2>
                            <p class="text-base">
                                Receive weekly deliveries of frozen meals, prepared
                                with care to provide you with nutritious options
                                anytime.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4 bg-secondary-accent p-7 rounded-lg border-b border-primary shadow-md">
                        <div class="overflow-hidden rounded-lg" style="width: 500px; height: 150px;">
                            <img class="w-full h-auto" src="../../assets/pic3.jpg" />
                        </div>
                        <div>
                            <h2 class="text-primary text-lg font-medium mb-5">Nutritional Support</h2>
                            <p class="text-base">
                                Benefit from personalized nutritional support
                                tailored to meet your specific dietary needs and
                                health goals.
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-4 bg-secondary-accent p-7 rounded-lg border-b border-primary shadow-md">
                        <div class="overflow-hidden rounded-lg" style="width: 500px; height: 150px;">
                            <img class="w-full h-auto" src="../../assets/pic4.webp" />
                        </div>
                        <div>
                            <h2 class="text-primary text-lg font-medium mb-5">Volunteer Oppurtunities</h2>
                            <p class="text-base">
                                Join our team of volunteers and help us deliver
                                meals and support to those in need. Your time can
                                make a real difference.
                            </p>
                        </div>
                    </div>
                </div>
            </section>


        </main>

        <!-- Footer -->
        <footer class="bg-dark p-4">
            <p class="text-accent">2024 MerryMeal. All rights reserved</p>
        </footer>
    </div>
</template>
