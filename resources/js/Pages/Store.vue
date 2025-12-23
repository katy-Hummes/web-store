<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
    products: Array
});

const getPhotoUrl = (path) => {
    return path ? `http://localhost:8000/storage/${path}` : 'https://via.placeholder.com/150';
};
</script>

<template>
    <AppLayout title="Store" :user="user">
        <template #header>
            <h2 class="font-medium font-serif text-2xl text-gray-800 leading-tight">
                Loja
            </h2>
        </template>
        <div class="bg-white mt-4 mx-4 p-4 grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 rounded-xl">
            <div v-for="product in products" :key="product.id">
                <Link :href="route('show.product', product)">
                <img :src="getPhotoUrl(product.photos[0].photo_path)" alt="Foto do Produto" class="rounded-xl">

                <div class="flex justify-around font-serif font-medium">
                    <h1>{{ product.name }}</h1>
                    <h2 class="text-red-500">{{ product.price }}</h2>
                </div>
                </Link>
            </div>
        </div>
    </AppLayout>
</template>