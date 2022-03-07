@props(['rt'])
<div class="text-center">
    <div>
        <div class="text-xs">
            (HH:MM)
        </div>
        <span class="flex justify-center font-mono text-2xl">
            <span id="hh">{{\Str::padLeft($rt[0], 2, 0)}}</span>:
            <span id="mm">{{\Str::padLeft($rt[1], 2, 0)}}</span>
        </span>
    </div>
</div>

<script>
    window.onload = function () {
        const hh = document.getElementById('hh');
        const mm = document.getElementById('mm');
        const form = document.getElementById('answerForm');
        let hv = hh.innerText;
        let mv = mm.innerText;
        let sv = 59;
        var ctimer = setInterval(() => {
            if (hv <= 0 && mv <= 0 && sv <= 0) {
                //examination is done!
                form.submit();
                clearInterval(ctimer);
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
            }

            console.log(sv);
        }, 1200);
    }
</script>
