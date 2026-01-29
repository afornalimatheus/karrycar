<script setup lang="ts">
import { ref, onMounted } from 'vue';
import Header from '@/components/dashboard/Header.vue';
import QuickActions from '@/components/dashboard/QuickActions.vue';
import ProviderStats from '@/components/dashboard/provider/ProviderStats.vue';
import type { ProviderStats as ProviderStatsType } from '@/types/Provider';
import type { ConsumerStats as ConsumerStatsType } from '@/types/Consumer';
import ConsumerStats from '@/components/dashboard/consumer/ConsumerStats.vue';

import { useAuth } from '@/composables/useAuth';
import api from '@/config/api';

const { user } = useAuth();

const providerStats = ref<ProviderStatsType>({
  active_reservations: 0,
  total_vehicles: 0,
  completed_reservations: 0,
  vehicles: 0
});

const consumerStats = ref<ConsumerStatsType>({
  availableVehicles: 0,
  completedReservations: 0,
  activeReservations: 0,
  monthlyExpenses: 0
});

onMounted(async () => {
  if (user?.value?.role === 'provider') {
    const response: { data: ProviderStatsType } = await api.get(`/provider/${user.value?.id}/dashboard/stats`);

    providerStats.value = response.data;
  }

  if (user?.value?.role === 'consumer') {
    consumerStats.value = {
      availableVehicles: 3,
      completedReservations: 2,
      activeReservations: 12,
      monthlyExpenses: 450
    };
  }
});
</script>

<template>
  <div class="dashboard">
    <Header />

    <ProviderStats 
      v-if="user?.role === 'provider'" 
      :stats="providerStats" 
    />

    <ConsumerStats 
      v-else-if="user?.role === 'consumer'" 
      :stats="consumerStats" 
    />

    <QuickActions />
  </div>
</template>

<style scoped>
.dashboard {
  max-width: 1200px;
}
</style>
