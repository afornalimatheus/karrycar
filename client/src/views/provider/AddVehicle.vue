<script setup lang="ts">
import NewVehicle from './NewVehicle.vue';

</script>

<template>
  <div class="add-vehicle-page">
    <div>
      <h1>Veicolo</h1>
    </div>
    <NewVehicle />
  </div>
</template>

<style scoped>
  .add-vehicle-page {
    padding: 24px;
    background-color: #f9fafb;
    border-radius: 8px;
  }

  .add-vehicle-page h1 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 16px;
    color: #111827;
  }
</style>