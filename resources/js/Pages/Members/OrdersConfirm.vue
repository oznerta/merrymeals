<script setup>
import { ref, watch, onMounted } from 'vue';
import { useForm } from '@inertiajs/vue3';
import { Textarea } from "../../shadcn/ui/textarea";
import { Button } from "../../shadcn/ui/button";
import MemberLayout from "../Layouts/MemberLayout.vue";
import KitchenCard from "../../SharedComponent/KitchenCard.vue";
import Toast from '../../SharedComponent/Toast.vue'; // Import the Toast component

// Define props
const props = defineProps({
  orderDetails: {
    type: Object,
    required: true,
    default: () => ({})
  }
});

// Initialize order details and form
const orderDetails = ref(props.orderDetails);

const form = useForm({
  menu_id: orderDetails.value.selectedMenu?.id ?? '',
  call_upon_arrival: true,
  ring_the_doorbell: false,
  notes: '',
});

const toast = ref(null); // Reference to the toast component

// Set the active option for form
const setActiveOption = (option) => {
  if (option === 'call_upon_arrival') {
    form.call_upon_arrival = true;
    form.ring_the_doorbell = false;
  } else if (option === 'ring_the_doorbell') {
    form.call_upon_arrival = false;
    form.ring_the_doorbell = true;
  }
};

// Submit the order form
const submitOrder = () => {
  form.post('/order', {
    onError: (errors) => {
      if (errors.error && toast.value) {
        toast.value.show(errors.error); // Show toast notification on error
      }
      console.error('Order submission errors:', errors);
    }
  });
};
</script>

<template>
  <div>
    <MemberLayout />
    <Toast ref="toast" /> <!-- Add the Toast component -->
    <main class="px-8 mt-20 md-custom:px-24 md-custom:mt-28 max-w-[1500px] mx-auto relative">
      <section class="orders_page">
        <div>
          <div class="w-1">
            <a :href="`/member/menu/${orderDetails.selectedKitchen.restaurant_name}`"
              class="flex items-center gap-2 hover:text-primary mb-5">
              <i class="uil uil-backspace text-h2"></i>
              Back
            </a>
          </div>
          <div class="flex gap-4 flex-wrap justify-center flex-col md-custom:flex-row">
            <div class="mx-auto">
              <KitchenCard v-if="orderDetails.selectedKitchen"
                :kitchenName="orderDetails.selectedKitchen.restaurant_name"
                :kitchenStreet="orderDetails.selectedKitchen.street_address"
                :kitchenCity="orderDetails.selectedKitchen.city"
                :kitchenState="orderDetails.selectedKitchen.state"
                :kitchenPostalCode="orderDetails.selectedKitchen.postal_code"
                :distance="orderDetails.distance" 
                :isSelectedKitchen="true" />
            </div>

            <div class="mx-auto rounded-lg p-4 max-w-[600px]">
              <p class="mb-5 text-primary text-small">Confirm Order</p>

              <div v-if="orderDetails.selectedMenu"
                class="bg-accent grid border rounded-lg overflow-hidden mb-4 md-custom:grid-cols-2 gap-2 relative">
                <div class="p-4">
                  <h3 class="text-base text-primary font-semibold mb-2">
                    {{ orderDetails.selectedMenu.meal_name }}
                  </h3>
                  <p class="text-gray-600 text-tiny max-w-sm break-words">
                    {{ orderDetails.selectedMenu.description }}
                  </p>
                </div>

                <div class="overflow-hidden my-auto p-3 rounded-lg">
                  <img :src="`/storage/${orderDetails.selectedMenu.image}`"
                    :alt="orderDetails.selectedMenu.meal_name + ' Image'"
                    class="w-full md-custom:w-42 h-32 rounded-lg md-custom:h-40 object-cover" />
                </div>
              </div>

              <form @submit.prevent="submitOrder" class="mt-10">
                <div class="mb-5 flex gap-4">
                  <button type="button" @click="setActiveOption('call_upon_arrival')" :class="{
                    'active-button': form.call_upon_arrival === true,
                    'inactive-button': form.call_upon_arrival !== true
                  }" class="rounded-lg py-2 px-6 text-smaller">
                    Call upon arrival
                  </button>

                  <button type="button" @click="setActiveOption('ring_the_doorbell')" :class="{
                    'active-button': form.ring_the_doorbell === true,
                    'inactive-button': form.ring_the_doorbell !== true
                  }" class="rounded-lg py-2 px-6 text-smaller">
                    Ring the doorbell
                  </button>
                </div>

                <div class="mb-5">
                  <Textarea v-model="form.notes" placeholder="Note to rider e.g. building, landmark, allergies," />
                </div>

                <Button type="submit" class="w-full bg-primary text-accent hover:bg-secondary mb-5">Place Order</Button>
                <p class="text-tiny mb-2">By making this purchase you agree to our <a href="#" class="underline">terms
                    and conditions.</a></p>
                <p class="text-tiny">I agree that placing the order places me under an obligation to make a payment in
                  accordance with the General Terms and Conditions.</p>
              </form>
            </div>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>

<style scoped>
.active-button {
  background-color: #4CAF50;
  color: white;
}

.inactive-button {
  background-color: #f1f1f1;
  color: black;
}
</style>
