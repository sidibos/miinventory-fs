<template>
    <div>
      <h1 class="text-2xl font-bold mb-4">Add Product</h1>
      <ProductForm @submit="handleSubmit" />
    </div>
  </template>
  
  <script setup>
  import ProductForm from '@/Components/ProductForm.vue';
  import axios from 'axios';
  import { useRouter } from 'vue-router';
  
  const router = useRouter();
  
  const handleSubmit = async (data) => {
    await axios.post('/api/products', data);
    router.push('/products');
  };
  </script>