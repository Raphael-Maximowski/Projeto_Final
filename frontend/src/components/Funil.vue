<template>
<div class="base-funil">
    <div class="title">Vendas Chinelos</div>
  <div class="img">
    <div><img src="../assets/images/DashBoard/funil.png" alt=""></div>
    <div class="crud-funil"><img src="../assets/images/DashBoard/pontos.png"></div>
  </div>
</div>
</template>
<script>
export default {
  name: 'Funil',
  data ()
  {
    return {
 
    }
  }
}
</script>
<style scoped>

.base-funil {
    background-color: #FEBC28;
    width: 15vw;
    padding: 5px 0px;
    justify-content: center;
    margin: 10px 20px;
    display: flex;
    border-radius: 10px;
}

.base-funil img {
    width: 15px;
    margin: 0px 10px;
}

.title {
  width: 30vw;
  text-align: center;
}

.img {

  width: 6vw;
  display: flex;
  justify-content: space-evenly;
}






</style>
