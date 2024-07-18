<template>
  <main>
    <div class="name"><p>{{dados.Nome}}</p></div>
    <div class="price">R${{dados.Price}}</div>
  </main>
</template>
<style>
* {
  font-family: Arial;
}

.name p {
  margin-top: 10px;
}
.name {
  padding-top: 1px;
  margin-top: 10px;
  height: 70px;
  font-size: 15px;
}

.price {
  font-size: 13px;
  color: #8ea9c7;
  font-weight: bold;
}

main {
  background-color: white;
  margin: 15px 10px;
  border-radius: 8px;
  padding: 0px 10px;
  width: 230px;
  height: 100px;
  cursor: pointer;
  z-index: 1000;
}
</style>
<script>
export default {
  name: 'Contato',
  props:{
    dados:{type:Object}
  },
  created(){
    console.log(this.dados)
  }
}
</script>