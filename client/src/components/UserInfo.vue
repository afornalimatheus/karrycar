<script setup lang="ts">
import { computed } from 'vue';
import { useRouter } from 'vue-router';
import { useAuth } from '@/composables/useAuth';
import type { User } from '@/types/User';

const props = defineProps<{
  user: User | null;
}>();

const router = useRouter();
const { logout } = useAuth();

const userInitials = computed(() => {
  if (!props.user?.name) return '?';
  return props.user.name
    .split(' ')
    .map(n => n[0])
    .slice(0, 2)
    .join('')
    .toUpperCase();
});

const handleLogout = () => {
  logout();
  router.push('/login');
};


</script>

<template>
  <div class="user-section">
    <div class="user-info">
      <div class="user-avatar">{{ userInitials }}</div>
      <div class="user-details">
        <p class="user-name">{{ props.user?.name }}</p>
        <p class="user-email">{{ props.user?.email }}</p>
      </div>
    </div>
    <button @click="handleLogout" class="btn-logout">Esci</button>
  </div>
</template>

<style scoped>
  .user-info {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 12px;
  }

  .user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 16px;
  }

  .user-details {
    flex: 1;
    min-width: 0;
  }

  .user-name {
    margin: 0;
    font-size: 14px;
    font-weight: 600;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .user-email {
    margin: 0;
    font-size: 12px;
    opacity: 0.8;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  .btn-logout {
    width: 100%;
    padding: 8px 16px;
    background-color: rgba(255, 255, 255, 0.2);
    border: none;
    border-radius: 6px;
    color: white;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s;
  }

  .btn-logout:hover {
    background-color: rgba(255, 255, 255, 0.3);
  }
</style>