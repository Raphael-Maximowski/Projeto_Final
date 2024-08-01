<template>
  <div v-if="user_id != user.id" class="contentcardchat" @click="ActiveConversation">
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

export default {
  name: 'CardChat',
  props: {
    user: {type:Object}
  },
  methods: {
    ActiveConversation(){
      const data = {
        'user_id' : this.user_id,
        'pair' : this.user
      }
      this.$emit('OpenChat', data)
    }
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
  justify-content: space-between;
}
.name {
  font-size: 15px;
  display: flex;
  justify-content: space-between;

}
.infochat {

  height: 40px;
  width: 18vw;
  margin-left: 1vw;
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