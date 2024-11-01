@props(['selectedYear' => now()->year])
<div class="space-y-10">
    <div class="my-20">
        <div>
            <img src="/storage/{{nova_get_setting('logo')}}" class="w-[150px] mx-auto" alt="">
        </div>
        <div class="text-center text-3xl">
            RPCCI LAPAZ
        </div>
        <div class="text-center text-4xl font-bold">
            {{$slot}}
        </div>
    </div>
    <div class="text-center">
        <div>Submitted To:</div>
        <div class="font-bold">
            {{nova_get_setting('senior_pastor', 'Ptra. Bonna Jo-Anne Alvares-Bernales')}}
        </div>
        <div>
            Senior Pastor
        </div>
    </div>
    <div class="grid grid-cols-2">
        <div class="text-center relative">
            <div>Approved By:</div>
            <div class="font-bold mt-4">
                {{nova_get_setting('pastor', 'Ptr. Fredie Catabay')}}
            </div>
            <img src="/storage/{{nova_get_setting('p_sign')}}" class="w-[100px] absolute left-[140px] top-0" alt="">
            <div>
                Pastor
            </div>
        </div>
        <div class="text-center relative">
            <div>Prepared By:</div>
            <img src="/storage/{{nova_get_setting('s_sign')}}" class="w-[100px] absolute left-[140px] top-0" alt="">
            <div class="font-bold mt-4">
                {{nova_get_setting('secretary', 'Krezele Paladan')}}
            </div>
            <div>
                Secretary
            </div>
        </div>
    </div>
</div>
