<script setup lang="ts">
import type { ProviderStats } from '@/types/Provider';


const props = defineProps<{
  stats: ProviderStats;
}>();

</script>

<template>
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
</template>

<style scoped>
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
</style>