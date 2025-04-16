<template>
    <div>
      <h1 class="text-2xl font-bold mb-4">Edit Product</h1>
      <ProductForm :product="product" @submit="handleSubmit" />
    </div>
  </template>
  
  <script setup>
  import ProductForm from '@/Components/ProductForm.vue';
  import axios from 'axios';
  import { useRoute, useRouter } from 'vue-router';
  import { ref, onMounted } from 'vue';
  
  const route = useRoute();
  const router = useRouter();
  const product = ref(null);
  
  onMounted(async () => {
    const response = await axios.get(`/api/products/${route.params.id}`);
    product.value = response.data;
  });
  
  const handleSubmit = async (data) => {
    await axios.put(`/api/products/${route.params.id}`, data);
    router.push('/products');
  };
  </script>