<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, onMounted } from 'vue';
import 'primeicons/primeicons.css'
import Galleria from 'primevue/galleria';
import Rating from 'primevue/rating';
import ToggleButton from 'primevue/togglebutton';


const props = defineProps({
    product: {
        type: Object,
        required: true,
    },
});

const responsiveOptions = ref([
    {
        breakpoint: '1300px',
        numVisible: 4
    },
    {
        breakpoint: '575px',
        numVisible: 1
    }
]);

const getPhotoUrl = (path) => {
    return path ? `http://localhost:8000/storage/${path}` : 'https://via.placeholder.com/150';
};

const value = ref(null);
const checked = ref(false);
</script>

<template>
    <AppLayout title="product">
        <template #header>
            <h2 class="font-medium font-serif text-2xl text-gray-800 leading-tight">
                Produto
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 overflow-hidden shadow-xl sm:rounded-lg bg-purple-500">
                    <div class="flex items-center justify-center">
                        <Galleria :value="product.photos" :numVisible="5" containerStyle="max-width: 640px"
                            :showThumbnails="false" :showIndicators="true" :changeItemOnIndicatorHover="true"
                            :showIndicatorsOnItem="inside" :indicatorsPosition="position">
                            <template #item="slotProps">
                                <img :src="getPhotoUrl(slotProps.item.photo_path)" :alt="slotProps.item.alt"
                                    style="width: 100%; display: block" />
                            </template>
                        </Galleria>
                    </div>
                    <div class="flex justify-around font-medium font-serif text-2xl">
                        <h2>{{ product.name }}</h2>
                        <h1 class="text-white">{{ product.price }}</h1>
                    </div>
                    <div class="flex justify-center items-center m-4 ">
                        <ToggleButton v-model="checked" onLabel="Adicionado" offLabel="Add ao Carrinho" onIcon="pi pi-check"
                            offIcon="pi pi-cart-plus" class="w-9rem" />
                    </div>
                    <div class="flex items-center justify-center m-4">
                        <h1>avaliação do produto!!</h1>
                        <Rating v-model="value">
                            <template #cancelicon>
                                <img src="https://primefaces.org/cdn/primevue/images/rating/cancel.png" height="24"
                                    width="24" />
                            </template>
                            <template #onicon>
                                <img src="https://primefaces.org/cdn/primevue/images/rating/custom-onicon.png" height="24"
                                    width="24" />
                            </template>
                            <template #officon>
                                <img src="https://primefaces.org/cdn/primevue/images/rating/custom-officon.png" height="24"
                                    width="24" />
                            </template>
                        </Rating>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>


<style>
.p-icon {
    fill: white !important;
    stroke: white !important;
}

.p-icon path {
    fill: white !important;
    stroke: white !important;
}

.p-galleria-indicators li button {
    background-color: white !important;
    border: 1px solid white !important;
}

.p-galleria-indicators .p-highlight button {
    background-color: rgb(255, 21, 149) !important;
    border: 1px solid rgb(255, 21, 149) !important;
}
</style>