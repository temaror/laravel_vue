<template>
    <Head title="Topics" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Topics index</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-end m-2 p-2">
                    <Link href="/topics/"
                    class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-600 focus:bg-indigo-600 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"                    >
                        Назад
                    </Link>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section class="max-w-xl">
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">Загрузка файла</h2>
                            <p class="mt-1 text-sm text-gray-600"> Загрузите ваш файл </p>
                        </header>
                        <form  @submit.prevent="storeTopic"
                               enctype="multipart/form-data"  class="mt-6 space-y-6">
                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="name">
                                    <span>Название</span>
                                </label>
                                    <input type="name" id="name" v-model="form.name" name="name" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                <div class="mt-2" style="display: none;">
                                    <p class="text-sm text-red-600">

                                    </p>
                                </div>
                            </div>
                            <div>
                                <label class="block font-medium text-sm text-gray-700" for="email">
                                    <span>Файл</span>
                                </label>
                                    <input type="file" id="file" @input="form.file = $event.target.files[0]" name="file" class="block w-full transition duration-150 ease-in-out appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                <div class="mt-2" style="display: none;">
                                    <p class="text-sm text-red-600"></p>
                                </div>
                                <div class="mt-2" style="">
                                    <div v-if="errors.file" class="text-sm text-red-600">{{ errors.file }}</div>
                                </div>
                            </div><!--v-if-->
                            <progress v-if="form.progress" :value="form.progress.percentage" max="100">
                                {{ form.progress.percentage }}%
                            </progress>
                            <div class="flex items-center gap-4">
                                <button class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    Сохранить
                                </button><!--v-if-->
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
defineProps({ errors: Object })
const form = useForm({
    name: null,
    file: null,
})

function storeTopic() {
    form.post('/topics')
}
</script>
