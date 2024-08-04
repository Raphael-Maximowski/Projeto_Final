<template>
  <div v-if="user_id != user.id" class="contentcardchat" @click="GetRoom">
    <div class="photocard"></div>
    <div class="infochat">
      <div class="name">
        <div class="nomereal">{{ user.name }}</div>
        <div  class="img"><img width="20px" src="../../assets/images/ExtraFeatures/read.png"></div>
      </div>

      <div class="data">
        <div style="font-size: 13px; color: gray">Ultima Mensagem</div>
      </div>
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
import {GetRoom} from "@/services/HttpService.js";

export default {
  name: 'CardChat',
  props: {
    user: {type:Object}
  },
  data() {
    return {
      room : ""
    }
  },
  methods: {
    async GetRoom(){
      const data = {
        OwnID : this.user_id,
        OtherID:  this.user.id
      }
      const response = await GetRoom(data)
      this.room = response.data;
      this.room = this.room.room

      this.ActiveConversation()
    },
    ActiveConversation(){
      const data = {
        'user_id' : this.user_id,
        'pair' : this.user,
        'room' : this.room
      }
      console.log('Data Enviado', data)
      this.$emit('OpenChat', data)
    },
  },
  computed: {
    ...mapGetters(['user_id']),
  },
}
</script>
<style>
.data img {

}
.nomereal {
  width: 30vw;

}

.data {
  display: flex;
  margin-left: 15px;

}
.name {
  margin-left: 15px;
  font-size: 15px;
  display: flex;
  width: 16vw;
  justify-content: space-between;

}
.infochat {

  height: 40px;
  width: 18vw;
}
.photocard {
  background-color: white;
  margin-left: 10px;
  height: 40px;
  width: 40px;
  border: 1px solid lightgray;
  border-radius: 50%;
}
.contentcardchat {
  height: 50px;
  border-radius: 8px;
  display: flex;
  cursor: pointer;
  align-items: center;
}

.contentcardchat:hover {
  background-color: lightgray;

}
</style>