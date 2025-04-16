<template>
    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block font-bold mb-1">Name</label>
        <input v-model="form.name" class="input" required />
      </div>
      <div class="mb-4">
        <label class="block font-bold mb-1">SKU</label>
        <input v-model="form.sku" class="input" required />
      </div>
      <div class="mb-4">
        <label class="block font-bold mb-1">Description</label>
        <textarea v-model="form.description" class="input"></textarea>
      </div>
      <div class="mb-4">
        <label class="block font-bold mb-1">Category ID</label>
        <input v-model="form.category_id" class="input" type="number" required />
      </div>
      <div class="mb-4">
        <label class="block font-bold mb-1">Unit ID</label>
        <input v-model="form.unit_id" class="input" type="number" required />
      </div>
      <div class="mb-4">
        <label class="block font-bold mb-2">Variants</label>
        <div v-for="(variant, index) in form.variants" :key="index" class="flex space-x-2 mb-2">
          <input v-model="variant.name" placeholder="Name" class="input" />
          <input v-model.number="variant.price" placeholder="Price" type="number" class="input" />
          <input v-model.number="variant.stock" placeholder="Stock" type="number" class="input" />
          <button @click.prevent="removeVariant(index)" class="btn btn-danger">Remove</button>
        </div>
        <button @click.prevent="addVariant" class="btn btn-secondary">Add Variant</button>
      </div>
      <button class="btn btn-primary" type="submit">Save</button>
    </form>
  </template>
  
  <script setup>
  import { reactive, toRefs, watchEffect } from 'vue';
  import { computed } from 'vue';
  
  const props = defineProps({ product: Object });
  const emit = defineEmits(['submit']);
  
  const form = reactive({
    name: '',
    sku: '',
    description: '',
    category_id: '',
    unit_id: '',
    variants: []
  });
  
  watchEffect(() => {
    if (props.product) Object.assign(form, props.product);
  });
  
  const addVariant = () => {
    form.variants.push({ name: '', price: 0, stock: 0 });
  };
  
  const removeVariant = (index) => {
    form.variants.splice(index, 1);
  };
  
  const submit = () => {
    emit('submit', { ...form });
  };
  </script>