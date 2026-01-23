<script setup lang="ts">
const props = defineProps<{
  title?: string;
  message?: string;
}>();
</script>

<template>
  <div class="empty-state">
    <h2>{{ props.title || 'Nessun veicolo trovato' }}</h2>
    <p>{{ props.message || 'Non hai ancora aggiunto veicoli. Inizia aggiungendo il tuo primo veicolo!' }}</p>
  </div>
</template>

<style scoped>
  .empty-state {
    text-align: center;
    padding: 64px 32px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  }

  .empty-state h2 {
    margin: 0 0 8px;
    font-size: 24px;
    color: #111827;
  }

  .empty-state p {
    margin: 0 0 24px;
    color: #6b7280;
  }
</style>