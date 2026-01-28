<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import api from '@/config/api';
import { useAuth } from '@/composables/useAuth';
import type { Vehicle } from '@/types/Vehicle';
import EmptyState from '@/components/EmptyState.vue';
import VehiclesGrid from '@/components/VehiclesGrid.vue';

const { user } = useAuth();

const vehicles = ref<Vehicle[]>([]);
const loading = ref(true);
const searchQuery = ref('');

const filteredVehicles = computed(() => {
  if (!searchQuery.value) {
    return vehicles.value
  }
  
  const query = searchQuery.value.toLowerCase();

  return vehicles.value.filter(vehicle => 
    vehicle.brand?.toLowerCase().includes(query) ||
    vehicle.model?.toLowerCase().includes(query)
  );
});

onMounted(async () => {
  await loadVehicles();
});

const loadVehicles = async () => {
  try {
    loading.value = true;

    const response = await api.get(`/consumer/${user.value?.id}/available-vehicles`);

    vehicles.value = response.data.data || [];
  } catch (error) {
    console.error('Non è stato possibile caricare i veicoli:', error);
  } finally {
    loading.value = false;
  }
};

const reserveVehicle = (vehicle: any) => {
  console.log('Prenotare: ', vehicle)
};
</script>

<template>
  <div class="available-vehicles-page">
    <header class="page-header">
      <h1>Veicoli Disponibili</h1>
      <div class="search-bar">
        <input 
          v-model="searchQuery" 
          type="text" 
          placeholder="Cerca per marca, modello..." 
          class="search-input"
        />
      </div>
    </header>

    <div v-if="loading" class="loading">Caricamento veicoli...</div>

    <EmptyState v-else-if="filteredVehicles.length === 0" 
      title="Nessun veicolo trovato" 
      message="Non ci sono veicoli disponibili al momento."
    />

    <div v-else>
      <VehiclesGrid 
        :vehicles="filteredVehicles" 
        :deleteVehicle="reserveVehicle" 
      />
    </div>
  </div>
</template>

<style scoped>
.available-vehicles-page {
  max-width: 1200px;
}

.page-header {
  margin-bottom: 32px;
}

.page-header h1 {
  margin: 0 0 16px;
  font-size: 32px;
  font-weight: 700;
  color: #111827;
}

.search-bar {
  max-width: 500px;
}

.search-input {
  width: 100%;
  padding: 12px 16px;
  border: 2px solid #e5e7eb;
  border-radius: 8px;
  font-size: 16px;
  transition: border-color 0.3s;
}

.search-input:focus {
  outline: none;
  border-color: #3b82f6;
}

.loading {
  text-align: center;
  padding: 48px;
  color: #6b7280;
}
</style>
