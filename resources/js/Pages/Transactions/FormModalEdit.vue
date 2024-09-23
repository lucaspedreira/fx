<script setup>

import {computed, watch} from "vue";
import {router, useForm, Link} from "@inertiajs/vue3";
import {currencyMask} from "@/Utils/Mask.js";

const props = defineProps({
    transacao: Object
});

const isShowEditModal = computed(() => !!props.transacao)

const form = useForm({
    valor: props.transacao?.valor,
    descricao: props.transacao?.descricao,
});

watch(() => props.transacao, (transacao) => {
    if (transacao) {
        form.valor = transacao.valor;
        form.descricao = transacao.descricao;
    }
})

function closeModal() {
    router.get(route('transactions.index'), {}, {
        preserveState: true,
    });
}

const aplicarMascara = () => {
    form.valor = currencyMask(form.valor);
};

function onSubmit() {
    form.put(route('transactions.update', {transacao: props.transacao.id}), {
        preserveState: true,
    });
}
</script>

<template>
    <div
        v-show="isShowEditModal"
        id="crud-modal" tabindex="-1" aria-hidden="true"
        class="overflow-y-auto bg-black/50 overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full mx-auto mt-48">
            <!-- Modal content -->
            <div class="relative bg-slate-950 rounded-lg shadow shadow-slate-500">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-slate-100">
                        Alterar transação
                    </h3>
                    <button type="button"
                            @click="closeModal"
                            class="text-slate-400 bg-transparent hover:bg-slate-600 hover:text-slate-300 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                            data-modal-toggle="crud-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                             viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <form @submit.prevent="onSubmit()" class="p-4 md:p-5">
                    <div class="grid gap-4 mb-4 grid-cols-1">
                        <div>
                            <label for="name"
                                   class="block mb-2 text-sm font-medium text-slate-300 dark:text-white">Descrição</label>
                            <input
                                v-model="form.descricao"
                                type="text" name="name" id="name"
                                class="border text-gray-900 text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-slate-600 placeholder-slate-400 text-white focus:ring-cyan-500 focus:border-cyan-500"
                                placeholder="Descrição da transação">
                            <p v-if="form.errors.descricao" class="text-xs text-rose-400 px-2 mt-1">
                                {{ form.errors.descricao }}</p>
                        </div>
                        <div>
                            <label for="price" class="block mb-2 text-sm font-medium text-slate-300">Valor</label>
                            <input
                                v-model="form.valor"
                                @input="aplicarMascara"
                                type="tel" name="price" id="price"
                                class="border text-gray-900 text-sm rounded-lg block w-full p-2.5 bg-gray-700 border-slate-600 placeholder-slate-400 text-white focus:ring-cyan-500 focus:border-cyan-500"
                                placeholder="0,00">
                            <p class="text-xs text-slate-400 px-2 mt-1">Use o sinal de menos (-) para despesas</p>
                            <p v-if="form.errors.valor" class="text-xs text-rose-400 px-2 mt-1">
                                {{ form.errors.valor }}</p>
                        </div>
                    </div>

                    <div class="inline-flex items-center gap-4 mt-4 w-full">

                        <div class="w-full inline-flex items-center gap-4">
                            <button data-modal-hide="popup-modal" type="button"
                                    @click="closeModal"
                                    class="py-2.5 px-5 ms-3 text-sm font-medium text-slate-200 focus:outline-none bg-slate-700 rounded-lg border border-slate-400 hover:bg-slate-800 focus:z-10 focus:ring-4 focus:ring-slate-100">
                                Cancelar
                            </button>

                            <button type="submit"
                                    tabindex="1"
                                    class="text-white inline-flex border border-cyan-400 items-center bg-cyan-700 hover:bg-cyan-800 focus:ring-4 focus:outline-none focus:ring-cyan-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                          d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                          clip-rule="evenodd"></path>
                                </svg>
                                Salvar
                            </button>
                        </div>

                        <div>
                            <Link
                                :href="route('transactions.destroy', {transacao: props.transacao?.id})"
                                method="delete"
                                as="button"
                                @keydown.enter.prevent
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                                </svg>

                            </Link>
                        </div>

                    </div>

                </form>
            </div>
        </div>
    </div>

</template>
