<link rel="icon" type="image/svg+xml" href="/storage/{{nova_get_setting('logo',)}}" />
<script>
    window.onload = function () {
        setInterval(() => {
            let card = document.getElementsByClassName('card relative px-6 py-4 card-panel');
            console.log('card', card.length)
            console.log('card', card)
            setTimeout(() => {
                card[1].onclick = function () {
                    window.location.href = '/admin/resources/appointments'
                }
            }, 1000);
        }, 1000);
    }
</script>
<script src="https://cdn.tailwindcss.com"></script>
