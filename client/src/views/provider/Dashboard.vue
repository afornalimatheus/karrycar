<template>
  <div class="dashboard">
    <header class="dashboard-header">
      <h1>Dashboard del Fornitore</h1>
      <p>Benvenuto, {{ user?.name }}!</p>
    </header>

    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-content">
          <h3>Totale Veicoli</h3>
          <p class="stat-value">{{ stats.totalVehicles }}</p>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-content">
          <h3>Veicoli Disponibili</h3>
          <p class="stat-value">{{ stats.availableVehicles }}</p>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-content">
          <h3>Prenotazioni Attive</h3>
          <p class="stat-value">{{ stats.activeReservations }}</p>
        </div>
      </div>

      <div class="stat-card">
        <div class="stat-content">
          <h3>Entrate Mensili</h3>
          <p class="stat-value">€ {{ stats.monthlyRevenue }}</p>
        </div>
      </div>
    </div>

    <div class="quick-actions">
      <h2>Azioni Rapide</h2>
      <div class="actions-grid">
        <router-link :to="`/provider/${user?.id}/vehicles`" class="action-card">
          <span>Aggiungi Veicolo</span>
        </router-link>
        <button class="action-card" @click="viewReservations">
          <span>Visualizza Prenotazioni</span>
        </button>
      </div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue';
import { useAuth } from '@/composables/useAuth';

const { user } = useAuth();

const stats = ref({
  totalVehicles: 0,
  availableVehicles: 0,
  activeReservations: 0,
  monthlyRevenue: 0
});

onMounted(async () => {
  // Qui faresti chiamate API per recuperare i dati reali
  stats.value = {
    totalVehicles: 5,
    availableVehicles: 3,
    activeReservations: 2,
    monthlyRevenue: 1500
  };
});

const viewReservations = () => {
  // Implementare navigazione per prenotazioni
  console.log('Visualizza prenotazioni');
};
</script>

<style scoped>
.dashboard {
  max-width: 1200px;
}

.dashboard-header {
  margin-bottom: 32px;
}

.dashboard-header h1 {
  margin: 0 0 8px;
  font-size: 32px;
  font-weight: 700;
  color: #111827;
}

.dashboard-header p {
  margin: 0;
  font-size: 16px;
  color: #6b7280;
}

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
  gap: 20px;
  margin-bottom: 32px;
}

.stat-card {
  background: white;
  border-radius: 12px;
  padding: 24px;
  display: flex;
  align-items: center;
  gap: 16px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.stat-icon {
  font-size: 36px;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  width: 64px;
  height: 64px;
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.stat-content h3 {
  margin: 0 0 8px;
  font-size: 14px;
  color: #6b7280;
  font-weight: 500;
}

.stat-value {
  margin: 0;
  font-size: 28px;
  font-weight: 700;
  color: #111827;
}

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
