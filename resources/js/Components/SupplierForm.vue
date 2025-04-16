<template>
    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block font-bold mb-1">Name</label>
        <input v-model="form.name" class="input" required />
      </div>
      <div class="mb-4">
        <label class="block font-bold mb-1">Email</label>
        <input v-model="form.email" class="input" type="email" />
      </div>
      <div class="mb-4">
        <label class="block font-bold mb-1">Phone</label>
        <input v-model="form.phone" class="input" type="text" />
      </div>
      <div class="mb-4">
        <label class="block font-bold mb-1">Address</label>
        <textarea v-model="form.address" class="input"></textarea>
      </div>
      <div class="mb-4">
        <label class="block font-bold mb-1">Tax Number</label>
        <input v-model="form.tax_number" class="input" type="text" />
      </div>
      <button class="btn btn-primary" type="submit">Save</button>
    </form>
  </template>
  
  <script setup>
  import { reactive, watchEffect } from 'vue';
  
  const props = defineProps({ supplier: Object });
  const emit = defineEmits(['submit']);
  
  const form = reactive({
    name: '',
    email: '',
    phone: '',
    address: '',
    tax_number: ''
  });
  
  watchEffect(() => {
    if (props.supplier) Object.assign(form, props.supplier);
  });
  
  const submit = () => {
    emit('submit', { ...form });
  };
  </script>