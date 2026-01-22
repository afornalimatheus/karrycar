<script setup lang="ts">
import { useAuth } from '@/composables/useAuth';

const { user } = useAuth();
</script>

<template>
  <div class="logo">
    <h2>KarryCar</h2>
    <span class="role-badge provider">{{ user?.role }}</span>
  </div>
</template>

<style scoped>
  .logo {
    margin-bottom: 32px;
  }

  .logo h2 {
    margin: 0 0 8px;
    font-size: 24px;
    font-weight: 700;
  }

  .role-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: 600;
  }

  .role-badge.provider {
    background: rgba(255, 255, 255, 0.2);
  }
</style>