<template>
<div class="">
    <form @submit.prevent="checkDomains" >
        <div class="flex flex-col pt-3 max-w-2xl pl-2 space-y-3 text-lg">
            <label for=""><h1>Введите интересующие вас домены:</h1></label>
           <div class="flex items-center">
            <textarea v-model="domains" rows="8" name="domains" id="domains" class="w-80 p-2 border border-2 border-gray-700"></textarea>
            <button type="submit" class="bg-indigo-500 p-2 px-3 rounded-sm ml-5">
                Проверить
            </button>
           </div>
        </div>
    </form>

    <table class="mt-20 text-lg mb-20">
        <tr class="grid grid-cols-3 gap-5 text-left bg-gray-300">
            <th class="">Имя домена</th>
            <th class="">Действительность домена</th>
            <th class="">Срок истечения</th>
        </tr>
        <tr v-for="(domain, i) in domainList" 
        class="grid grid-cols-3 gap-5"
        :class="[i % 2 != 0 ? 'bg-gray-300' : 'bg-gray-100',
                    !domain['registered'] && domain['isValid'] ? 'bg-emerald-500' : '',
                    domain['isValid'] ? '' : 'bg-red-500']">
            <td>{{domain['name']}}</td>
            <td>{{domain['isValid'] ? 'действителен' : 'не действителен'}}</td>
            <td>{{ domain['registered'] ? domain['expire_date'] : domain['isValid'] ? 'свободен' : '' }}</td>
        </tr>
    </table>
</div>
</template>

<script setup>
import { ref } from 'vue';


const domains = ref('');
const domainList = ref([]);

function checkDomains() {
    let formated = domains.value.trim().replace(/(\n)+/g, "\n");
    let result = formated.split(/\n|\s/);

    // Clear domainList when sending request
    domainList.value = [];

    result.forEach(domain => {
        fetch('http://localhost:8000/api/test', {
            method: 'POST',
            headers: {
               'Content-type': 'application/json',
               'Accept': 'application/json',
            },
            body: JSON.stringify({ domain })
        }).then(res => res.json())
          .then(res => {
            domainList.value.push(res);
          });
    });
}

</script>