<script setup>
import {Link} from "@inertiajs/vue3";
import FormModalEdit from "@/Pages/Transactions/FormModalEdit.vue";

const props = defineProps({
    transacoes: Object
});

function cor(valor) {
    return parseInt(valor) > 0 ? 'text-green-500' : 'text-red-500';
}
</script>

<template>
    <div class="flex-1 max-h-full overflow-y-auto p-4">
        <div v-for="transacao in transacoes" key="transacao.id"
             class="mb-4 text-slate-200 bg-slate-800 hover:bg-slate-950 border border-slate-600 rounded-lg">
            <Link :href="route('transactions.index', transacao.id)" preserve-state>
                <div class="flex justify-between p-4">
                    <p>{{ transacao.descricao }}</p>
                    <p :class="cor(transacao.valor)">{{ transacao.valor }}</p>
                </div>
            </Link>
        </div>

        <p v-if="transacoes.length === 0" class="text-slate-100 text-center mt-4">Nenhuma transação encontrada</p>

    </div>
</template>
