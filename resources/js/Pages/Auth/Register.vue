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

<template>
    <div
        class="flex flex-col bg-accent text-text py-8 px-4 md:px-8 mx-auto max-w-[1900px]"
    >
        <div class="mb-10">
            <a href="/" class="flex items-center gap-2 hover:text-primary">
                <i class="uil uil-backspace text-h2"> </i>
                Back
            </a>
        </div>

        <div class="mb-10">
            <h1 class="text-primary font-semi-bold text-h1 mb-5">
                Join Merry Meal
            </h1>
            <p>
                Whether you're a member needing meal assistance, a volunteer
                wanting to help, a partner seeking collaboration, or a donor
                eager to support our cause, registering with MerryMeal is simple
                and straightforward.
            </p>
        </div>
        <h3 class="text-primary text-h2 mb-5">Types of Registration</h3>
        <Tabs default-value="members" class="max-w-[1000px]">
            <TabsList class="gap-3 rounded-sm mb-10">
                <TabsTrigger class="border border-black" value="members">
                    <div class="hover:text-primary">Members & Caregivers</div>
                </TabsTrigger>
                <TabsTrigger class="hover:text-primary" value="volunteers">
                    Volunteer
                </TabsTrigger>
                <TabsTrigger class="hover:text-primary" value="partner">
                    Partner
                </TabsTrigger>
            </TabsList>

            <TabsContent value="members">
                <!------------------------------------------- Member Registration Form ---------------------------------------------------------------->

                <h3 class="text-primary text-h2 mb-5">
                    Sign Up for Meal Assistance
                </h3>

                <p class="mb-5">
                    If you are a senior, a person with a disability, or a
                    caregiver registering on behalf of someone, please provide
                    your details to join our meal delivery program
                </p>

                <div class="flex flex-col gap-3 w-[1500px] mb-5">
                    <div class="flex gap-3">
                        <Input
                            type="text"
                            name="firstName"
                            id="FirstName"
                            placeholder="First Name"
                        />
                        <Input
                            type="text"
                            name="lastName"
                            id="LastName"
                            placeholder="Last Name"
                        />
                    </div>
                    <Input
                        type="email"
                        name="email"
                        id="email"
                        placeholder="Email"
                    />
                    <Input
                        type="text"
                        name="address"
                        id="address"
                        placeholder="Address e.g (City,Street,Floor)"
                    />
                    <Input
                        type="tel"
                        name="pnumber"
                        id="pnumber"
                        placeholder="Phone Number"
                    />
                    <Input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Password"
                    />
                    <Input
                        type="password"
                        name="password"
                        id="password"
                        placeholder="Confirm Password"
                    />
                </div>

                <h3 class="text-primary">Caregiver Details (if applicable)</h3>

                <div class="flex flex-col mb-5 w-[1500px]">
                    <Input
                        type="text"
                        name="name"
                        id="name"
                        placeholder="Name"
                    />
                    <Input
                        type="tel"
                        name="pnumber"
                        id="pnumber"
                        placeholder="Phone Number"
                    />
                </div>
                <button
                    class="w-[1500px] bg-primary text-accent py-2 px-14 rounded-lg hover:bg-secondary"
                    type="submit"
                >
                    Register for Meals
                </button>
            </TabsContent>

            <TabsContent value="volunteers">
                <!------------------------------------------- Volunteer Registration Form ---------------------------------------------------------------->

                <h3 class="text-primary text-h1 mb-5">Become a Volunteer</h3>
                <p class="mb-5">
                    Join our team of compassionate volunteers and help deliver
                    meals or assist with our services. Your support makes a
                    difference!
                </p>

                <Tabs
                    default-value="rider"
                    class="gap-3 rounded-sm mb-10 w-[1500px]"
                >
                    <!------------------------------------------ Volunteer Form Selection ----------------------------------->
                    <TabsList class="gap-3 rounded-sm mb-5">
                        <TabsTrigger value="rider">
                            Volunteer as a Rider
                        </TabsTrigger>
                        <TabsTrigger value="kitchen">
                            Volunteer as a Kitchen
                        </TabsTrigger>
                    </TabsList>

                    <!------------------------------------------ volunteer rider registration ------------------------------->
                    <TabsContent value="rider">
                        <h3 class="text-primary mb-5">Rider (Meal Delivery)</h3>

                        <div class="flex flex-col gap-3 mb-5 w-[1500px]">
                            <div class="flex gap-3">
                                <Input
                                    type="text"
                                    name="firstName"
                                    id="firstName"
                                    placeholder="First Name"
                                />
                                <Input
                                    type="text"
                                    name="lastName"
                                    id="lastName"
                                    placeholder="Last Name"
                                />
                            </div>
                            <Input
                                type="email"
                                name="email"
                                id="email"
                                placeholder="Email"
                            />
                            <Input
                                type="text"
                                name="address"
                                id="address"
                                placeholder="Address"
                            />
                            <Input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="Password"
                            />
                            <Input
                                type="password"
                                name="confPassword"
                                id="confPassword"
                                placeholder="Confirm Password"
                            />
                        </div>
                        <button
                            class="w-[1500px] bg-primary text-accent py-2 px-14 rounded-lg hover:bg-secondary"
                            type="submit"
                        >
                            Join as a Volunteer
                        </button>
                    </TabsContent>

                    <!--------------------------------------------- Kitchen volunteer registration -------------------------------->
                    <TabsContent value="kitchen">
                        <h3 class="text-primary mb-5">
                            Kitchen (Meal Provider)
                        </h3>

                        <div class="flex flex-col gap-3 mb-5 w-[1500px]">
                            <Input
                                type="text"
                                name="restoName"
                                id="restoName"
                                placeholder="Restaurant Name"
                            />
                            <div class="flex gap-3">
                                <Input
                                    type="text"
                                    name="firstName"
                                    id="firstName"
                                    placeholder="First Name"
                                />
                                <Input
                                    type="text"
                                    name="lastName"
                                    id="lastName"
                                    placeholder="Last Name"
                                />
                            </div>
                            <Input
                                type="email"
                                name="email"
                                id="email"
                                placeholder="Email"
                            />
                            <Input
                                type="text"
                                name="address"
                                id="address"
                                placeholder="Address"
                            />
                            <Input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="Password"
                            />
                            <Input
                                type="password"
                                name="confPassword"
                                id="confPassword"
                                placeholder="Confirm Password"
                            />
                        </div>
                        <button
                            class="w-[1500px] bg-primary text-accent py-2 px-14 rounded-lg hover:bg-secondary"
                            type="submit"
                        >
                            Join as a Volunteer
                        </button>
                    </TabsContent>
                </Tabs>
            </TabsContent>

            <!----------------------------------- Partnered Kitchen Registration -------------------------------------------------------->
            <TabsContent value="partner">
                <h3 class="text-primary text-h1 mb-5">Partner With Us</h3>
                <p class="mb-5">
                    We are always looking to expand our network of partners. If
                    your organization is interested in collaborating with
                    MerryMeal, please provide your details below.
                </p>

                <Tabs
                    default-value="prider"
                    class="gap-3 rounded-sm mb-10 w-[1500px]"
                >
                    
                    <TabsList class="gap-3 rounded-sm mb-5">
                        <TabsTrigger value="prider">
                            Partnered Rider
                        </TabsTrigger>
                        <TabsTrigger value="pkitchen">
                            Partnered Kitchen
                        </TabsTrigger>
                    </TabsList>

                    <!------------------------------------------  rider registration ---------------------------------------->
                    <TabsContent value="prider">
                        <h3 class="text-primary mb-5">Rider (Meal Delivery)</h3>

                        <div class="flex flex-col gap-3 mb-5 w-[1500px]">
                            <div class="flex gap-3">
                                <Input
                                    type="text"
                                    name="firstName"
                                    id="firstName"
                                    placeholder="First Name"
                                />
                                <Input
                                    type="text"
                                    name="lastName"
                                    id="lastName"
                                    placeholder="Last Name"
                                />
                            </div>
                            <Input
                                type="email"
                                name="email"
                                id="email"
                                placeholder="Email"
                            />
                            <Input
                                type="text"
                                name="address"
                                id="address"
                                placeholder="Address"
                            />
                            <Input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="Password"
                            />
                            <Input
                                type="password"
                                name="confPassword"
                                id="confPassword"
                                placeholder="Confirm Password"
                            />
                        </div>
                        <button
                            class="w-[1500px] bg-primary text-accent py-2 px-14 rounded-lg hover:bg-secondary"
                            type="submit"
                        >
                            Become a Partner
                        </button>
                    </TabsContent>

                    <!--------------------------------------------- Kitchen registration --------------------------------------->
                    <TabsContent value="pkitchen">
                        <h3 class="text-primary mb-5">
                            Kitchen (Meal Provider)
                        </h3>

                        <div class="flex flex-col gap-3 mb-5 w-[1500px]">
                            <Input
                                type="text"
                                name="restoName"
                                id="restoName"
                                placeholder="Restaurant Name"
                            />
                            <div class="flex gap-3">
                                <Input
                                    type="text"
                                    name="firstName"
                                    id="firstName"
                                    placeholder="First Name"
                                />
                                <Input
                                    type="text"
                                    name="lastName"
                                    id="lastName"
                                    placeholder="Last Name"
                                />
                            </div>
                            <Input
                                type="email"
                                name="email"
                                id="email"
                                placeholder="Email"
                            />
                            <Input
                                type="text"
                                name="address"
                                id="address"
                                placeholder="Address"
                            />
                            <Input
                                type="password"
                                name="password"
                                id="password"
                                placeholder="Password"
                            />
                            <Input
                                type="password"
                                name="confPassword"
                                id="confPassword"
                                placeholder="Confirm Password"
                            />
                        </div>
                        <button
                            class="w-[1500px] bg-primary text-accent py-2 px-14 rounded-lg hover:bg-secondary"
                            type="submit"
                        >
                           Become a Partner
                        </button>
                    </TabsContent>
                </Tabs>
               
            </TabsContent>
        </Tabs>
    </div>
</template>
