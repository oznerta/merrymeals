<template>
  <div class="rounded-lg" @click="handleClick">
    <Card class="rounded-lg w-[300px]" @mouseover="handleMouseOver" @mouseleave="handleMouseLeave">
      <CardHeader class="mb-5 border-b text-text text-center">
        <CardTitle>
          <div class="flex items-center justify-between gap-2">
            <img src="../../assets/restaurant.png" class="h-8" alt="">
            <h3 class="text-base font-semi-bold">{{ kitchenName }}</h3>
          </div>
        </CardTitle>
      </CardHeader>
      <CardContent >
        <a :href="kitchenlink" class="view-menu cursor-pointer">
            <div>
              <p class="mb-1 text-small text-gray-500"> Street: {{ kitchenStreet }}</p>
              <p class="mb-1 text-small text-gray-500">City: {{ kitchenCity }}</p>
              <p class="mb-1 text-small text-gray-500">State: {{ kitchenState }}</p>
              <p class="mb-1 text-small text-gray-500">Postal Code: {{ kitchenPostalCode }}</p>
            </div>

          <div class="grid grid-cols-2 w-full ml-3 items-center mt-5">
            <div class="flex gap-2 items-center">
              <img src="../../assets/motorcycle.png" class="h-5" alt="">
              <p class="text-smaller text-gray-500">{{ distance }} km</p>
            </div>

            <div class="flex items-center gap-2">
              <p class="text-smaller">view menu</p>
              <i class="uil uil-arrow-right text-primary arrow"></i>
            </div>
          </div>
        </a>
      </CardContent>
    </Card>
  </div>
</template>

<script>
import { Card, CardContent, CardHeader, CardTitle } from "../shadcn/ui/card";

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
      type: [String, Number],
      required: true,
    },
    kitchenlink: {
      type: String,
      required: false,
    },
  },
  methods: {
    handleClick() {
      this.navigateToMenu();
    },
    handleMouseOver() {
      const arrow = this.$el.querySelector(".arrow");
      if (arrow) {
        arrow.style.marginLeft = "3px";
        arrow.style.transition = "margin-left 0.2s";
      }
    },
    handleMouseLeave() {
      const arrow = this.$el.querySelector(".arrow");
      if (arrow) {
        arrow.style.marginLeft = "0";
      }
    },
    navigateToMenu() {
      this.$emit("click", this.kitchenlink);
    },
  },
};
</script>

<style scoped>
.view-menu:hover .arrow {
  margin-left: 3px;
  transition: margin-left 0.2s;
}
</style>
