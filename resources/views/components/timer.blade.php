@props(['rt'])
<div class="text-center">
    <span class="flex justify-center font-mono text-2xl">
        <span id="hh">{{$rt[0]}}</span>:
        <span id="mm">{{$rt[1]}}</span>:
        <span id="ss">00</span>
    </span>
</div>

<script>
    window.onload = function () {
        const hh = document.getElementById('hh');
        const mm = document.getElementById('mm');
        const ss = document.getElementById('ss');
        const form = document.getElementById('answerForm');
        let hv = hh.innerText;
        let mv = mm.innerText;
        let sv = ss.innerText;
        var ctimer = setInterval(() => {
            if (hv >= 1 && mv < 1) {
                hv --;
                hh.innerText = hv;
                mv = 60;
            }

            if (mv >= 1 && sv < 1) {
                mv --;
                mm.innerText = mv;
                sv = 60;
            }
            if (hv == 0 && mv == 0 && sv ==0) {
                //examination is done!
                form.submit();
                clearInterval(ctimer);
            }
            sv --;
            ss.innerText = sv;
        }, 1000);
    }
</script>
