<script setup lang="ts">
import { useAuth } from '@/composables/useAuth';
import UserInfo from '@/components/UserInfo.vue';
import CompanyWithUserRole from '@/components/CompanyWithUserRole.vue';
import NavMenu from '@/components/NavMenu.vue';

const { user } = useAuth();
</script>

<template>
  <div class="consumer-layout">
    <aside class="sidebar">
      <CompanyWithUserRole />

      <NavMenu />

      <div class="user-section">
        <UserInfo :user="user" />
      </div>
    </aside>

    <main class="main-content">
      <router-view />
    </main>
  </div>
</template>

<style scoped>
  .consumer-layout {
    display: flex;
    min-height: 100vh;
    background-color: #f3f4f6;
  }

  .sidebar {
    width: 280px;
    background: #3b82f6;
    color: white;
    display: flex;
    flex-direction: column;
    padding: 24px;
    box-shadow: 2px 0 8px rgba(0, 0, 0, 0.1);
  }

  .main-content {
    flex: 1;
    padding: 32px;
    overflow-y: auto;
  }
</style>
