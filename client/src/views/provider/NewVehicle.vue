<script setup lang="ts">
import { Button, Fieldset, FloatLabel } from 'primevue';
import InputText from 'primevue/inputtext';
import Toast from 'primevue/toast';
import { useToast } from 'primevue/usetoast';

const toast = useToast();

import { ref } from 'vue';
import api from '@/config/api';
import { useAuth } from '@/composables/useAuth';
import router from '@/router';

const { user } = useAuth();

const brand = ref('');
const model = ref('');
const license_plate = ref('');
const hourly_rate = ref('');

const handleSubmit = async () => {
  try {
    const payload = {
      brand: brand.value,
      model: model.value,
      license_plate: license_plate.value,
      hourly_rate: parseFloat(hourly_rate.value),
    };

    await api.post(`/provider/${user.value?.id}/vehicles`, payload);

    toast.add({ 
      severity: 'success', 
      summary: 'Successo', 
      detail: 'Veicolo aggiunto con successo!' 
    });

    router.push(`/${user.value?.role}/${user.value?.id}/vehicles`);
  } catch (error: any) {
    toast.add({ 
      severity: 'error', 
      summary: 'Errore', 
      detail: error?.response?.data?.message || 'Si è verificato un errore durante l\'aggiunta del veicolo.' 
    });
  }
};
</script>

<template>
  <Fieldset legend="Dati del veicolo">
    <div class="add-vehicle-page">
      <div class="flex flex-col gap-6 mb-4">
        <FloatLabel>
          <InputText id="brand" v-model="brand" />
          <label for="brand">Marca</label>
        </FloatLabel>
        <FloatLabel>
          <InputText id="model" v-model="model" />
          <label for="model">Modello</label>
        </FloatLabel>
        <FloatLabel>
          <InputText id="license_plate" v-model="license_plate" />
          <label for="license_plate">Targa</label>
        </FloatLabel>
        <FloatLabel>
          <InputText id="hourly_rate" v-model="hourly_rate" type="number" step="0.01" />
          <label for="hourly_rate">Tariffa oraria</label>
        </FloatLabel>
      </div>
      
      <Button label="Crea" @click="handleSubmit" />
    </div>
  </Fieldset>
  <Toast />
</template>

<style scoped>
  .add-vehicle-page {
    padding: 24px;
    background-color: #f9fafb;
    border-radius: 8px;
  }

  .add-vehicle-page h1 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 16px;
    color: #111827;
  }
</style>