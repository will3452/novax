@props(['rt'])
<div class="text-center">
    <div id="hm">
        <div class="text-xs">
            (HH:MM:SS)
        </div>
        <span class="flex justify-center font-mono text-2xl">
            <span id="hh">--</span>:
            <span id="mm">--</span>:
            <span id="ss">--</span>
        </span>
    </div>
    {{-- <div id="sec" class="hidden">
        <div class="text-xs text-center text-red-500 text-2xl">
            <span id="ss"></span> s
        </div>
    </div> --}}
</div>
<script>
    window.onload = function () {

        const hh = document.getElementById('hh');
        const mm = document.getElementById('mm');
        const hm = document.getElementById('hm');
        const sec = document.getElementById('sec');
        const ss = document.getElementById('ss');
        const form = document.getElementById('answerForm');
        var hv = hh.innerText;
        var mv = mm.innerText;
        var sv = 0;
        var ht, mt, st;
        function setTime(time) {
            sessionStorage.setItem('time', time);
            console.log(time);
            return sessionStorage.getItem('time').split(':');
        }
        if (sessionStorage.getItem('time') == null) {
            console.log('set')
            // [ht, mt, st] = setTime("{{$rt[0]}}:{{$rt[1]}}:0");
            hv = parseInt(ht);
            mv = parseInt(mt);
            sv = parseInt(st);
        } else {
            [ht, mt, st] = sessionStorage.getItem('time').split(':');
            hv = parseInt(ht);
            mv = parseInt(mt);
            sv = parseInt(st);
        }

        hh.innerText = (hv + "").padStart(2, '0');
        mm.innerText = (mv + "").padStart(2, '0');
        ss.innerText = (sv + "").padStart(2, '0');
        //re
        var ctimer = setInterval(async () => {
            if (hv <= 0 && mv <= 0 && sv <= 0) {
                await sessionStorage.clear();
                //examination is done!
                await form.submit();
                clearInterval(ctimer);
            }

            // if (mv<= 0 && hv <= 0) {
            //     hm.classList.add('hidden');
            //     sec.classList.remove('hidden');
            // }

            if (hv >= 1 && mv == 0) {
                hv --;
                hh.innerText = (hv + "").padStart(2, '0');
                mv = 59;
            }

            if (mv >= 1 && sv  == 0) {
                mv --;
                mm.innerText = (mv + "").padStart(2, '0');
                sv = 59;
            }

            ss.innerText = (sv + "").padStart(2, '0');
            sv --;
            setTime(`${hv}:${mv}:${sv}`);
        }, 1000);
    }
</script>
