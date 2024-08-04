<template>
  <div v-if="fromuser" class="container">
    <div class="basemensagem">
      <div class="text">{{ messages.text }}</div>
      <div class="time">Time</div>
    </div>
  </div>

  <div v-if="!fromuser" class="container2">
    <div class="basemensagem2">
      <div class="text">{{ messages.text }}</div>
      <div class="time">Time</div>
    </div>
  </div>


</template>
<style>
.container {
  display: flex;

}
.container2 {
  display: flex;
  justify-content: end;
  text-align: right;
}
.basemensagem2 {
  background-color: lightgray;
  margin: 10px 20px;
  padding: 10px 20px;
  display: block;
  max-width: 310px;
  white-space: normal;
  word-wrap: break-word;
  overflow-wrap: break-word;
  border-radius: 10px 10px 0px 10px;
}
.basemensagem {
  background-color: #FEBC28;
  margin: 10px 20px;
  padding: 10px 20px;
  display: block;
  max-width: 290px;
  white-space: normal;
  word-wrap: break-word;
  overflow-wrap: break-word;
  border-radius: 10px 10px 10px 0px;

}

.time {
  font-size: 12px;
}
</style>
<script>
import {mapGetters} from "vuex";

export default {
  name: 'Mensagem',
  props: {
    messages: {type:Object}
  },
  data() {
    return {
      fromuser : false,
    }
  },
  created(){
    if (this.user_id ==  this.messages.ID_FIRST){
      this.fromuser = true
    }
  },

  computed: {
  ...mapGetters(['user_id'])
  }
}
</script>