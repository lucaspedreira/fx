<script setup>

const props = defineProps({
    despesas: ''
});

</script>

<template>
    <div class="bg-slate-800 rounded-lg p-4">
        <p class="text-slate-100">Despesas</p>
        <p class="text-rose-400 font-bold">R$ {{ despesas }}</p>
    </div>
</template>

