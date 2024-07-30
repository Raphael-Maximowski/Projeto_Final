<template>
  <div v-if="!selected" @click="TurnSelect" class="baseworker">
    <img src="../../assets/images/ExtraFeatures/monitor.png">
    <div class="contentfindworker">
      <p>{{ user.name }}</p>
      <p>{{ user.email }}</p>
    </div>
  </div>
  <div @click="TurnSelect" v-if="selected" class="baseworker2">
    <img src="../../assets/images/ExtraFeatures/monitor.png">
    <div class="contentfindworker">
      <p>{{ user.name }}</p>
      <p>{{ user.email }}</p>
    </div>
  </div>
</template>
<script>
export default {
  name: 'FindWorker',
  props: {user: {type:Object}},
  data(){
    return {
      selected: false
    }
  },
  methods: {
    TurnSelect(){
      this.selected =  !this.selected
      let id = this.user.id
      this.$emit('MakeChange', id)
    }
  },
}
</script>
<style>
.contentfindworker {
  display: flex;

  width: 35.9vw;
  height: 38px;
  align-items: center;


}

.contentfindworker p {
  margin-top: 15px;
  width: 13vw;
  font-size: 14px;
  margin-left: 30px;
}

.baseworker {
  background-color: white;
  border: 1px solid lightgray;
  width: 38vw;
  margin: 0vw 0.5vw;
  height: 40px;
  border-radius: 5px;
  display: flex;
  align-items: center;
  cursor: pointer;

}

.baseworker2{
  background-color: rgba(211, 211, 211, 0.62);
  border: 1px solid lightgray;
  width: 38vw;
  margin: 0vw 0.5vw;
  height: 40px;
  border-radius: 5px;
  display: flex;
  align-items: center;
  cursor: pointer;
}
.baseworker2 img {
  width: 20px;
  margin-left: 10px;
}

.baseworker img {
  width: 20px;
  margin-left: 10px;
}
</style>