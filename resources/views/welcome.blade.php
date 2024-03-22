<x-layout>
    <div class="mx-auto max-w-[950px]">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <img src="/cover.png" class="w-full"/>
            <div class="py-4 px-2 text-center md:text-left">
                <h1 class="text-[60px] font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" class="inline-block" viewBox="0 0 24 24"><path fill="#888888" d="M3.691 6.292C5.094 4.771 7.217 4 10 4h1v2.819l-.804.161c-1.37.274-2.323.813-2.833 1.604A2.902 2.902 0 0 0 6.925 10H10a1 1 0 0 1 1 1v7c0 1.103-.897 2-2 2H3a1 1 0 0 1-1-1v-5l.003-2.919c-.009-.111-.199-2.741 1.688-4.789M20 20h-6a1 1 0 0 1-1-1v-5l.003-2.919c-.009-.111-.199-2.741 1.688-4.789C16.094 4.771 18.217 4 21 4h1v2.819l-.804.161c-1.37.274-2.323.813-2.833 1.604A2.902 2.902 0 0 0 17.925 10H21a1 1 0 0 1 1 1v7c0 1.103-.897 2-2 2"/></svg>
                    Sa bawat takbo, serbisyong tapat at tiwala. <svg class="inline-block" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"><path fill="#888888" d="M20.309 17.708C22.196 15.66 22.006 13.03 22 13V5a1 1 0 0 0-1-1h-6c-1.103 0-2 .897-2 2v7a1 1 0 0 0 1 1h3.078a2.89 2.89 0 0 1-.429 1.396c-.508.801-1.465 1.348-2.846 1.624l-.803.16V20h1c2.783 0 4.906-.771 6.309-2.292m-11.007 0C11.19 15.66 10.999 13.03 10.993 13V5a1 1 0 0 0-1-1h-6c-1.103 0-2 .897-2 2v7a1 1 0 0 0 1 1h3.078a2.89 2.89 0 0 1-.429 1.396c-.508.801-1.465 1.348-2.846 1.624l-.803.16V20h1c2.783 0 4.906-.771 6.309-2.292"/></svg>
                </h1>
                <a href="/booking" class="bg-blue-800 font-bold p-4 text-[30px] text-white border-r-4 border-b-4 border-gray-300">BOOK NOW</a>
            </div>
        </div>
    </div>
    <div class=" w-screen bg-blue-800" id="about">
        <div class="mx-auto max-w-[950px] py-8 ">
            <h1 class="text-center md:text-left p-4 text-4xl md:text-[60px] uppercase font-bold text-blue-100 ">About Us</h1>
            <div class="text-white tracking-wide overflow-auto text-2xl px-2">
                {{ nova_get_setting('about', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nulla accusamus architecto eos magnam ipsa quaerat ullam, rem delectus enim laudantium esse laboriosam modi assumenda nisi. Repellendus at maxime quod provident ea aspernatur placeat error quisquam voluptas sed aliquam, qui accusantium odit. Distinctio sapiente harum cupiditate neque repudiandae illum. Iusto nam aut itaque eos ipsam expedita similique laudantium, quis ad vero recusandae reprehenderit exercitationem adipisci incidunt obcaecati sit maxime illo tempora, commodi soluta suscipit amet repellendus. Sed corrupti error sit temporibus blanditiis sequi, illo autem libero veritatis cum, nam harum. Animi quas fugiat voluptatum alias cumque doloremque est, eos velit cupiditate.')}}
            </div>
        </div>
    </div>
    <div class="text-center p-4 font-thin">
        Copyright {{now()->format('Y')}} - {{env('APP_NAME')}}
    </div>
</x-layout>