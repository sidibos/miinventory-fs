<template>
    <table class="table w-full">
      <thead>
        <tr>
          <th>Name</th>
          <th>SKU</th>
          <th>Category</th>
          <th>Unit</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="product in products" :key="product.id">
          <td>{{ product.name }}</td>
          <td>{{ product.sku }}</td>
          <td>{{ product.category.name }}</td>
          <td>{{ product.unit.name }}</td>
          <td>
            <button @click="$emit('edit', product.id)" class="btn btn-sm btn-warning">Edit</button>
            <button @click="$emit('delete', product.id)" class="btn btn-sm btn-danger">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </template>
  
  <script setup>
  const props = defineProps({ products: Array });
  </script>