<div style="width:100%; display:flex; justify-content:center;">
    @auth
        <img src="/storage/{{nova_get_setting('logo')}}" alt="" style="width:50px;"/>
    @else
        <img src="/storage/{{nova_get_setting('logo')}}" alt="" style="width:100px;"/>
    @endauth
</div>
