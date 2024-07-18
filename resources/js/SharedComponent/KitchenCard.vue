<template>
  <div class="rounded-lg" @click="handleClick">
      <Card class="rounded-lg border-primary shadow cursor-pointer w-[300px]">
          <CardHeader class="mb-5 border-b border-primary text-primary text-center">
              <CardTitle>
                  <h3>{{ kitchenName }}</h3>
              </CardTitle>
          </CardHeader>
          <CardContent>
              <p class="mb-1">Street: {{ kitchenStreet }}</p>
              <p class="mb-1">City: {{ kitchenCity }}</p>
              <p class="mb-1">State: {{ kitchenState }}</p>
              <p class="mb-1">Postal Code: {{ kitchenPostalCode }}</p>
              <p class="text-small mt-4">{{ distance }} km</p>
          </CardContent>
      </Card>
  </div>
</template>

<script>
import {
  Card,
  CardContent,
  CardHeader,
  CardTitle,
} from "../shadcn/ui/card";

export default {
  components: {
      Card,
      CardContent,
      CardHeader,
      CardTitle,
  },
  props: {
      kitchenName: {
          type: String,
          required: true,
      },
      kitchenStreet: {
          type: String,
          required: true,
      },
      kitchenCity: {
          type: String,
          required: true,
      },
      kitchenState: {
          type: String,
          required: true,
      },
      kitchenPostalCode: {
          type: String,
          required: true,
      },
      distance: {
          type: String,
          required: true,
      },
  },
  methods: {
      handleClick() {
          this.$emit('click');
      }
  }
};
</script>

<style scoped>
/* Add your component-specific styles here */
</style>
