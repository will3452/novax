<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.7.16/dist/vue.js"></script>
</head>
<body class="bg-gray-100">
    <div class="space-y-4 p-2 overflow-y-auto h-[90vh]">
        <div class="flex gap-2 items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
              </svg>

              <h1 class="font-bold text-xl">Feedback</h1>
        </div>
       <div class="space-y-2">
        @php
            $rec = $vrf;
        @endphp
        <table class="border w-full bg-white">
            <tr>
                <th class="border p-2">
                    Name
                </th>
                <td class="border p-2 text-center">
                    {{$rec->driver->first_name}} {{$rec->driver->last_name}}
                </td>
            </tr>
            <tr>
                <th class="border p-2">
                    Campus
                </th>
                <td class="border p-2 text-center">
                    {{$rec->driver->campus}}
                </td>
            </tr>
        </table>
        <form action="/feedback" method="POST" class="mt-2 space-y-4" id="star">
            @csrf
            <input type="hidden" name="driver_id" value="{{$rec->driver_id}}" />
            <input type="hidden" name="vrf_id" value={{$rec->id}} />
            <div class="flex gap-2 justify-center">
                <button type="button" v-for="i in 5" :key="i" @click="() => star = i">
                    <svg xmlns="http://www.w3.org/2000/svg"  :fill="i <= star ? 'orange': '#aaa'" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-10">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                      </svg>
                </button>
            </div>
            <input type="hidden" v-model="star" max="5" min="1" name="star" class="border w-full p-2 rounded-md" placeholder="Star">
            <button type="submit" class="w-full bg-blue-800 text-white p-2 font-bold rounded-full border-2 ">SUBMIT</button>
        </form>
       </div>
    </div>
    <x-back-home></x-back-home>
    <script>
        new Vue({
            el: '#star',
            data() {
                return {
                    star: 3,
                }
            }
        })
    </script>
</body>
</html>
