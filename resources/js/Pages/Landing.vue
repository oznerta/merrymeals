<script>
import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from "../shadcn/ui/accordion";

import { Button } from "../shadcn/ui/button";

export default {
    components: {
        Button,
        Accordion,
        AccordionContent,
        AccordionItem,
        AccordionTrigger,
    },

    data() {
        return {
            isMenuOpen: false,
        };
    },
    methods: {
        toggleMenu() {
            this.isMenuOpen = !this.isMenuOpen;
            // Optionally, you can prevent scrolling when the menu is open
            if (this.isMenuOpen) {
                document.body.style.overflow = "hidden";
            } else {
                document.body.style.overflow = "";
            }
        },
    },
};
</script>

<template>
    <div class="min-h-screen flex flex-col bg-accent">
        <!-- Header -->
        <header class="text-base">
            <!-- Desktop Navigation (hidden on smaller screens) -->
            <nav
                class="hidden md-custom:flex items-center w-full bg-accent mx-auto py-4 px-8 shadow"
                style="position: fixed; top: 0; left: 0; right: 0; z-index: 100"
            >
                <div>
                    <img
                        class="w-100 mr-20"
                        src="../../assets/logo.png"
                        alt="logo"
                    />
                </div>

                <div class="flex items-center flex-grow">
                    <ul class="flex gap-16">
                        <li class="hover:text-primary">
                            <a href="#">Home</a>
                        </li>

                        <li class="hover:text-primary">
                            <a href="#">About</a>
                        </li>

                        <li class="hover:text-primary">
                            <a href="#">Services</a>
                        </li>

                        <li class="hover:text-primary">
                            <a href="#">Contact</a>
                        </li>
                    </ul>
                </div>

                <div class="flex items-center gap-8">
                    <div class="hover:text-primary">
                        <a href="register">Register</a>
                    </div>
                    <Button
                        class="bg-primary text-accent py-2 px-14 rounded-lg hover:bg-secondary"
                    >
                        <a href="/">Login</a>
                    </Button>
                </div>
            </nav>

            <!-- Mobile Navigation (visible on smaller screens) -->
            <nav
                class="flex items-center w-full bg-accent mx-auto shadow py-4 px-4 md-custom:hidden"
            >
                <div class="flex flex-grow">
                    <img
                        class="w-32 md:w-48"
                        src="../../assets/logo.png"
                        alt="logo"
                    />
                </div>

                <div class="flex items-center gap-2">
                    <button
                        class="bg-primary text-accent py-2 px-8 md:px-14 rounded-lg hover:bg-secondary"
                    >
                        <a href="/">Login</a>
                    </button>

                    <button
                        @click="toggleMenu"
                        class="flex md-custom:hidden items-center"
                    >
                        <svg
                            class="w-8 h-8 fill-current text-black"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                d="M3.5,7 C3.22385763,7 3,6.77614237 3,6.5 C3,6.22385763 3.22385763,6 3.5,6 L20.5,6 C20.7761424,6 21,6.22385763 21,6.5 C21,6.77614237 20.7761424,7 20.5,7 L3.5,7 Z M3.5,12 C3.22385763,12 3,11.7761424 3,11.5 C3,11.2238576 3.22385763,11 3.5,11 L20.5,11 C20.7761424,11 21,11.2238576 21,11.5 C21,11.7761424 20.7761424,12 20.5,12 L3.5,12 Z M3.5,17 C3.22385763,17 3,16.7761424 3,16.5 C3,16.2238576 3.22385763,16 3.5,16 L20.5,16 C20.7761424,16 21,16.2238576 21,16.5 C21,16.7761424 20.7761424,17 20.5,17 L3.5,17 Z"
                            ></path>
                        </svg>
                    </button>
                </div>
            </nav>

            <!-- Mobile Fullscreen Menu (hidden by default) -->
            <div
                v-if="isMenuOpen"
                class="fixed inset-0 bg-accent flex justify-center items-center z-50"
            >
                <ul class="text-text text-center">
                    <li class="py-4">
                        <a href="#" class="text-xl">Home</a>
                    </li>
                    <li class="py-4">
                        <a href="#" class="text-xl">About</a>
                    </li>
                    <li class="py-4">
                        <a href="#" class="text-xl">Services</a>
                    </li>
                    <li class="py-4">
                        <a href="#" class="text-xl">Contact</a>
                    </li>
                    <li class="py-4">
                        <a href="#" class="text-xl">Register</a>
                    </li>
                </ul>
            </div>
        </header>

        <!-- Main Body -->

        <main
            class="flex flex-col bg-accent text-text py-8 px-4 md:px-8 mx-auto"
            style="max-width: 1900px"
        >
            <section class="hero md:mt-20">
                <div
                    class="flex flex-col-reverse md:flex-row items-center gap-5"
                >
                    <div class="md:w-1/2 flex flex-col">
                        <div style="max-width: 700px">
                            <h1
                                class="text-primary text-h2 mb-5 font-semi-bold md:text-h1 lg:text-big md:mb-10"
                            >
                                Join Us in Bringing Hope and Warmth
                            </h1>

                            <p
                                class="text-small font-normal mb-3 md:text-base md:mb-5"
                            >
                                At MerryMeal, we believe in the power of a warm
                                meal to nourish both body and soul. Dedicated to
                                serving qualified adults who face challenges in
                                preparing their meals, we deliver not just food,
                                but also compassion and companionship. Together,
                                we're making sure no one is left hungry or
                                forgotten.
                            </p>

                            <div
                                class="flex flex-col mb-10 justify-center gap-3 overflow-hidden md:"
                            >
                                <div>
                                    <img
                                        src="../../assets/volunteers-img.png"
                                        alt=""
                                    />
                                </div>
                                <p>1,600+ dedicated volunteers and counting!</p>
                            </div>

                            <div
                                class="flex flex-col gap-4 text-base font-normal md:flex-row"
                            >
                                <button
                                    class="w-full bg-primary text-accent py-2 px-14 rounded-lg hover:bg-secondary"
                                >
                                    <a href="/">Get Your Meals</a>
                                </button>
                                <button
                                    class="w-full bg-transparent text-primary py-2 px-14 rounded-lg border-primary border hover:bg-secondary hover:text-accent"
                                >
                                    <a href="/">Donate Now</a>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="md:w-1/2 w-full mb-4 md:mb-0">
                        <img
                            class="w-full h-auto"
                            src="../../assets/hero-img.png"
                            alt="image of people doing volunteer work"
                        />
                    </div>
                </div>
            </section>

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
                        <AccordionTrigger
                            >Nutritional Excellence</AccordionTrigger
                        >
                        <AccordionContent>
                            We prioritize the health and well-being of our
                            clients by preparing and delivering hot, nutritious
                            meals every weekday. For those outside our immediate
                            service area, frozen meals ensure consistent support
                            over weekends.
                        </AccordionContent>
                    </AccordionItem>
                </Accordion>

                <Accordion class="mb-5" type="single" collapsible>
                    <AccordionItem value="item-1">
                        <AccordionTrigger
                            >Community Partnership</AccordionTrigger
                        >
                        <AccordionContent>
                            Answer the frequently asked question in a simple
                            sentence, a longish paragraph, or even in a list.
                        </AccordionContent>
                    </AccordionItem>
                </Accordion>

                <Accordion class="mb-5" type="single" collapsible>
                    <AccordionItem value="item-1">
                        <AccordionTrigger
                            >Volunteer and Partner Engagement</AccordionTrigger
                        >
                        <AccordionContent>
                            A huge community of partner and volunteer workers,
                            coming together for a cause.
                        </AccordionContent>
                    </AccordionItem>
                </Accordion>

                <Accordion class="mb-5" type="single" collapsible>
                    <AccordionItem value="item-1">
                        <AccordionTrigger
                            >Transparent Management</AccordionTrigger
                        >
                        <AccordionContent>
                            Transparency in our management ensures every
                            donation is poured into the charity efforts.
                        </AccordionContent>
                    </AccordionItem>
                </Accordion>

                <h4 class="text-primary text-h3 mt-7 mb-5">
                    Join Us in Making a Difference
                </h4>
                <p class="mb-10">
                    Whether you're considering volunteering, partnering with us,
                    or supporting our cause through donations, your involvement
                    is vital in helping us sustain our mission of ending hunger
                    and promoting well-being in our community.
                </p>

                <button
                    class="w-full bg-primary text-accent py-2 px-14 rounded-lg hover:bg-secondary"
                >
                    <a href="/">Become A Volunteer</a>
                </button>
            </section>

            <section class="Services mt-32">
                <h1 class="text-primary text-h1 mb-10">Our Services</h1>

                <div
                    class="gap-10 mx-auto md-custom:grid grid-cols-1 xl:grid-cols-2"
                    style="max-width: 1500px"
                >
                    <div
                        class="flex gap-4 mb-10 bg-secondary-accent p-7 rounded-lg border-b border-primary shadow-md flex-col mx-auto"
                        style="max-width: 550px"
                    >
                        <div
                            class="overflow-hidden rounded-lg"
                            style="max-width: 500px; max-height: 300px"
                        >
                            <img class="rounded-lg" src="../../assets/pic1.jpg" />
                        </div>

                        <div>
                            <h2 class="text-primary text-lg font-medium mb-5">
                                Hot Meal Delivery
                            </h2>
                            <p class="text-base">
                                Enjoy freshly prepared, hot meals delivered to
                                your doorstep every weekday, ensuring comfort
                                and nutrition.
                            </p>
                        </div>
                    </div>

                    <div
                        class="flex gap-4 mb-10 bg-secondary-accent p-7 rounded-lg border-b border-primary shadow-md flex-col mx-auto"
                        style="max-width: 550px"
                    >
                        <div
                            class="overflow-hidden rounded-lg"
                            style="max-width: 500px; max-height: 300px"
                        >
                            <img
                                class="rounded-lg"
                                src="../../assets/pic2.jpg"
                            />
                        </div>
                        <div>
                            <h2 class="text-primary text-lg font-medium mb-5">
                                Frozen Meal Service
                            </h2>
                            <p class="text-base">
                                Receive weekly deliveries of frozen meals,
                                prepared with care to provide you with
                                nutritious options anytime.
                            </p>
                        </div>
                    </div>

                    <div
                        class="flex gap-4 mb-10 bg-secondary-accent p-7 rounded-lg border-b border-primary shadow-md flex-col mx-auto"
                        style="max-width: 550px"
                    >
                        <div
                            class="overflow-hidden rounded-lg"
                            style="max-width: 500px; max-height: 300px"
                        >
                            <img
                                class="w-full h-auto rounded-lg"
                                src="../../assets/pic3.jpg"
                            />
                        </div>
                        <div>
                            <h2 class="text-primary text-lg font-medium mb-5">
                                Nutritional Support
                            </h2>
                            <p class="text-base">
                                Benefit from personalized nutritional support
                                tailored to meet your specific dietary needs and
                                health goals.
                            </p>
                        </div>
                    </div>

                    <div
                        class="flex gap-4 mb-10 bg-secondary-accent p-7 rounded-lg border-b border-primary shadow-md flex-col mx-auto"
                        style="max-width: 550px"
                    >
                        <div
                            class="overflow-hidden rounded-lg"
                            style="max-width: 500px; max-height: 300px"
                        >
                            <img
                                class="rounded-lg"
                                src="../../assets/pic4.webp"
                            />
                        </div>
                        <div>
                            <h2 class="text-primary text-lg font-medium mb-5">
                                Volunteer Oppurtunities
                            </h2>
                            <p class="text-base">
                                Join our team of volunteers and help us deliver
                                meals and support to those in need. Your time
                                can make a real difference.
                            </p>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
</template>
