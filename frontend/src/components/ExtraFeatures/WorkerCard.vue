<template>
  <div class="boxwork">
    <div class="contentusers">
      <img v-if="admin" width="25px" src="../../assets/images/ExtraFeatures/admin-panel.png">
      <img v-if="!admin" width="20px" src="../../assets/images/ExtraFeatures/user.png">

    </div>
    <div class="nameuser">Nome do Usuario</div>
    <div><img width="17px" src="../../assets/images/ExtraFeatures/delete.png"></div>

  </div>
</template>
<style>
.contentusers{
  margin: 0px 10px;
}
.nameuser {
  width: 25vw;
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
  }
}
</script>
