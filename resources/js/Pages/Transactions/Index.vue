<script setup>
import {Head, Link} from '@inertiajs/vue3';
import TransactionList from "@/Pages/Transactions/List.vue";
import Receitas from "@/Pages/Transactions/Receitas.vue";
import Despesas from "@/Pages/Transactions/Despesas.vue";
import FormModal from "@/Pages/Transactions/FormModal.vue";
import FormModalEdit from "@/Pages/Transactions/FormModalEdit.vue";
import Saldo from "@/Pages/Transactions/Saldo.vue";

const props = defineProps({
    transacoes: Object,
    despesas: '',
    receitas: '',
    transacao: Object,
    saldo: ''
});

</script>

<template>
    <Head title="Início"/>

    <div class="bg-slate-900 flex flex-col h-screen">
        <div class="p-4">
            <h1 class="bg-gradient-to-r from-cyan-500 to-blue-500 text-transparent bg-clip-text font-bold text-3xl text-center py-4">
                Fluxo Financeiro
            </h1>

            <div class="flex justify-evenly mt-4 gap-4">
                <Receitas :receitas="receitas"/>
                <Despesas :despesas="despesas"/>
                <Saldo :saldo="saldo"/>
            </div>

        </div>
        <div v-if="transacoes.length > 0" class="px-4 -mb-4">
            <h2 class="text-slate-100 font-bold p-4">Últimas transações</h2>
        </div>
        <TransactionList :transacoes="transacoes"/>
        <div class="bg-slate-900 p-4">
            <FormModal/>
        </div>
    </div>
    <FormModalEdit :transacao="transacao"/>
</template>



