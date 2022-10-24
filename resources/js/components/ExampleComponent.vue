<template>
    <div>
        <div class="card card-body bg-primary" v-if="dialog != ''" style="position: absolute; width: 100vw; z-index: 999; font-size: 24px; color: #fff;">
            {{dialog}}
        </div>
        <v-stage ref="stage" :config="stageSize">
            <v-layer ref="layer">
                <v-image :config="bg"/>
                <v-image ref="images" :config="o" v-for="o in obj" :key="o.id" @click="playSound(o)"></v-image>
            </v-layer>
        </v-stage>
    </div>
  </template>

<script>
import { Howl } from 'howler';
const width = window.innerWidth;
const height = window.innerHeight;

export default {
    props: ['scene'],
  data() {
    return {
      stageSize: {
        width: width,
        height: height
      },
      bg: {x: 0, y: 0, width: 0, height: 0},
      obj: [],
      click: 0,
      dialog: '',
    };
  },
  methods: {
    playSound({sound, dialog}) {
        this.dialog = dialog;
        this.click ++;

        if (this.click == 1) {
            for (let i of this.$refs.images) {
                i.getNode().cache()
                i.getNode().drawHitFromCache()
            }
        }
        console.log('sound >> ', sound)
        let hSound = new Howl({src:['/storage/' + sound]})
        hSound.play()
    },
     async loadImage () {
        const image = new window.Image();
        image.src = `/storage/${this.scene.background}`;
        image.onload = () => {
        // set image only when it is loaded
            this.bg.width = this.stageSize.height * (image.width / image.height)
            this.bg.height = this.stageSize.width * ( image.height / image.width)
            this.bg.image = image;
            this.bg.x = (this.stageSize.width - this.bg.width) / 2
        };
    },
    async loadObjects () {
        let images = []
        for (let img of this.obj) {
            const image = new window.Image()
            image.src = "/storage/" + img.image
            image.onload = () => {
                img.width = this.stageSize.height * (image.width / image.height)
                img.height = this.stageSize.width * ( image.height / image.width)
                img.image = image
                img.x = (this.stageSize.width - img.width) / 2
                images.push(img)
            }
        }

        this.obj = images;
    }
  },
   async created() {
     await this.loadImage()
    this.obj = await this.scene.objects.map( e => ({...e, x: 0, y: 0, width: 0, height: 0}))
    await this.loadObjects();
  }
};
</script>
