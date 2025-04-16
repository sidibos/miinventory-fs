<template>
    <div>
      <h1 class="text-2xl font-bold mb-4">Products</h1>
      <ProductTable :products="products" @edit="editProduct" @delete="deleteProduct" />
      <RouterLink to="/products/create" class="btn btn-primary mt-4">Add Product</RouterLink>
    </div>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  import axios from 'axios';
  import ProductTable from '@/Components/ProductTable.vue';
  import { useRouter } from 'vue-router';
  
  const products = ref([]);
  const router = useRouter();
  
  const fetchProducts = async () => {
    const response = await axios.get('/api/products');
    products.value = response.data;
  };
  
  const editProduct = (productId) => {
    router.push(`/products/${productId}/edit`);
  };
  
  const deleteProduct = async (productId) => {
    await axios.delete(`/api/products/${productId}`);
    fetchProducts();
  };
  
  onMounted(fetchProducts);
  </script>