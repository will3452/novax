
<div x-data="{token: null,}" x-init="token = localStorage.getItem('police-emerge-token')">
    <div class="block md:flex justify-between p-4 bg-yellow-100"  x-show="token == null">
        <div class="font-bold text-xl text-center mb-4 md:mb-0">
            Would you like to save the token of your account on this device, which will help for immediate reporting? 
        </div>
       <div class="text-center">
        <button class="px-2 p-1 rounded bg-green-500 text-white" @click="localStorage.setItem('police-emerge-token', '{{auth()->user()->token}}'); location.reload()">Yes, Proceed.</button>
        <button class="px-2 p-1 rounded bg-red-500 text-white" @click="localStorage.setItem('police-emerge-token', ''); location.reload()">No, Thank you.</button>
       </div>
    </div>
</div>
<nav class="flex p-4 bg-green-500 items-center justify-around absolute top-0 w-screen sticky">
    <img src="/alarm.png" alt="" class="w-10">
    <div class="font-bold text-white">POLICE EMERGE APP</div>
    <a href="/logout" class="text-xs text-red-100 underline">
        LOGOUT
    </a>
</nav>
