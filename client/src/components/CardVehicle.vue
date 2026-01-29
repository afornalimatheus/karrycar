<script setup lang="ts">
import { useAuth } from '@/composables/useAuth';
import type router from '@/router';
import type { Vehicle } from '@/types/Vehicle';
import { Button } from 'primevue';

const { user } = useAuth();

const props = defineProps<{
  vehicle: Vehicle;
}>();

const emit = defineEmits<{
  (e: 'delete-vehicle', vehicleId: number): void;
}>();

const deleteVehicle = (vehicleId: number) => {
  emit('delete-vehicle', vehicleId);
};
</script>

<template>
  <div class="vehicle-card">
    <div class="vehicle-header">
      <h3>{{ props.vehicle.brand }} - {{ props.vehicle.model }}</h3>
    </div>
    <div class="vehicle-details">
      <p><strong>Targa:</strong> {{ props.vehicle.license_plate }}</p>
    </div>
    <div v-if="user?.role === 'provider'" class="vehicle-actions">
      <Button label="Modifica" severity="success" icon="pi pi-pencil" />
      <Button label="Elimina" severity="danger" icon="pi pi-trash" @click="deleteVehicle(props.vehicle.id)" />
    </div>

    <div v-else-if="user?.role === 'consumer'">
      <router-link :to="{ name: 'ConsumerScheduleVehicle', query: { vehicleId: props.vehicle.id } }">
        <Button label="Prenotare" severity="info" icon="pi pi-pencil" />
      </router-link>
    </div>
  </div>
</template>

<style scoped>
  .vehicle-card {
    background: white;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: transform 0.2s, box-shadow 0.2s;
  }

  .vehicle-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
    padding-bottom: 16px;
    border-bottom: 2px solid #f3f4f6;
  }

  .vehicle-header h3 {
    margin: 0;
    font-size: 20px;
    color: #111827;
  }

  .vehicle-details {
    margin-bottom: 16px;
  }

  .vehicle-details p {
    margin: 8px 0;
    color: #6b7280;
    font-size: 14px;
  }

  .vehicle-actions {
    display: flex;
    gap: 8px;
  }
</style>