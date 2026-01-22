<template>
  <button
    type="button"
    @click="emitClick"
    :class="[baseClass, props.customClass]"
  >
    <slot>Action</slot>
  </button>
</template>

<script setup lang="ts">

const emit = defineEmits(['click']);
const props = defineProps<{ customClass?: string }>();

const baseClass = 'inline-flex items-center justify-center px-4 py-2 rounded-md text-white font-semibold transition-transform transform hover:-translate-y-1';

function emitClick(e: Event) {
  emit('click', e);
}
</script>

<style scoped>
  button {
    background: #667eea;
    color: white;
    border: none;
  }
</style>
