<script setup>

import {nextTick, ref} from "vue";
import {useForm} from "@inertiajs/vue3";
import {currencyMask} from "@/Utils/Mask.js";

const isShowModal = ref(false);
const inputDescricaoRef = ref();

const form = useForm({
    valor: '',
    descricao: ''
});

function closeModal() {
    isShowModal.value = false;
}

async function showModal() {
    isShowModal.value = true;
    await nextTick();
    inputDescricaoRef.value.focus();
}

const aplicarMascara = () => {
    form.valor = currencyMask(form.valor);
};

function onSubmit() {
    form.post(route('transactions.store'), {
        onSuccess: () => {
            closeModal();
            form.reset();
        }
    });
}
</script>

<template>


    <button
        @click="showModal"
        class="w-full rounded-lg bg-cyan-500 px-4 py-3 text-cyan-950 text-sm font-bold cursor-pointer">
        ADICIONAR TRANSAÇÃO
    </button>

    <div
        v-show="isShowModal"
        id="crud-modal" tabindex="-1" aria-hidden="true"
        class="overflow-y-auto bg-black/50 overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full mx-auto mt-48">
            <!-- Modal content -->
            <div class="relative bg-slate-950 rounded-lg shadow shadow-slate-500">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-slate-100">
                        Nova transação
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
                                ref="inputDescricaoRef"
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

                    <div class="inline-flex items-center gap-4">
                        <button data-modal-hide="popup-modal" type="button"
                                @click="closeModal"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-slate-200 focus:outline-none bg-slate-700 rounded-lg border border-slate-400 hover:bg-slate-800 focus:z-10 focus:ring-4 focus:ring-slate-100">
                            Cancelar
                        </button>

                        <button type="submit"
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

                </form>
            </div>
        </div>
    </div>

</template>
