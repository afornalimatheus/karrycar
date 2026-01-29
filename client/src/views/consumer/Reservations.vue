<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useAuth } from '@/composables/useAuth';
import api from '@/config/api';
// import type { Reservation } from '@/types/Reservation';
import EmptyState from '@/components/EmptyState.vue';
// import ReservationsGrid from '@/components/ReservationsGrid.vue';
import { Button } from 'primevue';

const { user } = useAuth();
const reservations = ref<Reservation[]>([]);
const loading = ref(false);

const fetchReservations = async () => {
  loading.value = true;
  try {
    const response = await api.get(`/consumers/${user?.id}/reservations`);
    reservations.value = response.data;
  } catch (error) {
    console.error('Errore durante il caricamento delle prenotazioni:', error);
  } finally {
    loading.value = false;
  }
};

const deleteReservation = async (reservationId: number) => {
  try {
    await api.delete(`/reservations/${reservationId}`);
    reservations.value = reservations.value.filter(r => r.id !== reservationId);
  } catch (error) {
    console.error('Errore durante la cancellazione della prenotazione:', error);
  }
};

onMounted(() => {
  fetchReservations();
});

</script>

<template>
  <div class="reservations-page">
    <header class="page-header">
      <h1>Le mie prenotazioni</h1>
      <router-link :to="`/consumer/${user?.id}/reservations/new`">
        <Button label="Nuove prenotazioni" />
      </router-link>
    </header>
    
    <div v-if="loading" class="loading">Caricamento prenotazioni...</div>

    <EmptyState v-if="reservations.length === 0" :title="'Niente da vedere...'" :message="'Nessuna prenotazione trovata.'" />

    <div v-else>
      <!-- <ReservationsGrid 
        :reservations="reservations" 
        :deleteReservation="deleteReservation" 
      /> -->
    </div>
    
  </div>
</template>

<style scoped>
.reservations-page {
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
</style>