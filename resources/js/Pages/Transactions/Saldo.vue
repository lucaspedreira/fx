<script setup>
const props = defineProps({
    saldo: ''
});
</script>

<template>
    <div class="bg-slate-800 rounded-lg p-4">
        <p class="text-slate-100">Saldo</p>
        <p class="text-orange-400 font-bold">R$ {{ saldo }}</p>
    </div>
</template>
