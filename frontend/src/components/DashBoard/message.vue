<template>
  <div class="whatsapp">
    <div class="icon">
      <img src="../../assets/images/DashBoard/chat.png">
    </div>
  </div>
</template>
<script>
export default {
  name: 'Message'
}
</script>
<style>
.whatsapp {
  position: absolute;
  width: 100vw;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

.icon {
  margin-left: 90vw;
  margin-top: 45vw;
}

.icon img {
  width: 50px;
  height: 50px;
}
</style>