@props(['rt'])
<div class="text-center">
    <div id="hm">
        <div class="text-xs">
            (HH:MM)
        </div>
        <span class="flex justify-center font-mono text-2xl">
            <span id="hh">{{\Str::padLeft($rt[0], 2, 0)}}</span>:
            <span id="mm">{{\Str::padLeft($rt[1], 2, 0)}}</span>
        </span>
    </div>
    <div id="sec">
        <div class="text-xs text-center text-red-500 hidden">
            <span id="ss"></span> s
        </div>
    </div>
</div>

<script>
    window.onload = function () {
        const hh = document.getElementById('hh');
        const mm = document.getElementById('mm');
        const hm = document.getElementById('hm');
        const sec = document.getElementById('sec');
        const ss = document.getElementById('ss');
        const form = document.getElementById('answerForm');
        let hv = hh.innerText;
        let mv = mm.innerText;
        let sv = 0;
        //re
        var ctimer = setInterval(() => {
            if (hv <= 0 && mv <= 0 && sv <= 0) {
                //examination is done!
                form.submit();
                clearInterval(ctimer);
            }

            if (mv<= 10 && hv <= 0) {
                hm.classList.add('hidden');
                sec.classList.remove('hidden');
            }

            if (hv >= 1 && mv < 1) {
                hv --;
                hh.innerText = (hv + "").padStart(2, '0');
                mv = 60;
            }

            if (mv >= 1 && sv < 1) {
                mv --;
                mm.innerText = (mv + "").padStart(2, '0');
                sv = 60;
            }

            if (sv > 0) {
                sv --;
                ss.innerText = sv;
            }//

            console.log(sv);
        }, 1200);
    }
</script>
