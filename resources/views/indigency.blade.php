<x-document>
    <div class="p-8">
        <h1 class="text-center font-bold">
            OFFICE OF THE PUNONG BARANGAY
        </h1>
        <h1 class="text-center text-green-500 font-bold text-3xl mt-4" style="font-family: bodoni; font-style: italic;">
            Indigent Certificate
        </h1>
        <div class="font-bold mt-4" style="font-family: forte;">
            TO WHOM IT MAY CONCERN:
        </div>
        <div>
            <p class="par">
                THIS IS TO CERTIFY THAT;  {{$profile->first_name}} {{$profile->last_name}}, {{$profile->civil_status}}  Filipino citizen of legal age and a bonafide resident of Barangay Gucab Echague Isabela.

                  THIS IS TO CERTIFY THAT; he/she belongs to the indigent families of this barangay.
            </p>
            <p class="par">
                This certification is being issued upon the request of the above person for whatever legal purpose it may serve.

            </p>
            <p>
                Given this {{ now()->day }} day of {{ now()->format('M')}}, {{ now()->year }} at Barangay Gucab, Echague, Isabela.
            </p>
        </div>
        <div class="mt-10">
            <div>
                PREPARED BY;
                <div class="font-bold">
                    {{ nova_get_setting('secretary', '--') }}
                </div>
                <div class="text-xs">
                    Barangay Secretary
                </div>
            </div>
            <div class="text-right">
                APPROVED BY;
                <div class="font-bold">
                    HON.{{ nova_get_setting('captain', '--') }}
                </div>
                <div class="text-xs">
                    Barangay Captain
                </div>
            </div>
        </div>
    </div>
    <x-qrcode :reference="$reference"></x-qrcode>
</x-document>
