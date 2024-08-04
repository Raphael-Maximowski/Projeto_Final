<template>
  <div style=" cursor: pointer;" v-if="this.dadoscontact.name != 'card vazio'" class="maincard" @click="ActiveContact">
    <div  class="contentcard">
      <div class="name" >{{this.dadoscontact.name}}</div>
      <div class="value">R$ {{this.dadoscontact.value}}</div>
    </div>
  </div>
  <div style="border: 1px solid lightgray; height: 130px" v-if="this.dadoscontact.name === 'card vazio' && size == 1" class="maincard2">
    <div class="contentcard2" @click="OpenCreate">
      <div>
        <div style="color: lightgray; font-size: 13px;  font-weight: lighter; margin-top: 5px; font-style: italic; text-align: center">Etapa vazia</div>
        <div>
          <img src="../../assets/images/Funil/skeleton.png">
        </div>
       <div style="color: lightgray; font-size: 13px;  font-weight: lighter; margin-top: 10px; font-style: italic; text-align: center">Crie um novo Contato</div>

      </div>


    </div>
  </div>
</template>
<script>
export default {
  name: 'ContatoCard',
  props: {
    dadoscontact: {type:Object},
    size: {type:Number}
  },

  methods: {
    ActiveContact(){
      this.$emit('ActiveContactEtapa',this.dadoscontact);
    },
    OpenCreate(){
      this.$emit('OpenCreate');
    }
  }
}
</script>
<style scoped>
* {
  font-family: Arial, Helvetica, sans-serif;
}

.name {
  padding-top: 10px;
  font-weight: normal;
  font-size: 14px;
}

.value {
  padding-top: 18px;
  font-weight: normal;
  font-size: 13px;
  color: grey;
}

.contentcard{
  margin-left: 10px;
}

.contentcard2 {
  display: flex;
  justify-content: center;
  padding-top: 10px;
  height: 150px;
}


.contentcard2 img {
  width: 130px;
  height: 50px;
  margin-left: 10px;
}

.maincard {
  margin-top: 10px;
  height: 80px;
  border-radius: 10px;
  width: 218px;
  border: 1px solid rgba(211, 211, 211, 0.51);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05), 0 6px 20px rgba(0, 0, 0, 0.05);
}

.maincard2 {
  margin-top: 10px;
  height: 80px;
  border-radius: 10px;
  width: 218px;
  border: 1px solid rgba(211, 211, 211, 0.51);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05), 0 6px 20px rgba(0, 0, 0, 0.05);
  opacity: 0;
}

.maincard2:hover {
  opacity: 100;
  transition: 0.8s;
  cursor: pointer;

}

.drag{
  transform: rotate(10deg);
}

.ghost {
  background-color: lightgray;
  border-radius: 6px;
  z-index: 1000;
}
</style>