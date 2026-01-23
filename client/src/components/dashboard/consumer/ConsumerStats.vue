<script setup lang="ts">
import type { ConsumerStats } from '@/types/Consumer';

const props = defineProps<{
  stats: ConsumerStats;
}>();

</script>

<template>
  <div class="stats-grid">
    <div class="stat-card">
      <div class="stat-content">
        <h3>Prenotazioni Attive</h3>
        <p class="stat-value">{{ stats.activeReservations }}</p>
      </div>
    </div>

    <div class="stat-card">
      <div class="stat-content">
        <h3>Prenotazioni Completate</h3>
        <p class="stat-value">{{ stats.completedReservations }}</p>
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
        <h3>Spesa Totale</h3>
        <p class="stat-value">€ {{ stats.monthlyExpenses }}</p>
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
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
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
    border-color: #3b82f6;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59, 130, 246, 0.2);
  }

  .action-icon {
    font-size: 32px;
  }
</style>