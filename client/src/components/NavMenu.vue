<script setup lang="ts">
import { useAuth } from '@/composables/useAuth';
const { user } = useAuth();
</script>

<template>
  <nav class="nav-menu">
    <router-link :to="`/${user?.role}/${user?.id}/dashboard`" class="nav-item">
      Dashboard
    </router-link>
    <router-link :to="`/${user?.role}/${user?.id}/vehicles`" class="nav-item">
      {{ user?.role === 'consumer' ? 'Veicoli Disponibili' : 'Miei veicoli' }}
    </router-link>
  </nav>
</template>

<style scoped>
  .nav-menu {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 8px;
  }

  .nav-item {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    border-radius: 8px;
    color: white;
    text-decoration: none;
    transition: background-color 0.2s;
  }

  .nav-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
  }
</style>