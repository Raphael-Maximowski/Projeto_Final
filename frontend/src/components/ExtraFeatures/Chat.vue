<template>
  <div v-if="openchat" class="openmessage">
    <div><CardMessage @CloseMessage="CloseMessage" :pair="pair"/></div>
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

export default {
  name: 'Chat',
  components: {CardMessage, CardChat},
  data(){
    return {
      pair: {},
      openchat: false
    }
  },
  computed: {
    ...mapGetters(['team_users']),
  },
  methods: {
    CloseChat(){
      this.$emit('CloseChat')
      this.UpdateChatState(false)
    },
    CloseMessage(){
      this.openchat =  false
      console.log('Status Chat', this.openchat)

    },
    OpenChat(value){
      this.pair = value.pair
      this.openchat =  true
    },
    ...mapMutations(['UpdateChatState'])
  },
  created(){
    console.log('Usuarios do Time', this.team_users)
  },

}
</script>
<style>
.openmessage {
  position: absolute;
  width: 99vw;
  height: 100vh;
  display: flex;
  justify-content: end;
  align-items: end;
  z-index: 10;
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
  width: 350px;
  z-index: 10;
  border-radius: 0px 0px 0px 5px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);

}
</style>