<script>
import { Tabs, TabsContent, TabsList, TabsTrigger } from "../../shadcn/ui/tabs";
import { Input } from "../../shadcn/ui/input";
import { Button } from "../../shadcn/ui/button";

export default {
    components: {
        Button,
        Tabs,
        TabsContent,
        TabsList,
        TabsTrigger,
        Input,
    },
};
</script>

<!-------------------------------------- Setup ----------------------------------------------->
<script setup>
import { useForm } from "@inertiajs/vue3";

// member form request-------------------------------------------------------------------
const memberForm = useForm({
    first_name: null,
    last_name: null,
    email: null,
    street: null,
    city: null,
    state: null,
    postal_code: null,
    phone_number: null,
    password: null,
    password_confirmation: null,
    caregiver_name: null,
    caregiver_phone: null,
});

const registerMember = () => {
    memberForm.post("/register", {
        onError: () => memberForm.reset("password", "password_confirmation"),
    });
};

// rider form request------------------------------------------------------------------------
const riderForm = useForm({
    first_name: null,
    last_name: null,
    email: null,
    street: null,
    city: null,
    state: null,
    postal_code: null,
    address: null,
    phone_number: null,
    password: null,
    password_confirmation: null,
});

const registerRider = () => {
    riderForm.post("/register-rider", {
        onError: () => riderForm.reset("password", "password_confirmation"),
    });
};

// kitchen form request------------------------------------------------------------------------
const kitchenForm = useForm({
    restaurant_name: null,
    first_name: null,
    last_name: null,
    email: null,
    street: null,
    city: null,
    state: null,
    postal_code: null,
    address: null,
    phone_number: null,
    password: null,
    password_confirmation: null,
});

const registerKitchen = () => {
    kitchenForm.post("/register-rider", {
        onError: () => kitchenForm.reset("password", "password_confirmation"),
    });
};


</script>

<template>
    <div class="flex flex-col bg-accent text-text py-8 px-4 md:px-8 mx-auto max-w-[1900px]">
        <div class="mb-10 w-12">
            <a href="/" class="flex items-center gap-2 hover:text-primary">
                <i class="uil uil-backspace text-h2"> </i>
                Back
            </a>
        </div>

        <div class="max-w-[1000px] mx-auto">
            <div class="mb-10">
                <h1 class="text-primary font-semi-bold text-h1 mb-5">
                    Join Merry Meal
                </h1>
                <p class="mb-5 text-base sm:text-sm">
                    Whether you're a member needing meal assistance, a volunteer
                    wanting to help, a partner seeking collaboration, or a donor
                    eager to support our cause, registering with MerryMeal is
                    simple and straightforward.
                </p>
            </div>
            <h3 class="text-primary text-h2 mb-5">Types of Registration</h3>
            <Tabs default-value="members" class="max-w-[1000px]">
                <TabsList class="mb-10 grid w-full  border-text grid-cols-3 mx-auto">
                    <TabsTrigger  value="members">
                        Members & Caregivers
                    </TabsTrigger>
                    <TabsTrigger value="volunteers">
                        Volunteers
                    </TabsTrigger>
                    <TabsTrigger value="partner">
                        Partners
                    </TabsTrigger>
                </TabsList>


                <!-- -----------------------------------Members Form --------------------------------------------------------------->
                <TabsContent value="members">
                    <h3 class="text-primary text-h2 mb-5">
                        Sign Up for Meal Assistance
                    </h3>
                    <p class="mb-5 text-base sm:text-sm">
                        If you are a senior, a person with a disability, or a
                        caregiver registering on behalf of someone, please
                        provide your details to join our meal delivery program
                    </p>
                    <form @submit.prevent="registerMember" class="max-w-[1000px] mx-auto">
                        <!-- Personal Information -->
                        <div class="flex flex-col mb-10 gap-3">
                            <h2 class="text-primary mt-10 mb-4">Personal Information</h2>
                                <Input type="text" v-model="memberForm.first_name" placeholder="First Name" required />
                                <small>{{ memberForm.errors.first_name }}</small>

                                <Input type="text" v-model="memberForm.last_name" placeholder="Last Name" required />
                                <small>{{ memberForm.errors.last_name }}</small>

                                <Input type="email" v-model="memberForm.email" placeholder="Email" required />
                                <small>{{ memberForm.errors.email }}</small>

                                <Input type="tel" v-model="memberForm.phone_number" placeholder="Phone Number" required />
                                <small>{{ memberForm.errors.phone_number }}</small>

                                <Input type="text" v-model="memberForm.street" placeholder="Street" required />
                                <small>{{ memberForm.errors.street }}</small>

                                <Input type="text" v-model="memberForm.city" placeholder="City" required />
                                <small>{{ memberForm.errors.city }}</small>

                                <Input type="text" v-model="memberForm.state" placeholder="State" required />
                                <small>{{ memberForm.errors.state }}</small>

                                <Input type="text" v-model="memberForm.postal" placeholder="Postal Code" required />
                                <small>{{ memberForm.errors.postal }}</small>

                                <Input type="password" v-model="memberForm.password" placeholder="Password" required />
                                <small>{{ memberForm.errors.password }}</small>

                                <Input type="password" v-model="memberForm.password_confirmation" placeholder="Confirm Password" required />
                      
                                <h2 class="text-primary mt-10 mb-2">Caregiver Details (if applicable)</h2>
                                <Input type="text" v-model="memberForm.caregiver_name" placeholder="Name" />
                                <Input type="tel" v-model="memberForm.caregiver_phone" placeholder="Phone Number" />

                        </div>


                        <!-- Submit Button -->
                        <button class="w-full bg-primary text-white py-2 px-4 rounded-lg hover:bg-secondary"
                            type="submit">
                            Register for Meals
                        </button>
                    </form>



                </TabsContent>

                <TabsContent value="volunteers">
                    <!------------------------------------------- Volunteer Registration Form ---------------------------------------------------------------->

                    <h3 class="text-primary text-h2 mb-5">
                        Beomce a Volunteer
                    </h3>
                    <p class="mb-5">
                        Join our team of compassionate volunteers and help
                        deliver meals or assist with our services. Your support
                        makes a difference!
                    </p>

                    <p class="text-primary mb-3">Area of Interest</p>

                    <Tabs default-value="rider" class="gap-3 rounded-sm mb-10">
                        <!------------------------------------------ Volunteer Form Selection ----------------------------------->
                        <TabsList class="gap-3 rounded-lg grid-cols-2 mb-5">
                            <TabsTrigger value="rider">
                                Volunteer as a Rider
                            </TabsTrigger>
                            <TabsTrigger value="kitchen">
                                Volunteer as a Kitchen
                            </TabsTrigger>
                        </TabsList>

                        <!------------------------------------------ volunteer rider registration ------------------------------->
                        <TabsContent value="rider">
                            <h3 class="text-primary mb-5">
                                Rider (Meal Delivery)
                            </h3>

                            <form class="flex flex-col gap-3 mb-5" @submit.prevent="registerRider">
                                <Input type="text" v-model="riderForm.first_name" placeholder="First Name" required />
                                <small>{{ riderForm.errors.first_name }}</small>

                                <Input type="text" v-model="riderForm.last_name" placeholder="Last Name" required />
                                <small>{{ riderForm.errors.last_name }}</small>

                                <Input type="email" v-model="riderForm.email" placeholder="Email" required />
                                <small>{{ riderForm.errors.email }}</small>

                                <Input type="text" v-model="riderForm.street" placeholder="Street" required />
                                <small>{{ riderForm.errors.street }}</small>

                                <Input type="text" v-model="riderForm.city" placeholder="City" required />
                                <small>{{ riderForm.errors.city }}</small>

                                <Input type="text" v-model="riderForm.state" placeholder="State" required />
                                <small>{{ riderForm.errors.state }}</small>

                                <Input type="text" v-model="riderForm.postal" placeholder="Postal Code" required />
                                <small>{{ riderForm.errors.postal }}</small>

                                <Input type="tel" v-model="riderForm.phone_number" placeholder="Phone Number"
                                    required />
                                <small>{{ riderForm.errors.phone_number }}</small>

                                <Input type="password" v-model="riderForm.password" placeholder="Password" required />
                                <small>{{ riderForm.errors.password }}</small>

                                <Input type="password" v-model="riderForm.password_confirmation"
                                    placeholder="Confirm Password" required />
                                
                                <button class="w-full bg-primary text-accent py-2 px-14 rounded-lg hover:bg-secondary"
                                    type="submit">
                                    Become a Volunteer
                                </button>
                            </form>

                        </TabsContent>

                        <!--------------------------------------------- Kitchen volunteer registration -------------------------------->
                        <TabsContent value="kitchen">
                            <h3 class="text-primary mb-5">
                                Kitchen (Meal Provider)
                            </h3>

                            <form class="flex flex-col gap-3 mb-5" @submit.prevent="registerKitchen">
                                <Input type="text" v-model="kitchenForm.restaurant_name" placeholder="Restaurant Name" required />
                                <small>{{ kitchenForm.errors.restaurant_name }}</small>

                                <Input type="text" v-model="kitchenForm.first_name" placeholder="First Name" required />
                                <small>{{ kitchenForm.errors.first_name }}</small>

                                <Input type="text" v-model="kitchenForm.last_name" placeholder="Last Name" required />
                                <small>{{ kitchenForm.errors.last_name }}</small>

                                <Input type="email" v-model="kitchenForm.email" placeholder="Email" required />
                                <small>{{ kitchenForm.errors.email }}</small>

                                <Input type="text" v-model="kitchenForm.street" placeholder="Street" required />
                                <small>{{ kitchenForm.errors.street }}</small>

                                <Input type="text" v-model="kitchenForm.city" placeholder="City" required />
                                <small>{{ kitchenForm.errors.city }}</small>

                                <Input type="text" v-model="kitchenForm.state" placeholder="State" required />
                                <small>{{ kitchenForm.errors.state }}</small>

                                <Input type="text" v-model="kitchenForm.postal" placeholder="Postal Code" required />
                                <small>{{ kitchenForm.errors.postal }}</small>

                                <Input type="tel" v-model="kitchenForm.phone_number" placeholder="Phone Number" required />
                                <small>{{ kitchenForm.errors.phone_number }}</small>

                                <Input type="password" v-model="kitchenForm.password" placeholder="Password" required />
                                <small>{{ kitchenForm.errors.password }}</small>

                                <Input type="password" v-model="kitchenForm.password_confirmation" placeholder="Confirm Password" required />
                                

                                <button class="w-full bg-primary text-accent py-2 px-14 rounded-lg hover:bg-secondary"
                                    type="submit">
                                    Become a Volunteer
                                </button>
                            </form>

                        </TabsContent>
                    </Tabs>
                </TabsContent>

                <!----------------------------------- Partnered Kitchen Registration -------------------------------------------------------->
                <TabsContent value="partner">
                    <h3 class="text-primary text-h2 mb-5">Partner With Us</h3>
                    <p class="mb-5">
                        We are always looking to expand our network of partners.
                        If your organization is interested in collaborating with
                        MerryMeal, please provide your details below.
                    </p>

                    <p class="text-primary mb-3">Area of Interest</p>

                    <Tabs default-value="prider" class="gap-3 mb-10 max-w-[1000px]">
                        <TabsList class="gap-3 rounded-lg mb-5">
                            <TabsTrigger value="prider">
                                Partnered Rider
                            </TabsTrigger>
                            <TabsTrigger value="pkitchen">
                                Partnered Kitchen
                            </TabsTrigger>
                        </TabsList>

                        <!------------------------------------------  rider registration ---------------------------------------->
                        <TabsContent value="prider">
                            <h3 class="text-primary mb-5">
                                Rider (Meal Delivery)
                            </h3>

                            <form class="flex flex-col gap-3 mb-5" @submit.prevent="registerRider">
                                <Input type="text" v-model="riderForm.first_name" placeholder="First Name" required />
                                <small>{{ riderForm.errors.first_name }}</small>

                                <Input type="text" v-model="riderForm.last_name" placeholder="Last Name" required />
                                <small>{{ riderForm.errors.last_name }}</small>

                                <Input type="email" v-model="riderForm.email" placeholder="Email" required />
                                <small>{{ riderForm.errors.email }}</small>

                                <Input type="text" v-model="riderForm.street" placeholder="Street" required />
                                <small>{{ riderForm.errors.street }}</small>

                                <Input type="text" v-model="riderForm.city" placeholder="City" required />
                                <small>{{ riderForm.errors.city }}</small>

                                <Input type="text" v-model="riderForm.state" placeholder="State" required />
                                <small>{{ riderForm.errors.state }}</small>

                                <Input type="text" v-model="riderForm.postal" placeholder="Postal Code" required />
                                <small>{{ riderForm.errors.postal }}</small>

                                <Input type="tel" v-model="riderForm.phone_number" placeholder="Phone Number"
                                    required />
                                <small>{{ riderForm.errors.phone_number }}</small>

                                <Input type="password" v-model="riderForm.password" placeholder="Password" required />
                                <small>{{ riderForm.errors.password }}</small>

                                <Input type="password" v-model="riderForm.password_confirmation"
                                    placeholder="Confirm Password" required />
                                
                                <button class="w-full bg-primary text-accent py-2 px-14 rounded-lg hover:bg-secondary"
                                    type="submit">
                                    Become a Partner
                                </button>
                            </form>
                        </TabsContent>

                        <!--------------------------------------------- Kitchen registration --------------------------------------->
                        <TabsContent value="pkitchen">
                            <h3 class="text-primary mb-5">
                                Kitchen (Meal Provider)
                            </h3>

                            <form class="flex flex-col gap-3 mb-5" @submit.prevent="registerKitchen">
                                <Input type="text" v-model="kitchenForm.restaurant_name" placeholder="Restaurant Name" required />
                                <small>{{ kitchenForm.errors.restaurant_name }}</small>

                                <Input type="text" v-model="kitchenForm.first_name" placeholder="First Name" required />
                                <small>{{ kitchenForm.errors.first_name }}</small>

                                <Input type="text" v-model="kitchenForm.last_name" placeholder="Last Name" required />
                                <small>{{ kitchenForm.errors.last_name }}</small>

                                <Input type="email" v-model="kitchenForm.email" placeholder="Email" required />
                                <small>{{ kitchenForm.errors.email }}</small>

                                <Input type="text" v-model="kitchenForm.street" placeholder="Street" required />
                                <small>{{ kitchenForm.errors.street }}</small>

                                <Input type="text" v-model="kitchenForm.city" placeholder="City" required />
                                <small>{{ kitchenForm.errors.city }}</small>

                                <Input type="text" v-model="kitchenForm.state" placeholder="State" required />
                                <small>{{ kitchenForm.errors.state }}</small>

                                <Input type="text" v-model="kitchenForm.postal" placeholder="Postal Code" required />
                                <small>{{ kitchenForm.errors.postal }}</small>

                                <Input type="tel" v-model="kitchenForm.phone_number" placeholder="Phone Number" required />
                                <small>{{ kitchenForm.errors.phone_number }}</small>

                                <Input type="password" v-model="kitchenForm.password" placeholder="Password" required />
                                <small>{{ kitchenForm.errors.password }}</small>

                                <Input type="password" v-model="kitchenForm.password_confirmation" placeholder="Confirm Password" required />
                                

                                <button class="w-full bg-primary text-accent py-2 px-14 rounded-lg hover:bg-secondary"
                                    type="submit">
                                    Become a Partner
                                </button>
                            </form>
                        </TabsContent>
                    </Tabs>
                </TabsContent>
            </Tabs>

            <div class="mb-10">
                <p class="text-center mt-4 text-smaller text-gray-600">
                    Already have an account?
                    <a href="login" class="hover:text-primary underline">Login</a>
                </p>
            </div>
        </div>
    </div>
</template>
