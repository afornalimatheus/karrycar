<script setup lang="ts">
import type { Vehicle } from '@/types/Vehicle';
import CardVehicle from '@/components/CardVehicle.vue';

const props = defineProps<{
  vehicles: Vehicle[];
  deleteVehicle: (id: number) => void;
}>();

</script>

<template>
  <div class="vehicles-grid">
    <div 
      v-for="vehicle in props.vehicles" 
      :key="vehicle.id"
    >
      <CardVehicle 
        :vehicle="vehicle" 
        @delete-vehicle="props.deleteVehicle" 
      />
    </div>
  </div>
</template>

<style scoped>
.vehicles-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 24px;
}
</style>