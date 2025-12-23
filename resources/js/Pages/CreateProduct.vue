<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from 'laravel-precognition-vue-inertia'
import InputNumber from 'primevue/inputnumber';
import Toast from 'primevue/toast';
import { useToast } from "primevue/usetoast";
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    user: Object
});

const toast = useToast();

const form = useForm('post', '/criar-produto', {
    name: '',
    price: null,
    photos: [],
});

const submit = () => {
    console.log("Submit chamado");

    form.submit({
        headers: {
            'Content-Type': 'multipart/form-data',
        },
        preserveScroll: true,
        onSuccess: () => {
            form.reset()
            toast.add({
                severity: "success",
                summary: "Sucesso",
                detail: "Produto criado com sucesso",
                life: 5000,
            });
            console.log(form)
            document.getElementById('files').value = null;
        }
    });
};

const fileSelects = (event) => {
    console.log("evento chamado", event);
    form.photos = Array.from(event.target.files);
};

</script>

<template>
    <Toast />
    <AppLayout title="Dashboard" :user="user">
        <template #header>
            <h2 class="font-medium font-serif text-2xl text-gray-900 leading-tight">
                Criar Produto
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="overflow-hidden shadow-xl sm:rounded-lg flex flex-row bg-purple-500">
                    <div class="p-6">
                        <form @submit.prevent="submit">

                            <div class="">
                                <label class="text-white" for="name">Nome</label>
                            <input type="text" name="name" id="name" v-model="form.name" @change="form.validate('name')"
                                class="border-none m-4 py-2 px-4 border rounded-full">
                            <div v-if="form.invalid('name')">
                                {{ form.errors.name }}
                            </div>

                            <label class="text-white" for="price">Preço</label>
                            <InputNumber name="price" id="price" v-model="form.price" mode="currency" currency="BRL"
                                @change="form.validate('price')" />
                            <div v-if="form.invalid('price')">
                                {{ form.errors.price }}
                            </div>

                            <div>
                                <label for="">Imagens do Produto</label>
                                <input id="files" type="file" @change="fileSelects($event)" multiple>
                            </div>

                           
                            </div>

                            <button class="m-4 py-2 px-4 border rounded-full font-bold text-white hover:text-purple-300"
                                :disabled="form.processing" type="submit">Criar</button>

                        </form>
                    </div>
                </div>

                <Link :href="route('show.seller', user.id)">Veja seus Produtos</Link>
                <!-- veja seus produtos -->
            </div>
        </div>
    </AppLayout>
</template>