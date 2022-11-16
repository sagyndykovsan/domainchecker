<template>
<div class="">
    <form @submit.prevent="checkDomains" >
        <div class="flex flex-col max-w-md pt-3 pl-2 space-y-3">
            <label for=""><h1>Insert your domains:</h1></label>
           <div class="flex items-center">
            <textarea v-model="domains" name="domains" id="domains" class="w-80 p-2 border border-2 border-gray-700"></textarea>
            <button type="submit" class="bg-indigo-500 p-2 px-3 rounded-sm ml-5">
                Check
            </button>
           </div>
        </div>
    </form>

    <pre>
        {{domainList}}
    </pre>
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
        console.log(domain)
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