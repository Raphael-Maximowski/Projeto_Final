<template>
  <div class="blocker">
    <div class="basegif">
      <div class="part1"><img src="../assets/images/"></div>
      <div class="part2"></div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'Blocker'
}
</script>
<style>
.basegif {
  background-color: red;
  width: 300px;
  height: 300px;

}

.blocker {
  width: 100vw;
  height: 100vh;
  background-color: #ebf2fb;
  position: absolute;
  z-index: 10000000;
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>