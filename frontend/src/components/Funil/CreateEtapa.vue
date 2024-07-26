<template>
  <div class="teste" v-if="edit">
    <div class="fixed" style="background-color: lightgray"></div>
    <div class="content">
      <div class="title1"> <input v-model="name" type="text" placeholder="Insira o nome da Etapa"> <div class="cancel" @click="Active" ><img width="22px"  src="../../assets/images/Funil/remove.png"></div></div>
    </div>
    <div class="cards">
      <img @click="CreateStep" v-if="name != null && name != ''" src="../../assets/images/Funil/aba.png">
    </div>
  </div>
  <div class="teste" v-if="!edit">
    <div class="fixed"></div>
    <div class="content">
      <div @click="Active"  class="title"> <div class="text" style="color: black">Criar nova Etapa</div> <div class="edit"><img width="10px" src="../../assets/images/Funil/editar.png"></div></div>
    </div>
  </div>
</template>
<style scoped>
.title1 img {
  margin-bottom: 3px;
}

.title1{
  font-size: 18px;
  font-weight: bold;
  display: flex;
  color:  lightgray;
  cursor: pointer;
}

.cancel {
  position: absolute;
  margin-left: 13vw;
  margin-top: 3px;
}

input {
  width: 15.3vw;
  height: 30px;
  border-radius: 5px;
  border: 1px solid grey;
  padding: 10px;
  font-size: 13px;
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
  color:  lightgray;
  cursor: pointer;
}



.title img {
  width: 18px;
  margin-bottom: 3px;
  margin-left: 3.7vw;

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

  width: 250px;
  height: 79.9vh;

  border-radius: 10px 1px 10px 10px;

}
</style>
<script>

import {CreateStep} from "@/services/HttpService.js";

export default {
  name: 'NewStep',
  props: {
    dadosfunilstep: {type:Object},
    id_funnel:{}
  },
  data(){
    return {
      name: null,
      edit: false,
    }
  },
  methods: {
    Active(){
      this.edit =  !this.edit
    },
    async CreateStep(){
      let pos = (this.id_funnel.size) + 1
      const data = {
        'name' : this.name,
        'posicao' : pos,
        'funnel_id' : this.id_funnel.id
      }
      const response = await CreateStep(data)
      return response
    }
  },
  created(){
    console.log(this.id_funnel)
  }
}
</script>