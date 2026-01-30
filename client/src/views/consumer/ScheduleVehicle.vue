<script setup lang="ts">
import { computed, ref } from 'vue';
import { useRoute } from 'vue-router';
import DatePicker from 'primevue/datepicker';
import FloatLabel from 'primevue/floatlabel';
import Fieldset from 'primevue/fieldset';
import { Button } from 'primevue';

const route = useRoute();

const vehicleId = route.params.vehicleId;

const startDate = ref<Date | null>(null);
const endDate = ref<Date | null>(null);

const hourlyRate = ref((history.state.hourlyRate as number) || 0);

const estimatedPrice = computed(() => {
  if (!startDate.value || !endDate.value || !hourlyRate.value) {
    return 0;
  }

  const hours = Math.max(0, (endDate.value!.getTime() - startDate.value!.getTime()) / (1000 * 60 * 60));

  return (hours * hourlyRate.value).toFixed(2);
});

const handleSubmit = () => {
  // Logic to handle the vehicle scheduling
  console.log('Scheduling vehicle from:', startDate.value, 'to:', endDate.value, 'Final price:', estimatedPrice.value);
};
</script>

<template>
  <div class="p-24">
    <header class="mb-6">
      <h1>Prenota un veicolo</h1>
    </header>
    <Fieldset legend="Dati della prenotazione">
      <div class="schedule-vehicle-page mt-4">
        <div class="flex flex-col gap-6 mb-4">
          <FloatLabel>
            <DatePicker id="start_date" v-model="startDate" show-time />
            <label for="start_date">Data e ora di inizio</label>
          </FloatLabel>
          <FloatLabel>
            <DatePicker id="end_date" v-model="endDate" show-time />
            <label for="end_date">Data e ora di fine</label>
          </FloatLabel>
        </div>

        <div v-if="Number(estimatedPrice) > 0" class="mb-4 p-4 bg-green-50 rounded-lg">
          <p class="text-lg font-semibold">Prezzo: € {{ estimatedPrice }}</p>
        </div>

        <Button 
          label="Prenota Veicolo" 
          severity="success" 
          @click="handleSubmit" 
        />
      </div>
    </Fieldset>
  </div>
</template>