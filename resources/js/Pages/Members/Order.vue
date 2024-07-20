<template>
  <div class="flex flex-col min-h-screen bg-accent">
    <MemberLayout />
    <main class="px-8 mt-20 md-custom:px-24 md-custom:mt-28 max-w-[1500px] mx-auto relative">
      <section class="order-status">
        <div class="w-full">
          <div class="w-1">
            <a
              href="/member/restaurant"
              class="flex items-center gap-2 mb-5 hover:text-primary"
            >
              <i class="uil uil-backspace text-h2"></i>
              Back
            </a>
          </div>

          <!-- Order Status Section -->
          <div v-if="orderDetails">
            <h2 class="mb-4 text-lg font-semibold">Order Status</h2>
            <div class="tracking-container">
              <div class="tracking-step">
                <div :class="['step-circle', getStepClass(0)]"></div>
                <div class="step-content">
                  <h3 class="step-title">Order Received</h3>
                  <p class="step-description">We have received your order and are processing it.</p>
                </div>
              </div>
              <div class="tracking-step">
                <div :class="['step-circle', getStepClass(1)]"></div>
                <div class="step-content">
                  <h3 class="step-title">In Preparation</h3>
                  <p class="step-description">Your order is being prepared by our kitchen staff.</p>
                </div>
              </div>
              <div class="tracking-step">
                <div :class="['step-circle', getStepClass(2)]"></div>
                <div class="step-content">
                  <h3 class="step-title">Ready for Pickup</h3>
                  <p class="step-description">Your order is ready for pickup.</p>
                </div>
              </div>
              <div class="tracking-step">
                <div :class="['step-circle', getStepClass(3)]"></div>
                <div class="step-content">
                  <h3 class="step-title">On Its Way</h3>
                  <p class="step-description">Your order is on its way to you.</p>
                </div>
              </div>
              <div class="tracking-step">
                <div :class="['step-circle', getStepClass(4)]"></div>
                <div class="step-content">
                  <h3 class="step-title">Completed</h3>
                  <p class="step-description">Your order has been completed.</p>
                </div>
              </div>
            </div>
            <p class="mt-2">Current Status: {{ orderDetails.status }}</p>

            <div>
                <form
                        @submit.prevent="handleMarkAsComplete"
                        class="w-full"
                    >
                        <Button
                            type="submit"
                            class="w-full bg-primary text-accent hover:bg-secondary"
                        >
                           Meal Received
                        </Button>
                    </form>
            </div>
          </div>


          <div v-else>
            <p class="mt-4 text-lg text-center">You don't have any orders.</p>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>

<script>
import MemberLayout from "../Layouts/MemberLayout.vue";
import {useForm} from "@inertiajs/vue3";
import {Button} from "../../shadcn/ui/button";

export default {
  components: {
    MemberLayout,
    Button,
  },
  props: {
    orderDetails: {
      type: Object,
      default: () => ({}),
    },
    orderId: Number,
  },
  methods: {
    getStepClass(stepIndex) {
      const statusMap = {
        'Order Received': 0,
        'in preparation': 1,
        'ready for pickup': 2,
        'on its way': 3,
        'completed': 4,
      };
      const currentStatusIndex = statusMap[this.orderDetails.status.trim()] ?? 0;
      return stepIndex <= currentStatusIndex ? 'completed' : 'pending';
    },
  },
  setup(props){
    const form = useForm({
            orderId: props.orderId,
        });

        const handleMarkAsComplete = () => {
            form.post(`/orders/${props.orderDetails.id}/complete`, {
                onSuccess: (response) => {
                    if (response && response.props.success) {
                        props.onOrderComplete(props.orderId);
                    } else {
                        console.error(
                            response.props.message || "Unknown error"
                        );
                    }
                },
                onError: (errors) => {
                    console.error("Error marking as complete");
                },
            });
        };

    return{
        handleMarkAsComplete
    };
  }
};
</script>

<style scoped>


.tracking-container {
  display: flex;
  flex-direction: column;
}

.tracking-step {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.step-circle {
  width: 30px;
  height: 30px;
  border-radius: 50%;
  background-color: #e0e0e0;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #fff;
  font-weight: bold;
  margin-right: 15px;
}

.step-content {
  flex: 1;
}

.step-title {
  font-size: 1rem;
  font-weight: bold;
}

.step-description {
  font-size: 0.875rem;
  color: #666;
}

.step-circle.completed {
  background-color: #4caf50; /* Green */
}

.step-circle.pending {
  background-color: #e0e0e0; /* Gray */
}
</style>
