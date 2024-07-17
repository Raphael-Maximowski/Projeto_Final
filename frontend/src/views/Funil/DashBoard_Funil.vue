<template>
  <main>
    <div><MenuDash/></div>
    <div class="content">
      <div class="header">
        <div>a</div>
        <div>b</div>
        <div>c</div>
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

export default defineComponent({
  components: {MenuDash}
})
</script>
