<template>
  <div class="blocker">

    <div class="basegif">
      <div class="plane"><img src="../assets/images/ExtraFeatures/plane.png"></div>
      <div class="part1"><img src="../assets/images/ExtraFeatures/nuvem.png"></div>
      <div class="part2"><img src="../assets/images/ExtraFeatures/nuvem.png"></div>
    </div>
  </div>
</template>
<script>
export default {
  name: 'Blocker'
}
</script>
<style>



.plane {
  position: absolute;
  height: 400px;
  width: 300px;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 1;

  animation: moveUpDown 7s infinite;
}
.plane img {
  transform: rotate(15deg); /* Ajuste o ângulo conforme necessário */
  /* Garantindo que o ponto de origem da rotação seja o centro */
  transform-origin: center;
}
@keyframes moveUpDown {
  0% {
    transform: translate(0%, 0%) translateY(0);
  }
  25% {
    transform: translate(0%, -20%) translateY(-50px); /* Ajuste a distância de subida */
  }

  65% {
    transform: translate(0%, 10%) translateY(50px); /* Ajuste a distância de subida */
  }
  100% {
    transform: translate(0%, 0%) translateY(0);
  }
}

.basegif {
  width: 300px;
  height: 300px;
  margin-top: 10vw;
}

.basegif img {
  width: 250px;
  height: 250px;
  margin-bottom: 0px;
}

@keyframes moveRightAndFade {
  0% {
    transform: translate(-80px, 0px);
    opacity: 1;
  }
  50% {
    transform: translate(-250px, 0px); /* ajuste conforme necessário */
    opacity: 1;
  }
  100% {
    transform: translate(-80px, 0px); /* ajuste conforme necessário */
    opacity: 1;
  }
}

@keyframes moveLeftAndFade {
  0% {
    transform: translate(100px, 0px);
    opacity: 1;
  }
  50% {
    transform: translate(250px, 0px); /* ajuste conforme necessário */
    opacity: 1;
  }
  100% {
    transform: translate(100px, 0px); /* ajuste conforme necessário */
    opacity: 1;
  }
 }

.part1 {
  position: absolute;
  margin-right: 5vw;
  z-index: 1000;
  height: 150px;
  display: flex;
  justify-content: center;
  will-change: transform, opacity;
  animation: moveRightAndFade 9s infinite;
}
.part2 {
  margin-top: 8vw;
  height: 150px;
  display: flex;
  justify-content: center;
  animation: moveLeftAndFade 9s infinite;
}
.blocker {
  width: 100vw;
  height: 100vh;
  background-color: #ebf2fb;
  position: absolute;
  z-index: 10000000;
  display: flex;
  justify-content: center;
}
</style>