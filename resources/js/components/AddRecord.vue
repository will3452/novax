<template>
    <div>
        <a href="#" class="btn btn-primary" data-bs-toggle="modal" ref="trigger" data-bs-target="#exampleModal">
            Add Record
        </a>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">New Record</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-2">
                            <label for="height" class="d-flex">Height <div class="d-flex">
                                    <div for="" class="d-flex align-items-center"><input value="m" name="unit"
                                            v-model="unit" type="radio" class="mx-2">
                                        <span>meter</span>
                                    </div>
                                    <div for="" class="d-flex align-items-center"><input value="in" name="unit"
                                            v-model="unit" type="radio" class="mx-2">
                                        <span>inches</span>
                                    </div>
                                    <div for="" class="d-flex align-items-center"><input value="ft" name="unit"
                                            v-model="unit" type="radio" class="mx-2">
                                        <span>feet</span>
                                    </div>
                                </div></label>
                            <input type="number" v-model="height" class="form-control">

                        </div>
                        <div class="mb-2">
                            <label for="height">Weight (kg)</label>
                            <input type="number" v-model="weight" class="form-control">
                        </div>
                        <div class="alert" v-if="weight != null && height != null" :class="[mode]">
                            <div>
                                <div class="fw-bolder">
                                    BMI RESULT
                                </div>
                                <div class="fs-2">
                                    {{ result || '--' }}
                                </div>
                                <div class="fs-5">
                                    {{ scaling }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button :disabled="height == null || weight == null" type="button" class="btn btn-primary"
                            @click="submit">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            weight: null,
            height: null,
            unit: 'm',
        }
    },
    methods: {
        async submit() {


            let { mHeight: height, weight, scaling: scale, result } = this;

            let { data } = await window.axios.post('/records', { weight, height, scale, result })

            this.$refs.trigger.click()
            window.location.reload()
        }
    },
    computed: {
        result() {
            return (this.weight / (this.mHeight * this.mHeight)).toFixed(2)
        },
        mHeight() {
            if (this.unit == 'ft') {
                return this.height * 0.3048;
            }

            if (this.unit == 'in') {
                return this.height * 0.0254;
            }

            return this.height;
        },
        scaling() {
            if (this.result < 18.5) {
                return 'Below normal weight';
            }

            if (this.result >= 18.5 && this.result < 25) {
                return 'Normal Weight';
            }

            if (this.result >= 25 && this.result < 30) {
                return 'Overweight';
            }

            if (this.result >= 30 && this.result < 35) {
                return "Class I Obesity";
            }

            if (this.result >= 35 && this.result < 40) {
                return "Class II Obesity";
            }

            if (this.result >= 40) {
                return "Class III Obesity";
            }

        },
        mode() {
            if (this.scaling != 'Normal Weight') {
                return 'alert-warning';
            }

            return 'alert-success';
        }
    }
}
</script>
