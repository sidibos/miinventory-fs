<template>
    <div>
      <h1 class="text-2xl font-bold mb-4">Suppliers</h1>
      <SupplierTable :suppliers="suppliers" @edit="editSupplier" @delete="deleteSupplier" />
      <RouterLink to="/suppliers/create" class="btn btn-primary mt-4">Add Supplier</RouterLink>
    </div>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  import axios from 'axios';
  import SupplierTable from '@/Components/SupplierTable.vue';
  import { useRouter } from 'vue-router';
  
  const suppliers = ref([]);
  const router = useRouter();
  
  const fetchSuppliers = async () => {
    const response = await axios.get('/api/suppliers');
    suppliers.value = response.data;
  };
  
  const editSupplier = (id) => router.push(`/suppliers/${id}/edit`);
  const deleteSupplier = async (id) => {
    await axios.delete(`/api/suppliers/${id}`);
    fetchSuppliers();
  };
  
  onMounted(fetchSuppliers);
  </script>