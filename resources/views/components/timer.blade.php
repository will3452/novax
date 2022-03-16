@props(['time' => []])
<div class="text-center mt-4" x-data="{
    interval:null,
    submitButton:null,
    hv:0,
    mv:0,
    sv:0,
    clear () {
        clearInterval(this.interval);
        this.submitButton.click();
    },
    start() {
        this.hv = {{$time['hh']}};
        this.mv = {{$time['mm']}};
        this.sv = 0;
        this.submitButton = document.getElementById('submitBtn');
        this.interval = setInterval(() => {
            if (this.sv <= 0 && this.mv <= 0 && this.hv <= 0) {
                this.clear();
            }

            if (this.mv == 0 && this.hv > 0) {
                this.hv --;
                this.mv = 59;
            }

            if (this.sv == 0 && this.mv > 0) {
                this.mv --;
                this.sv = 59;
            }

            if (this.sv > 0) {
                this.sv --;
            }
        }, 1000)
    }
}" x-init="start()">
    <div class="text-2xl">
        <span x-text="(hv + '').padStart(2, 0)"></span> :
        <span x-text="(mv + '').padStart(2, 0)"></span> :
        <span x-text="(sv + '').padStart(2, 0)"></span>
    </div>
</div>
