<template>
  <div v-if="openchat" class="openmessage">
    <div><CardMessage @Room="Room" @SendMessage="SendMessage" @CloseMessage="CloseMessage" :pair="pair"/></div>
  </div>

  <div class="contentchat">
    <div class="contentchatreal" v-if="!openchat">
      <div class="headerchat">
        <img src="../../assets/images/Login/logoamarelo.png">
        <p>NEXUS</p>
        <img @click="CloseChat" style="margin-top: 15px; margin-left: 11vw; cursor:pointer" width="25px" height="25px" src="../../assets/images/ExtraFeatures/getout.png">
      </div>
      <div class="chats">
        <div><p style="font-weight: bold">Histórico de Conversas</p></div>
        <div class="cards">
          <div v-for="user in team_users">
            <CardChat @OpenChat="OpenChat" :user="user"/>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import CardChat from "@/components/ExtraFeatures/CardChat.vue";
import {mapGetters, mapMutations} from "vuex";
import CardMessage from "@/components/ExtraFeatures/CardMensagem.vue";
import getSocketId from "../../services/SocketService.js"
import ChatService from "@/services/ChatService.js";
export default {
  name: 'Chat',
  components: {CardMessage, CardChat},
  data(){
    return {
      pair: {},
      openchat: false,
      OwnId : "",
      OtherId: "",
      messages : [],
      room : null
    }
  },
  computed: {
    ...mapGetters(['team_users', 'user_id', 'user_name']),
  },

  methods: {
    Room(value){
      this.room =  value.room
    },
    CloseChat(){
      this.$emit('CloseChat')
      this.UpdateChatState(false)
    },
    SendMessage(value){
      if (this.room.length === 0  || this.room === null){
        const findroom = String(this.OwnId) + String(this.OtherId)
        this.room  = findroom
      }
      const username = this.user_name
      const data = {
        'text' : value,
        'room' : this.room,
        'username' : username,
        'ID_FIRST' : this.user_id,
        'ID_SECOND' : this.OtherId
      }
      const message = {
        id : this.user_id,
        message : value
      }
      console.log(data)
      this.messages.push(message)
      ChatService.Message(data)
    },

    CloseMessage(){
      this.openchat =  false
      console.log('Status Chat', this.openchat)

    },
    OpenChat(value){
      this.pair = value.pair
      this.OtherId = value.pair.id
      this.OwnId = this.user_id
      const Room = String(this.OwnId) + String(this.OtherId)
      const UserName = this.user_name
      const SocketID = getSocketId.socket.id
      console.log('id socket', SocketID)
      ChatService.joinRoom(Room, UserName, SocketID, this.OwnId)
      this.openchat = true
    },
    ...mapMutations(['UpdateChatState'])
  },
  created(){
    console.log('Usuarios do Time', this.team_users)
  },

}
</script>
<style>
@keyframes slideInFromRight {
  from {
    opacity: 0;
    transform: translateX(5px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

@keyframes slideInFromBottom {
  from {
    opacity: 0;
    transform: translateY(5px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
.openmessage {
  position: absolute;
  width: 99vw;
  height: 100vh;
  display: flex;
  justify-content: end;
  align-items: end;
  z-index: 10;
  animation: slideInFromBottom 0.5s ease-in-out;
}

.chats {
  margin: 10px;

}
.headerchat {
  background-color: #FEBC28;
  height: 50px;
  border-radius: 5px 0px 0px 0px;
  display: flex;
}
.headerchat p {
  margin-top: 7px;
  font-size: 24px;
  font-weight: bold;
}

.headerchat img {
  margin-left: 15px;
}
.contentchat {
  position: absolute;
  width: 100vw;
  height: 100vh;
  display: flex;
  justify-content: end;
}

.contentchatreal{
  background-color: white;
  width: 410px;
  z-index: 10;
  border-radius: 0px 0px 0px 5px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
  animation: slideInFromRight 0.5s ease forwards;

}
</style>