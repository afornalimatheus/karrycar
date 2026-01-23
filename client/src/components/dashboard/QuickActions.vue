<script setup lang="ts">
import { useAuth } from '@/composables/useAuth';
const { user } = useAuth();

const viewReservations = () => {
  console.log('Visualizza prenotazioni');
};
</script>

<template>
  <div class="quick-actions">
    <h2>Azioni Rapide</h2>

    <div class="actions-grid">
      <router-link :to="`/${user?.role}/${user?.id}/vehicles`" class="action-card">
        <span>
          {{ user?.role === 'provider' ? 'Aggiungi veicolo' : 'Cerca veicolo' }}
        </span>
      </router-link>
      <button class="action-card" @click="viewReservations">
        <span>
          {{ user?.role === 'provider' ? 'Visualizza prenotazioni' : 'Le mie prenotazioni' }}
        </span>
      </button>
    </div>
  </div>
</template>

<style scoped>
  .quick-actions h2 {
    font-size: 24px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 16px;
  }

  .actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 16px;
  }

  .action-card {
    background: white;
    border-radius: 12px;
    padding: 24px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    color: #111827;
    border: 2px solid #e5e7eb;
    transition: all 0.2s;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
  }

  .action-card:hover {
    border-color: #667eea;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(102, 126, 234, 0.2);
  }

  .action-icon {
    font-size: 32px;
  }
</style>