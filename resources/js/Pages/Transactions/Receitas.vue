<script setup>
const props = defineProps({
    receitas: ''
});
</script>

<template>
    <div class="bg-slate-800 rounded-lg p-4">
        <p class="text-slate-100">Receitas</p>
        <p class="text-green-400 font-bold">R$ {{ receitas }}</p>
    </div>
</template>
