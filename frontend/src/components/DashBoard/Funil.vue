<template>
<div class="base-funil">
  <div class="info-funil">
    <div class="funil-img"><img src="../../assets/images/DashBoard/funil.png"></div>
    <div class="name-funil">{{funil.name}}</div>
    <div id="open-info-funnel" class="funil-img"><img src="../../assets/images/DashBoard/pontos.png"></div>
  </div>
</div>
</template>
<script>
export default {
  name: 'Funil',
  props: {
    id_collection: {
      type: String,
    },
    funil: {
      type: Object
    }
  },
  data ()
  {
    return {
    }
  },
  methods: {
  }
}
</script>
<style scoped>

.base-funil {
    background-color: #FEBC28;
    width: 12vw;
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
  background-color: #FEBC28;
  height: 25px;
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
.funil-img {

  width: 2.5vw;
  height: 25px;
  display: flex;
  justify-content: center;
  align-items: center;

}
.funil-img img {
  width: 15px;
  height: 15px;
  z-index: 2;
}

#open-info-funnel {
  cursor: pointer;
}

.name-funil {

  width: 7vw;
  text-align: center;
}
</style>
