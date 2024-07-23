<template>
  <div class="maincard">
    <div class="contentcard">
      <div class="name" >{{this.dadoscontact.name}}</div>
      <div class="value">R$ {{this.dadoscontact.value}}</div>
    </div>

  </div>
</template>
<script>
export default {
  name: 'ContatoCard',
  props: {
    dadoscontact: {type:Object}
  },
  created (){
    console.log(this.dadoscontact)
  }
}
</script>
<style scoped>
* {
  font-family: Arial, Helvetica, sans-serif;
}

.name {
  padding-top: 10px;
  font-weight: normal;
  font-size: 14px;
}

.value {
  padding-top: 18px;
  font-weight: normal;
  font-size: 13px;
  color: grey;
}

.contentcard{
  margin-left: 10px;

}
.maincard {
  margin-top: 10px;
  height: 80px;
  border-radius: 10px;
  width: 218px;
  border: 1px solid rgba(211, 211, 211, 0.51);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05), 0 6px 20px rgba(0, 0, 0, 0.05);
}

.drag{
  transform: rotate(10deg);
}

.ghost {
  background-color: lightgray;
  border-radius: 6px;
  z-index: 1000;
}
</style>