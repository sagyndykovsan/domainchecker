<template>
<div class="">
    <form @submit.prevent="checkDomains" >
        <div class="flex flex-col max-w-md pt-3 pl-2 space-y-3">
            <label for=""><h1>Insert your domains:</h1></label>
           <div class="flex items-center">
            <textarea name="domains" id="domains" class="w-80 p-2 border border-2 border-gray-700"></textarea>
            <button type="submit" class="bg-indigo-500 p-2 px-3 rounded-sm ml-5">
                Check
            </button>
           </div>
        </div>
    </form>
</div>
</template>

<script setup>

</script>