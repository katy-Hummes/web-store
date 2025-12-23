<script setup>
import { ref } from 'vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});


</script>

<template>
    <div class="sm:flex sm:justify-center sm:items-center min-h-screen bg-center"
        style="background-image: url('photos/background.png');">
        <div v-if="canLogin" class="p-6 border-black border-2 rounded-full bg-gray-800 bg-opacity-60 z-10">
            <Link v-if="$page.props.auth.user.type.buyer" :href="route('dashboard')"
                class="font-semibold text-gray-100 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm">
            Dashboard</Link>
            <template v-else>
                <Link :href="route('login')"
                    class="font-semibold text-gray-100 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm">
                Log in</Link>

                <Link v-if="canRegister" :href="route('register')"
                    class="ms-4 font-semibold text-gray-100 hover:text-gray-900 focus:outline focus:outline-2 focus:rounded-sm">
                Register</Link>
            </template>
        </div>
        <div>
            <img src="/photos/astronauta.png" alt="Astronauta" class="floating">
        </div>
    </div>
</template>

<style>
@keyframes floatAnimation {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-20px);
    }
}

.floating {
    animation: floatAnimation 5s ease-in-out infinite;
}
</style>
