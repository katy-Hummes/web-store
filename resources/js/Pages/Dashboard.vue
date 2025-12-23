<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, onMounted } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    user: Object,
});

const category = ref(1);

const products = ref([]);

console.log('products', products.value);

onMounted(() => {
    console.log('mounted');
    fetch('/products')
        .then(response => {
            if (!response.ok) {
                throw new Error('Erro ao carregar os products');
            }
            return response.json();
        })
        .then(data => {
            products.value = data;
            console.log('products2', products.value);
        })
        .catch(error => {
            console.error('Erro:', error);
        });
});

const getPhotoUrl = (path) => {
    return path ? `http://localhost:8000/storage/${path}` : 'https://via.placeholder.com/150';
};
</script>

<template>
    <AppLayout title="Dashboard" :user="user">

        {{ products }}

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class=" overflow-hidden shadow-xl sm:rounded-lg text-white bg-purple-500">
                    <button class="m-4 py-2 px-4 border rounded-full" @click="category = 1">MASCULINO</button>
                    <button class="m-4 py-2 px-4 border rounded-full" @click="category = 2">FEMININO</button>
                    <button class="m-4 py-2 px-4 border rounded-full" @click="category = 3">INFANTIL</button>
                </div>
                <div>
                    <div v-if="category === 1">MASCULINO</div>
                    <div v-if="category === 2">FEMININO</div>
                    <div v-if="category === 3">INFANTIL</div>
                </div>
                <div class="bg-white p-4 grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 2xl:grid-cols-5 gap-4 rounded-xl">
                    <div v-for="product in products" :key="product.id">
                        <Link :href="route('show.product', product.id)">
                        <img :src="getPhotoUrl(product.photos[0].photo_path)" alt="Foto do product" class="rounded-xl">
                        </Link>
                        <div class="flex justify-around font-serif font-medium">
                            <h1>{{ product.name }}</h1>
                            <h2 class="text-red-500">{{ product.price }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </AppLayout>
</template>

