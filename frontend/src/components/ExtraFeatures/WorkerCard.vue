<template>
  <div class="boxwork">
    <div class="contentusers">
      <img v-if=" userteam.is_admin == 1" width="25px" src="../../assets/images/ExtraFeatures/admin-panel.png">
      <img v-if="userteam.is_admin != 1" width="20px" src="../../assets/images/ExtraFeatures/user.png">

    </div>
    <div class="nameuser">{{ userteam.name }}</div>
    <div><img width="17px" src="../../assets/images/ExtraFeatures/delete.png"></div>

  </div>
</template>
<style>
.contentusers{
  margin: 0px 10px;
}
.nameuser {
  width: 25vw;
  font-size: 14px;
}
.boxwork {
  height: 40px;
  display: flex;
  align-items: center;
  border: 1px solid lightgray;

  cursor: pointer;
}
</style>
<script>
export default {
  name: "WorkerCards",
  data(){
    return {
      admin : false
    }
  },
  props: {
    userteam: {type:Object}
  },
  created(){
    console.log(this.userteam)
  }
}
</script>
