<template>
<div class="base-funil">
  <div class="info-funil">
  </div>
</div>
</template>
<script>
export default {
  name: 'Funil',
  props: {
    id_collection: {
      type: String,
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

</style>
