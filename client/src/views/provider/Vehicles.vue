<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useAuth } from '@/composables/useAuth';
import api from '@/config/api';
import type { Vehicle } from '@/types/Vehicle';
import EmptyState from '@/components/EmptyState.vue';
import VehiclesGrid from '@/components/VehiclesGrid.vue';
import { Button } from 'primevue';

const { user } = useAuth();

const vehicles = ref<Vehicle[]>([]);
const loading = ref(true);

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
      <router-link :to="`/provider/${user?.id}/vehicles/new`">
        <Button label="Aggiungi veicolo" />
      </router-link>
    </header>

    <div v-if="loading" class="loading">Caricamento veicoli...</div>

    <EmptyState v-if="vehicles.length === 0" />

    <div v-else>
      <VehiclesGrid 
        :vehicles="vehicles" 
        :deleteVehicle="deleteVehicle" 
      />
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
</style>
