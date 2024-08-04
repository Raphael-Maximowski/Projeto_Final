<template>
  <div class="basemessage">
    <div class="headermessagecard">
      <div class="photomessage"></div>
      <div style="width: 200px">
        <div style="margin-top: 16px; margin-left: 10px; width: 200px"><p><span style="font-size: 14px;width: 100px">{{ pair.name }}</span> <br> <span style="font-size: 12px">Online</span> </p></div>
      </div>

      <div @click="CloseMessages" style=" cursor: pointer"><img width="22px" style="margin-left: 60px" src="../../assets/images/ExtraFeatures/bottom.png"></div>
    </div>
    <div class="contentallmessages">
      <div v-for="message in messages">
        <Mensagem :messages="message"/>
      </div>

    </div>
    <div class="sendmessage"><input style="width: 15vw; padding: 5px 15px" v-model="message" placeholder="Digite sua Mensagem"><img style="cursor:pointer;" @click="SendMessage" src="../../assets/images/ExtraFeatures/sendmessage.png"></div>
  </div>
</template>
<script>
import {GetHistory, GetRoom} from "@/services/HttpService.js";
import {mapGetters} from "vuex";
import Mensagem from "@/components/ExtraFeatures/Message.vue";
import ChatService from "@/services/ChatService.js";

export default {
  name: 'CardMessage',
  components: {Mensagem},
  data(){
    return {
      message : "",
      room : "",
      messages: []
    }
  },
  props: {
    pair: {type:Object}
  },
  created() {
    this.GetRoom()
    this.GetHistory()
    console.log('Acima de Estabelecer Conexão')
    ChatService.onReceiveMessage((message) => {
      this.messages.push(message);
      console.log('Evento Recebido')
    });
  },
  methods: {
    CloseMessages(){
      this.$emit('CloseMessage')
      console.log('Evento Emitido')
    },
    SendMessage(){
      this.$emit('SendMessage', this.message)
      const data = {
        'text' : this.message,
        'ID_FIRST' : this.user_id
      }
      this.message = "";
    },
    async GetRoom(){
      const data = {
        OwnID : this.user_id,
        OtherID: this.pair.id
      }
      const response = await GetRoom(data)
      this.room = response.data;
      console.log('Sala', this.room)
      this.$emit('Room', this.room)
    },
    async GetHistory(){
      const data = {
        OwnID : this.user_id,
        OtherID: this.pair.id
      }
      const response = await GetHistory(data);
      this.messages =  response.data
      console.log(this.messages)
      return response;
    }
  },
  computed: {
    ...mapGetters(['user_id'])
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
  align-items: center;
  background-color: white;
}

.sendmessage input {
  width: 5vw;
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
  height: 350px;
  background: white;
  overflow-y: auto;

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
  height: 450px;
  width: 350px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
  z-index: 20;
  margin-right: vw;
}
.headermessagecard {
  background-color: #FEBC28;
  height: 50px;
  display: flex;
  align-items: center;
  border-radius: 10px 10px 0px 0px;
}


</style>