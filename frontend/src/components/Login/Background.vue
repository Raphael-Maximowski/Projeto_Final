<template>
  <main>
    <!-- Container com 50% da Tela Verticalmente -->
    <div class="container">
      <!-- Divisão de 4 box cada com 50% 50% da tela -->
      <div class="block1">
        <!-- Limita o Range que o Circulo vai se Movimentar -->
        <div class="limitador">
          <!-- Circulo -->
          <div class="circle1"></div>
        </div>
      </div>

      <!-- Divisão de 4 box cada com 50% 50% da tela -->
      <div class="block2">
        <!-- Limita o Range que o Circulo vai se Movimentar -->
        <div class="limitador2">
          <!-- Circulo -->
          <div class="circle2"></div>
        </div>
      </div>

    </div>

    <!-- Container com 50% da Tela Verticalmente -->
    <div class="container">
      <!-- Divisão de 4 box cada com 50% 50% da tela -->
      <div class="block3">
        <!-- Limita o Range que o Circulo vai se Movimentar -->
        <div class="limitador3">
          <!-- Circulo -->
          <div class="circle3"></div>
        </div>
      </div>

      <!-- Divisão de 4 box cada com 50% 50% da tela -->
      <div class="block4">
        <!-- Limita o Range que o Circulo vai se Movimentar -->
        <div class="limitador4">
          <!-- Circulo -->
          <div class="circle4"></div>
        </div>
      </div>
    </div>
  </main>
</template>
<style>

/* DEFINIÇÕES FUNDO */
/* Animação Sentido Horário */
@keyframes rotate {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(360deg);
  }
}

/* Animação Sentido Anti-Horário */
@keyframes rotate-counter-clockwise {
  from {
    transform: rotate(0deg);
  }
  to {
    transform: rotate(-360deg);
  }
}

/* Retirando Bordas */
* {
  margin: 0;
  padding: 0;
}

/* Retirando Rolagem Lateral */
main {
  overflow: hidden;
}

/* Divindo a tela em Dois Blocos na Horizontal */
.container {
  height: 50vh;
  width: 100vw;
  display: flex;
  margin: 0;
  padding: 0;
}

/* Divindo a tela em 4 Box 50% 50% */
.block1, .block2, .block3, .block4 {
  height: 50vh;
  width: 50vw;
}

/* Alinhando */
.block2, .block4 {
  margin-left: 40vw;
}

/* Config Circulo */
.circle1 {
  width: 300px;
  height: 300px;
  border-radius: 50%;
  background-color: lightblue;
  animation: rotate 60s linear infinite;
  filter: blur(150px);
}

/* Config Circulo */
.circle2 {
  width: 300px;
  height: 300px;
  border-radius: 50%;
  background-color: rgb(255, 192, 203);
  animation: rotate 60s linear infinite;
  filter: blur(150px);
}

/* Config Circulo */
.circle3 {
  width: 300px;
  height: 300px;
  border-radius: 50%;
  background-color: rgba(0, 128, 0, 0.364);
  animation: rotate 60s linear infinite;
  filter: blur(150px);
}

/* Config Circulo */
.circle4 {
  width: 300px;
  height: 300px;
  border-radius: 50%;
  background-color: rgba(255, 255, 0, 0.471);
  animation: rotate 60s linear infinite;
  filter: blur(150px);
}

/* Definindo Quais Limitadores Movimentam em Horário*/
.limitador, .limitador4 {
  height: 30vh;
  width: 30vw;
  display: flex;
  animation: rotate 60s linear infinite; /* Animação de rotação Sentindo Horario */
}

/* Definindo Quais Limitadores Movimentam em Anti-Horário*/
.limitador2, .limitador3 {
  animation: rotate-counter-clockwise 60s linear infinite; /* Animação de rotação no sentido anti-horário */
  height: 30vh;
  width: 30vw;
  display: flex;
}

/* Alinhando */
.limitador4 {
  margin-top: 20vh;
}

.limitador3 {
  margin-top: 20vh;
  margin-right: 20vw;
}

</style>
<script>
</script>