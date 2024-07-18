<template>
  <main>
    <div><MenuDash/></div>
    <div class="content">
      <div class="header">
        <DashFunil/>
      </div>
    </div>
  </main>
</template>
<style scoped>
main {
  display: flex;
}

.content {
  background-color: #F9FAFC;
  width: 100vw;
  height: 100vh;
}
</style>
<script>

import {defineComponent} from "vue";
import MenuDash from "@/components/DashBoard/Menu.vue";
import DashFunil from "@/components/Funil/DashFunil.vue";

export default defineComponent({
  components: {DashFunil, MenuDash}
})
</script>
