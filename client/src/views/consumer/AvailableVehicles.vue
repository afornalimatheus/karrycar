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

    <div v-else-if="filteredVehicles.length === 0" class="empty-state">
      <h2>Nessun veicolo trovato</h2>
      <p>NNon ci sono veicoli disponibili al momento.</p>
    </div>

    <div v-else class="vehicles-grid">
      <div v-for="vehicle in filteredVehicles" :key="vehicle.id" class="vehicle-card">
        <div class="vehicle-header">
          <h3>{{ vehicle.brand }} {{ vehicle.model }}</h3>
          <span class="vehicle-year">{{ vehicle.year }}</span>
        </div>
        <div class="vehicle-details">
          <p><strong>Colore:</strong> {{ vehicle.color }}</p>
          <p><strong>Prezzo al giorno:</strong> € {{ vehicle.daily_price }}</p>
          <p><strong>Fornitore:</strong> {{ vehicle.provider?.name }}</p>
        </div>
        <div class="vehicle-actions">
          <PrimaryButton @click="reserveVehicle(vehicle)">Reservar</PrimaryButton>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue';
import { useAuth } from '@/composables/useAuth';
import api from '@/config/api';
import PrimaryButton from '@/components/PrimaryButton.vue';

const { user } = useAuth();
const vehicles = ref<any[]>([]);
const loading = ref(true);
const searchQuery = ref('');

const filteredVehicles = computed(() => {
  if (!searchQuery.value) return vehicles.value;
  
  const query = searchQuery.value.toLowerCase();
  return vehicles.value.filter(vehicle => 
    vehicle.brand?.toLowerCase().includes(query) ||
    vehicle.model?.toLowerCase().includes(query) ||
    vehicle.color?.toLowerCase().includes(query)
  );
});

onMounted(async () => {
  await loadVehicles();
});

const loadVehicles = async () => {
  try {
    loading.value = true;
    const response = await api.get('/vehicles/available');
    vehicles.value = response.data.data || [];
  } catch (error) {
    console.error('Erro ao carregar veículos:', error);
  } finally {
    loading.value = false;
  }
};

const reserveVehicle = (vehicle: any) => {
  console.log('Reservar veículo:', vehicle);
  // Implementar modal de reserva
  alert(`Funcionalidade de reserva em desenvolvimento.\nVeículo: ${vehicle.brand} ${vehicle.model}`);
};
</script>

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

.empty-state {
  text-align: center;
  padding: 64px 32px;
  background: white;
  border-radius: 12px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.empty-icon {
  font-size: 64px;
  display: block;
  margin-bottom: 16px;
}

.empty-state h2 {
  margin: 0 0 8px;
  font-size: 24px;
  color: #111827;
}

.empty-state p {
  margin: 0;
  color: #6b7280;
}

.vehicles-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 24px;
}

.vehicle-card {
  background: white;
  border-radius: 12px;
  padding: 24px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  transition: transform 0.2s, box-shadow 0.2s;
}

.vehicle-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
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

.vehicle-year {
  background: #3b82f6;
  color: white;
  padding: 4px 12px;
  border-radius: 12px;
  font-size: 14px;
  font-weight: 600;
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
}
</style>
