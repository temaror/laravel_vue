<template>
    <Head title="Файлы" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Список файлов</h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <section >
                        <div class="flex justify-end m-2 p-2">
                            <Link href="/topics/create"
                                  class="inline-flex items-center px-4 py-2 bg-indigo-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-600 focus:bg-indigo-600 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            >
                                Создать
                            </Link>
                        </div>
                        <div class="p-4">
                            <input type="text" v-model="search" placeholder="Поиск по наименованию" class="px-8 py-3 w-full md:w-2/6 rounded-md bg-gray-100 border-transparent
                    focus:border-gray-500
                    focus:bg-white
                    focus:ring-0
                    text-sm
                ">
                        </div>
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="flex flex-col">
                                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                    <div
                                        class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                        <div class="shadow overflow-hidden order-b border-gray-200m: rounded-lg">
                                            <table class="min-w-full divide-y divide-gray-200">
                                                <thead class="bg-white divide-y divide-grey-200">
                                                <tr class="bg-gray-700 text-white">
                                                    <th
                                                        scope="col" class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                Id
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th
                                                        scope="col" class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                Название
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th
                                                        scope="col" class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                Файл
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th
                                                        scope="col" class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                Расширение
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th
                                                        scope="col" class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                Размер в мб
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th
                                                        scope="col" class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                Скачать
                                                            </div>
                                                        </div>
                                                    </th>
                                                    <th
                                                        scope="col" class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                Действие
                                                            </div>
                                                        </div>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody class="bg-white divide-y divide-grey-200">
                                                <tr v-for="topic in topics.data" :key="topic.id">
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                {{ topic.id }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                {{ topic.name }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-1.5 whitespace-nowrap ">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                <img v-if="topic.image === 1" class="rounded-full h-10 w-10"  :src="'storage/' + topic.file" alt="" />
                                                                <img v-else :src="'storage/file.jpg'" class="rounded-full h-10 w-10" alt="" />

                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                {{ topic.ext }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                {{ bytesToSize(topic.size) }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                <a v-bind:href="'topics/download/' + topic.id"
                                                                   class="text-indigo-600 hover:text-indigo-900"
                                                                >Скачать</a>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-nowrap">
                                                        <div class="flex items-center">
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                <Link
                                                                    :href="`/topics/${topic.id}/edit`"
                                                                    class="text-indigo-600 hover:text-indigo-900">Edit</Link>
                                                            </div>
                                                            <div class="flex-shrink-0 h-10 w-10">
                                                                <button @click="confirmDeleteTopic"
                                                                        class="text-red-600 hover:text-red-900">Delete</button>
                                                                <Modal :show="showConfirmDeleteTopicModal" @close="closeModal">
                                                                    <div class="p-6">
                                                                        <h2 class="text-lg font-semibold text-slate-800">Вы уверены в удалении файла</h2>
                                                                        <div class="mt-6 flex space-x-4">
                                                                            <DangerButton @click="$event => deleteTopic(topic.id)">Удалить</DangerButton>
                                                                            <SecondaryButton @click="closeModal">Отмена</SecondaryButton>
                                                                        </div>
                                                                    </div>
                                                                </Modal>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                            <div class="m-2 p-2">
                                                <div class="flex">
                                                    <template v-for="(link, key) in topics.links" :key="key">
                                                        <div v-if="link.url === null" v-html="link.label" class="mb-1 mr-1 px-4 py-3 text-gray-400 text-sm leading-4 border rounded"></div>

                                                        <Link v-else :href="link.url" v-html="link.label" class="mb-1 mr-1 px-4 py-3 text-sm leading-4 border rounded focus:text-indigo-500 focus:border-indigo-500 hover:bg-white" :class="{'bg-indigo-200': link.active}"/>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>


    </AuthenticatedLayout>
</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link, router, useForm} from '@inertiajs/vue3';
import Modal from "@/Components/Modal.vue";
import DangerButton from "@/Components/DangerButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import {ref, watch, defineProps} from "vue";
const props = defineProps({
    topics: Object,
})

const form = useForm({});
const showConfirmDeleteTopicModal = ref(false)
const confirmDeleteTopic = () =>{
    showConfirmDeleteTopicModal.value = true;
}
const closeModal = () => {
    showConfirmDeleteTopicModal.value = false;
}
const deleteTopic = (id) => {
form.delete(`/topics/${id}`, {
    onSuccess: () => closeModal()
});
}
const search = ref("");
watch(search, (value) => {
    router.get("/topics", { search: value},{preserveState: true, replace: true});
});
function bytesToSize(bytes) {
    return (bytes / (1024*1024)).toFixed(2);
}
</script>

