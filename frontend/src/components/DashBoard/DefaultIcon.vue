<template>
  <div class="active">
    <div class="border-icon-none"></div>
    <div class="img-icon"><img :src="imageSrc"></div>
  </div>

</template>
<style scoped>
.active {
  display: flex;
  overflow: hidden;
  cursor: pointer;
  width: 60px;
}
.border-icon-none {
  height: 40px;
  width: 6px;
  margin-top: 20px ;
  border-radius: 0px 50px 50px 0px;

}
.img-icon {
  margin-top: 10px;
  position: absolute;
  width: 60px;
  height: 60px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.img-icon img {
  width: 25px;
  height: 25px;
}
</style>
<script>
export default {
  name: 'DefaultIcon',
  props: {
    imageSrc: {
      type: String
    }
  }
}
</script>