<template>
  <div class="flex flex-col min-h-screen bg-accent">
    <MemberLayout />
    <main class="px-8 mt-20 md-custom:px-24 md-custom:mt-28 max-w-[1500px] mx-auto relative">
      <section class="order-status">
        <div class="w-full">
          <div class="w-1">
            <a
              href="/member/restaurant"
              class="flex items-center gap-2 hover:text-primary mb-5"
            >
              <i class="uil uil-backspace text-h2"></i>
              Back
            </a>
          </div>

          <!-- Order Status Section -->
          <div v-if="orderDetails">
            <h2 class="text-lg font-semibold mb-4">Order Status</h2>
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
              <div>
            <button>Mark as Completed</button>
              </div>
            </div>
          </div>

          
          <div v-else>
            <p class="text-center mt-4 text-lg">You don't have any orders.</p>
          </div>
        </div>
      </section>
    </main>
  </div>
</template>

<script>
import MemberLayout from "../Layouts/MemberLayout.vue";

export default {
  components: {
    MemberLayout,
  },
  props: {
    orderDetails: {
      type: Object,
      default: () => ({}),
    },
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
