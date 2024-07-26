<template>
  <div class="teste" v-if="edit">
    <div class="fixed" :style="{ backgroundColor: dadosfunilstep.color}"></div>
    <div class="content">
      <div class="title" style="color: black"> <div>Nome da Etapa</div></div>
    </div>
    <div class="cards">
      <img @click="Active" src="../../assets/images/Funil/aba.png">
    </div>
  </div>
  <div class="teste" v-if="!edit">
    <div class="fixed"></div>
    <div class="content">
      <div class="title"> <div>Criar nova Etapa</div></div>
    </div>
    <div class="cards">
      <img @click="Active" src="../../assets/images/Funil/aba.png">
    </div>
  </div>
</template>
<style scoped>
.edit img {
  width: 10px;
}
input {
  width: 12.7vw;
  margin-top: 10px;
  height: 30px;
  border-radius: 5px;
  border: 1px solid grey;

  padding: 10px;
}


.cards {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 69vh;
}
.cards img {
  width: 50px;
  margin-bottom: 6vw;
  cursor: pointer;
}
.title {
  font-size: 18px;
  font-weight: bold;
  display: flex;
  justify-content: space-between;
  color:  lightgray;
}



.title img {
  width: 27px;
  margin-right: 10px;
}

.content {
  margin: 10px 15px 10px 15px;
}
.fixed {
  width: 250px;
  height: 10px;
  border-radius: 50px;
  z-index: 1;
  background-color: lightgray;
}
.teste {
  margin-top: 7px;
  margin-left: 15px;
  width: 250px;
  height: 79.9vh;

  border-radius: 10px 1px 10px 10px;

}
</style>
<script>

export default {
  name: 'NewStep',
  props: {
    dadosfunilstep: {type:Object}
  },
  data(){
    return {
      name: null,
      edit: false
    }
  },
  methods: {
    Active(){
      this.edit =  !this.edit
    }
  }
}
</script>