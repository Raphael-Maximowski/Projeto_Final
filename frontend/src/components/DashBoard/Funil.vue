<template>
<div class="base-funil">
  <div class="info-funil">
    <div class="title">Vendas Chinelos</div>
    <div class="images-funil">
      <div class="part1"><img src="../../assets/images/DashBoard/funil.png"></div>
      <div class="part2"><img src="../../assets/images/DashBoard/pontos.png"></div>
    </div>
  </div>
</div>
</template>
<script>
export default {
  name: 'Funil',
  props: {
    modal4: {
      type: Boolean,
      default: false
    }
  },
  data ()
  {
    return {
    }
  },
  methods: {
    show_modal(){
      this.$emit('update-modal2', !this.modal2);
      console.log(this.modal2);
    }
  }
}
</script>
<style scoped>

.base-funil {
    background-color: #FEBC28;
    width: 15vw;
    padding: 5px 0px;
    margin: 10px 20px;
    border-radius: 10px;
}

.title {
  width: 15vw;
  text-align: center;
}

.info-funil {
  display: flex;
}

.images-funil {
  position: absolute;
  width: 15vw;
  display: flex;
}

.images-funil img {
  width: 15px;
  margin-right: 10px;
}

.part1 {
  width: 7.5vw;
}

.part1 img {
  margin-left: 10px;
}

.part2 {
  width: 7.5vw;
  display: flex;
  justify-content: end;
}

.part2 img {
  width: 15px;
  height: 18px;
  margin-top: 4px;
}

</style>
