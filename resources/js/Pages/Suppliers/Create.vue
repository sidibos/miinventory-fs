<template>
    <div>
      <h1 class="text-2xl font-bold mb-4">Add Supplier</h1>
      <SupplierForm @submit="handleSubmit" />
    </div>
  </template>
  
  <script setup>
  import SupplierForm from '@/Components/SupplierForm.vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  
  const router = useRouter();
  
  const handleSubmit = async (data) => {
    await axios.post('/api/suppliers', data);
    router.push('/suppliers');
  };
  </script>