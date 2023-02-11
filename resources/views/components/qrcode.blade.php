
    @props(['reference'])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <div class="p-8">
        <div id="qr" style="width:100px;"></div>
        <div class="text-sm font-mono mt-4">
            If you have a complaint, send a message to: {{nova_get_setting('barangay_email', '@mail.com')}}
        </div>
    </div>
    <script>
        new QRCode(document.getElementById("qr"), '{{route('validate', ['ref' => $reference])}}');
    </script>
