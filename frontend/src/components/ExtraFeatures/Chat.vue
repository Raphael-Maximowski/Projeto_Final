<template>
  <div class="contentchat">
    <div class="contentchatreal">
      <div class="headerchat">
        <img src="../../assets/images/Login/logoamarelo.png">
        <p>NEXUS</p>
      </div>
      <div class="chats">
        <div><p style="font-weight: bold">Histórico de Conversas</p></div>
        <div class="cards">
          <CardChat/>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import CardChat from "@/components/ExtraFeatures/CardChat.vue";

export default {
  name: 'Chat',
  components: {CardChat}
}
</script>
<style>
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
  margin-top: 6px;
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