<script setup lang="ts">
import { ref } from 'vue';

const license_plate = ref('');

const handleSubmit = () => {
  // Logic to handle the vehicle scheduling
  console.log('Scheduling vehicle with license plate:', license_plate.value);
};
</script>

<template>
  <div>
    <Fieldset legend="Dati della prenotazione">
      <div class="add-vehicle-page">
        <div class="flex flex-col gap-6 mb-4">
          <FloatLabel>
            <InputText id="license_plate" v-model="license_plate" />
            <label for="license_plate">Targa</label>
          </FloatLabel>
        </div>

        <Button label="Prenota Veicolo" severity="success" @click="handleSubmit" />
      </div>
    </Fieldset>
  </div>
</template>