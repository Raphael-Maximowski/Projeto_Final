<template>
  <div class="img">
    <!-- Camada -->
    <div class="background">
      <!-- Container com Rotação de Imagens -->
      <div class="containerimg">
        <!-- Imagem1 -->
        <div class="box box1"></div>
        <!-- Imagem 2 -->
        <div class="box box2"></div>
      </div>
    </div>
  </div>

</template>
  <style>
    /* Região Superior Abrangindo Animação e Descrição */
    .logo {
      height: 30vh;
    }

    /* Região Abrangindo Animação */
    .img {
      height: 20vh;
    }

    /* Base Animação */
    .containerimg {
      position: relative;
      display: flex;
      width: 25vw;
      height: 18vh;
      overflow: hidden;
    }

    /* Definições Gerais Box Animação */
    .box {
      position: absolute;
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 2em;
      color: white;
    }

    /* Box1 com Fundo e Animação */
    .box1 {
      background-image: url('../assets/images/Login/icones_coloridos.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      animation: box1Animation 6s infinite;
      display: flex;
    }

    /* Box2 com Fundo e Animação */
    .box2 {
      background-image: url('../assets/images/Login/logo.png');
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
      animation: box2Animation 6s infinite;
    }

    /* Alinhando Box Animação*/
    .background {
      display: flex;
      justify-content: center;
    }

    /* Animação Box1 */
    @keyframes box1Animation {
      0% {
        transform: translateY(0);
      }
      30% {
        transform: translateY(-100%);
      }
      70% {
        transform: translateY(100%);
      }
      100% {
        transform: translateY(0);
      }
    }

    /* Animação Box2 */
    @keyframes box2Animation {
      0% {
        transform: translateY(100%);
      }
      30% {
        transform: translateY(0);
      }
      70% {
        transform: translateY(0);
      }
      100% {
        transform: translateY(-100%);
      }
    }

  </style>
<script setup lang="ts">
</script>