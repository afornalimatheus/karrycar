<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useAuth } from '@/composables/useAuth';
import api from '@/config/api';
import PrimaryButton from '@/components/PrimaryButton.vue';
import CardVehicle from '@/components/CardVehicle.vue';
import type { Vehicle } from '@/types/Vehicle';
import EmptyState from '@/components/EmptyState.vue';

const { user } = useAuth();

const vehicles = ref<Vehicle[]>([]);
const loading = ref(true);
const showAddModal = ref(false);

onMounted(async () => {
  await loadVehicles();
});

const loadVehicles = async () => {
  try {
    loading.value = true;

    const response = await api.get(`/provider/${user.value?.id}/vehicles`);

    vehicles.value = response.data.data || [];
  } catch (error) {
    console.error('Errore durante il caricamento dei veicoli:', error);
  } finally {
    loading.value = false;
  }
};

const deleteVehicle = async (id: number) => {
  if (!confirm('Sei sicuro di voler eliminare questo veicolo?')) {
    return;
  }
  
  try {
    await api.delete(`/provider/${user.value?.id}/vehicles/${id}`);
    await loadVehicles();
  } catch (error) {
    alert('Errore durante l\'eliminazione del veicolo.');
  }
};
</script>

<template>
  <div class="vehicles-page">
    <header class="page-header">
      <h1>Miei veicoli</h1>
      <PrimaryButton @click="showAddModal = true">Aggiungi veicolo</PrimaryButton>
    </header>

    <div v-if="loading" class="loading">Caricamento veicoli...</div>

    <EmptyState v-if="vehicles.length === 0" />

    <div v-else class="vehicles-grid">
      <div 
        v-for="vehicle in vehicles" 
        :key="vehicle.id"
      >
        <CardVehicle 
          :vehicle="vehicle" 
          @delete-vehicle="deleteVehicle" 
        />
      </div>
    </div>
  </div>
</template>

<style scoped>
.vehicles-page {
  max-width: 1200px;
}

.page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 32px;
}

.page-header h1 {
  margin: 0;
  font-size: 32px;
  font-weight: 700;
  color: #111827;
}

.loading {
  text-align: center;
  padding: 48px;
  color: #6b7280;
}

.vehicles-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 24px;
}

.btn-secondary {
  flex: 1;
  padding: 8px 16px;
  background: #f3f4f6;
  border: none;
  border-radius: 6px;
  font-size: 14px;
  font-weight: 600;
  color: #374151;
  cursor: pointer;
  transition: background-color 0.2s;
}

.btn-secondary:hover {
  background: #e5e7eb;
}

.btn-danger {
  flex: 1;
  padding: 8px 16px;
  background: #fee2e2;
  border: none;
  border-radius: 6px;
  font-size: 14px;
  font-weight: 600;
  color: #dc2626;
  cursor: pointer;
  transition: background-color 0.2s;
}

.btn-danger:hover {
  background: #fecaca;
}
</style>
