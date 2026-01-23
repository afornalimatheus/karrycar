<script setup lang="ts">
import { useAuth } from '@/composables/useAuth';

const { user } = useAuth();
</script>

<template>
  <header class="dashboard-header">
    <h1>Dashboard del {{ user?.role }}</h1>
    <p>Benvenuto, {{ user?.name }}!</p>
  </header>
</template>

<style scoped>
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
</style>