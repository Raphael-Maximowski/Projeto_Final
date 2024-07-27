<template>
  <div class="main">
    <div><MenuDash/></div>
    <div class="content">
      <div class="welcome">
      <h1>Team CRM 3C+</h1>
      <p>Configure seus times de forma dinamica</p>
    </div></div>
  </div>
</template>
<style>
.main {
  display: flex;
  overflow: hidden;
}
.welcome {
  width: 54vw;
  background-color: red;
  padding-top: 5px;
  width: 100vw;
}

.welcome h1 {
  font-size: 20px;
  margin-left: 3vw;

  color: #222738;
  font-weight: bold;
}
.welcome p {
  margin-left: 3vw;
  font-size: 15px;
  color: #222738;
  font-weight: bold;
}

.content {
  width: 100vw;
  height: 100vh;
  background-color: #F9FAFC;
}

</style>
<script>
import {defineComponent} from "vue";
import MenuDash from "@/components/DashBoard/Menu.vue";

export default defineComponent({
  components: {MenuDash}
})
</script>