<div class="flex bg-green-900 p-4 flex-wrap">
    <div class="md:w-1/3 w-full mb-4">
        <img src="/logo.png" alt="" class="w-12 h-12">
        <h2 class="text-white font-bold">Cultural, Historical & Tourism Promotions Division</h2>
        <h3 class="text-white">
            City Of Parañaque
        </h3>
    </div>
    <div class="md:w-1/3 w-full mb-4">
        <h2 class="text-white font-bold">Links</h2>
        <div>
            <a href="/" class="text-white underline underline-offset-2 flex items-center">
                <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 0 0-5.656 0l-4 4a4 4 0 1 0 5.656 5.656l1.102-1.101m-.758-4.899a4 4 0 0 0 5.656 0l4-4a4 4 0 0 0-5.656-5.656l-1.1 1.1"/></svg>
                Home
            </a>
        </div>
        <div>
            <a href="/about" class="text-white underline underline-offset-2 flex items-center">
                <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 0 0-5.656 0l-4 4a4 4 0 1 0 5.656 5.656l1.102-1.101m-.758-4.899a4 4 0 0 0 5.656 0l4-4a4 4 0 0 0-5.656-5.656l-1.1 1.1"/></svg>
                About Us
            </a>
        </div>
        <div>
            <a href="/search" class="text-white underline underline-offset-2 flex items-center">
                <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 0 0-5.656 0l-4 4a4 4 0 1 0 5.656 5.656l1.102-1.101m-.758-4.899a4 4 0 0 0 5.656 0l4-4a4 4 0 0 0-5.656-5.656l-1.1 1.1"/></svg>
                Destinations
            </a>
        </div>
    </div>
    <div class="md:w-1/3 w-full mb-4 ">
        <h2 class="text-white font-bold">Contacts</h2>
        <div class="flex items-center text-white">
            <svg class="mr-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"><path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75"/></svg>
            {{ nova_get_setting('email', 'test@gmail.com') }}
        </div>
        <div class="flex items-center text-white">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2" width="16" height="16" viewBox="0 0 24 24"><path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 0 1 2-2h3.28a1 1 0 0 1 .948.684l1.498 4.493a1 1 0 0 1-.502 1.21l-2.257 1.13a11.042 11.042 0 0 0 5.517 5.516l1.128-2.257a1 1 0 0 1 1.21-.502l4.494 1.498a1 1 0 0 1 .684.949V19a2 2 0 0 1-2 2h-1C9.716 21 3 14.284 3 6z"/></svg>
            {{nova_get_setting('phone', '09121808887')}}
        </div>
    </div>
</div>