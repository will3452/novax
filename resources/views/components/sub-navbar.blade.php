@if (nova_get_setting('announcement', '') != '')
<div class="bg-green-900 text-center p-1 t text-sm text-white">
    <marquee behavior="" direction="">
            {{nova_get_setting('announcement', '')}}
    </marquee>
</div>

@endif
