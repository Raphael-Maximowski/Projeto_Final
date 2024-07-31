<template>
  <div class="contentcardchat">
    <div class="photocard"></div>
    <div class="infochat">
      <div class="name">
        <div>Nome do Cria</div>
        <div style="margin-left: 10vw" class="img"><img width="20px" src="../../assets/images/ExtraFeatures/read.png"></div>
      </div>

      <div class="data">
        <div style="font-size: 13px; color: gray">Ultima Mensagem</div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'CardChat'
}
</script>
<style>
.data img {

}

.data {
  display: flex;
  justify-content: space-between;
}
.name {
  font-size: 15px;
  display: flex;
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
  align-items: center;
}

.contentcardchat:hover {
  background-color: lightgray;

}
</style>