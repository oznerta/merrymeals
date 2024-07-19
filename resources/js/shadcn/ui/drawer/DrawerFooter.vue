<script setup>
import { cn } from "@/lib/utils";

const props = defineProps({
  class: { type: null, required: false },
});
</script>

<template>
  <div :class="cn('absolute left-1/2 bottom-2 transform -translate-x-1/2 w-full max-w-[500px] p-4 grid grid-cols-2 gap-2', props.class)">
    <slot />
  </div>
</template>
