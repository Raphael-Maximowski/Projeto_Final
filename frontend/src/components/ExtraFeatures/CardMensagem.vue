<template>
  <div class="basemessage">
    <div class="headermessagecard">
      <div class="photomessage"></div>
      <div style="margin-top: 16px; margin-left: 10px; width: 200px"><p><span style="font-size: 14px">{{ pair.name }}</span> <br> <span style="font-size: 12px">Online</span> </p></div>
      <div @click="CloseMessages" style=" cursor: pointer"><img width="22px" src="../../assets/images/ExtraFeatures/bottom.png"></div>
    </div>
    <div class="contentallmessages">

    </div>
    <div class="sendmessage"><input v-model="message" placeholder="Digite sua Mensagem"><img style="cursor:pointer;" @click="SendMessage" src="../../assets/images/ExtraFeatures/sendmessage.png"></div>
  </div>
</template>
<script>
export default {
  name: 'CardMessage',
  data(){
    return {
      message : ""
    }
  },
  props: {
    pair: {type:Object}
  },
  methods: {
    CloseMessages(){
      this.$emit('CloseMessage')
      console.log('Evento Emitido')
    },
    SendMessage(){
      this.$emit('SendMessage', this.message)
    }
  }
}
</script>
<style>
.sendmessage img {
  width: 20px;
  height: 20px;
  margin-left: 5px;
}
.sendmessage {
  display: flex;
  align-items: center;
}

.sendmessage input {
  border: 1px solid lightgray;
  width: 220px;
  margin: 0px 10px;
  color: gray;
  font-size: 13px;
  padding: 3px 0px;
  padding-left: 5px;
  border-radius: 5px;
}
.contentallmessages {
  height: 260px;
  background-color: white;
}
.photomessage img {
  width: 10px;
}
.photomessage p {
  margin: 0px;
  padding: 0px;
}
.photomessage {
  background-color: white;;
  height: 35px;
  width: 35px;
  border-radius: 50%;
  margin-left: 10px;
  border: 1px solid lightgray;
}
.basemessage {
  height: 350px;
  width: 280px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
  z-index: 20;
}
.headermessagecard {
  background-color: #FEBC28;
  height: 50px;
  display: flex;
  align-items: center;
  border-radius: 10px 10px 0px 0px;
}
</style>