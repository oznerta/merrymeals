<script>
import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from "../shadcn/ui/accordion";

import { Button } from "../shadcn/ui/button";
import { Textarea } from "../shadcn/ui/textarea";
import { Input } from "../shadcn/ui/input";

export default {
    components: {
        Button,
        Accordion,
        AccordionContent,
        AccordionItem,
        AccordionTrigger,
        Textarea,
        Input,
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
    <div class="flex flex-col min-h-screen bg-accent">
        <!-- Header -->
        <header class="text-base">
            <!-- Desktop Navigation (hidden on smaller screens) -->
            <nav
                class="items-center w-full px-8 py-4 mx-auto shadow md:hidden md-custom:flex bg-accent"
                style="position: fixed; top: 0; left: 0; right: 0; z-index: 100"
            >
                <div>
                    <img
                        class="mr-20 w-100"
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
                    <div>
                        <a
                            class="py-2 rounded-lg bg-primary text-accent px-14 hover:bg-secondary"
                            href="login"
                            >Login</a
                        >
                    </div>
                </div>
            </nav>

            <!-- Mobile Navigation (visible on smaller screens) -->
            <nav
                class="flex items-center w-full px-4 py-4 mx-auto shadow bg-accent md-custom:hidden"
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
                        class="px-8 py-2 rounded-lg bg-primary text-accent md:px-14 hover:bg-secondary"
                    >
                        <a href="/">Login</a>
                    </button>

                    <button
                        @click="toggleMenu"
                        class="flex items-center md-custom:hidden"
                    >
                        <svg
                            class="w-8 h-8 text-black fill-current"
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
                class="fixed inset-0 z-50 flex items-center justify-center bg-accent"
            >
                <ul class="text-center text-text">
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
            class="flex flex-col px-4 py-8 mx-auto bg-accent text-text md:px-8"
            style="max-width: 1800px"
        >
            <section
                class="flex flex-col items-center hero md-custom:mt-20 md-custom:flex-row"
            >
                <!-- Right side: Full image -->
                <div
                    class="order-1 w-full md-custom:w-1/2 md-custom:pl-10 md-custom:order-2"
                >
                    <img
                        src="../../assets/hero-img.png"
                        alt="Image"
                        class="w-full h-auto rounded-lg"
                    />
                </div>

                <!-- Left side: Text content -->
                <div
                    class="order-2 w-full mt-6 md-custom:w-1/2 md-custom:pr-10 md-custom:order-1 md-custom:mt-0"
                >
                    <h2
                        class="mb-4 text-base font-bold text-primary md-custom:text-h1"
                    >
                        Join Us in Bringing Hope and Warmth
                    </h2>
                    <p class="mb-6 text-small lg-custom:text-h3">
                        At MerryMeal, we believe in the power of a warm meal to
                        nourish both body and soul. Dedicated to serving
                        qualified adults who face challenges in preparing their
                        meals, we deliver not just food, but also compassion and
                        companionship. Together, we're making sure no one is
                        left hungry or forgotten.
                    </p>

                    <div
                        class="flex flex-col justify-center gap-3 mb-10 overflow-hidden md:"
                    >
                        <div>
                            <img src="../../assets/volunteers-img.png" alt="" />
                        </div>
                        <p>1,600+ dedicated volunteers and counting!</p>
                    </div>

                    <div
                        class="flex flex-col gap-5 text-center lg-custom:flex-row"
                    >
                        <a
                            href="#"
                            class="w-full py-2 rounded-lg bg-primary text-accent px-14 hover:bg-secondary"
                            >Get Your Meals</a
                        >
                        <a
                            href="#"
                            class="w-full py-2 bg-transparent border rounded-lg text-primary px-14 border-primary hover:bg-secondary hover:text-accent"
                            >Donate Now</a
                        >
                    </div>
                </div>
            </section>

            <section class="mt-32 about">
                <h3 class="mb-5 text-primary text-h1">About Us</h3>
                <p class="mb-5">
                    We are a charitable organization dedicated to ensuring that
                    qualified adults living at home receive nutritious meals
                    they need. Our mission is driven by the belief that no one
                    should go hungry due to age, illness, or disability.
                </p>

                <h4 class="mb-6 text-primary text-h3">
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
                            >Volunteer & Partner Engagement</AccordionTrigger
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

                <h4 class="mb-5 text-primary text-h3 mt-7">
                    Join Us in Making a Difference
                </h4>
                <p class="mb-10">
                    Whether you're considering volunteering, partnering with us,
                    or supporting our cause through donations, your involvement
                    is vital in helping us sustain our mission of ending hunger
                    and promoting well-being in our community.
                </p>

                <div class="flex text-center">
                    <a
                        href="/register"
                        class="w-full py-2 rounded-lg bg-primary text-accent px-14 hover:bg-secondary"
                        >Get Your Meals</a
                    >
                </div>
            </section>

            <section class="mt-32 Services">
                <h1 class="mb-10 text-primary text-h1">Our Services</h1>

                <div
                    class="grid-cols-1 gap-10 mx-auto md-custom:grid lg-custom:grid-cols-2"
                    style="max-width: 1500px"
                >
                    <div
                        class="flex flex-col gap-4 mx-auto mb-10 border-b rounded-lg shadow-md bg-secondary-accent p-7 border-primary"
                        style="max-width: 550px"
                    >
                        <div
                            class="overflow-hidden rounded-lg"
                            style="max-width: 500px; max-height: 300px"
                        >
                            <img
                                class="rounded-lg"
                                src="../../assets/pic1.jpg"
                            />
                        </div>

                        <div>
                            <h2 class="mb-5 text-lg font-medium text-primary">
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
                        class="flex flex-col gap-4 mx-auto mb-10 border-b rounded-lg shadow-md bg-secondary-accent p-7 border-primary"
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
                            <h2 class="mb-5 text-lg font-medium text-primary">
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
                        class="flex flex-col gap-4 mx-auto mb-10 border-b rounded-lg shadow-md bg-secondary-accent p-7 border-primary"
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
                            <h2 class="mb-5 text-lg font-medium text-primary">
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
                        class="flex flex-col gap-4 mx-auto mb-10 border-b rounded-lg shadow-md bg-secondary-accent p-7 border-primary"
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
                            <h2 class="mb-5 text-lg font-medium text-primary">
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

            <section id="contact" class="mb-10">
                <div class="mx-auto">
                    <div class="mb-10">
                        <h2 class="text-primary text-h1">Contact Us</h2>

                        <p class="text-base">
                            Whether you have questions about our services, want
                            to know how to get involved or simply wish to share
                            your feedback, we're here to help. Reach out to us
                            through any of the following methods.
                        </p>
                    </div>

                    <div class="flex content-center justify-around">
                        <div class="flex flex-col content-center">
                            <div class="flex flex-row gap-10">
                                <i
                                    class="uil uil-phone-volume text-primary text-h1"
                                ></i>
                                <div class="flex flex-row gap-5 ">
                                    <p class="font-bold">
                                       Phone
                                    </p>
                                    <p class="">
                                        +1 (123) 456-7890
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-row gap-10">
                                <i
                                    class="uil uil-envelope text-primary text-h1"
                                ></i>
                                <div class="flex flex-row gap-5 ">
                                    <p class="font-bold">
                                       Email
                                    </p>
                                    <p class="">
                                        info@merrymeal.org
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-row gap-10 mb-5">
                                <i
                                    class="uil uil-location-point text-primary text-h1"
                                ></i>
                                <div class="flex flex-col">
                                    <p class="font-bold">
                                        MerryMeal Headquarters
                                    </p>
                                    <p class="">
                                        123 Charity Lane, Food Town,<br />FT-45678
                                    </p>
                                </div>
                            </div>

                            <div class="flex flex-row gap-10">
                                <div>
                                    <i
                                        class="uil uil-facebook text-primary text-h1"
                                    ></i>
                                    <i
                                        class="uil uil-instagram-alt text-primary text-h1"
                                    ></i>
                                </div>
                                <p class="font-bold">Connect with us</p>
                            </div>
                        </div>

                        <div class="flex flex-col justify-center w-2/5 gap-5">
                            <h3 class="font-semi-bold text-primary">
                                We'd Love to Hear From You!
                            </h3>
                            <form action="#" method="post">
                                <Input
                                    type="text"
                                    placeholder="Name"
                                    class="mb-5"
                                />
                                <Input
                                    type="email"
                                    placeholder="Email"
                                    class="mb-5"
                                />
                                <Input
                                    type="text"
                                    placeholder="Subject"
                                    class="mb-5"
                                />
                                <Textarea
                                    type="textarea"
                                    placeholder="Say something..."
                                    class="mb-5"
                                ></Textarea>
                                <Button class="w-full text-secondary-accent"
                                    >Send Message</Button
                                >
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <hr />

            <footer
                class="flex content-center justify-around w-full py-10 mb-5"
            >
                <div>
                    <h2 class="font-bold text-h2">Meals on Wheels</h2>
                    <p>"Nourishing Lives, One Meal at a Time"</p>
                </div>

                <div class="w-2/5">
                    <h2 class="font-semi-bold text-h2">
                        Sign up to our Newsletter
                    </h2>
                    <p>"Nourishing Lives, One Meal at a Time"</p>

                    <form>
                        <div class="flex flex-row gap-1">
                            <Input type="email" placeholder="Email" />
                            <Button class="px-24 text-secondary-accent"
                                >Subscribe</Button
                            >
                        </div>
                    </form>
                </div>
            </footer>
        </main>
    </div>
</template>
