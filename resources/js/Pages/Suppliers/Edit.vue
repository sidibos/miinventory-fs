<template>
    <div>
      <h1 class="text-2xl font-bold mb-4">Edit Supplier</h1>
      <SupplierForm :supplier="supplier" @submit="handleSubmit" />
    </div>
  </template>
  
  <script setup>
  import SupplierForm from '@/Components/SupplierForm.vue';
  import { ref, onMounted } from 'vue';
  import axios from 'axios';
  import { useRoute, useRouter } from 'vue-router';
  
  const supplier = ref(null);
  const route = useRoute();
  const router = useRouter();
  
  onMounted(async () => {
    const response = await axios.get(`/api/suppliers/${route.params.id}`);
    supplier.value = response.data;
  });
  
  const handleSubmit = async (data) => {
    await axios.put(`/api/suppliers/${route.params.id}`, data);
    router.push('/suppliers');
  };
  </script>