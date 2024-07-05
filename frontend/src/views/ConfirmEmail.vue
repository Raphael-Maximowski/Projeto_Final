<template>
  <main>
    <!-- Formulário -->
    <div class="camada">
      <section>
        <!-- Parte Superior Acima do Primeiro Input -->
        <div class="logo">
          <!-- Parte onde Ficaria a Imagem -->
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
          <!-- Descrição da Tela -->
          <div class="descricao">
            <h1>Finalizando Cadastro</h1>
            <p>Em poucos passos você poderá acessar o Customer Relationship Management da 3C Plus</p>
          </div>
        </div>
        <!-- Container para Validação -->
        <div class="validator">
          <!-- Gif de Loading -->
            <div class="loader"></div>
            <!-- Container Botão e Icone Email -->
            <div class="button">
              <!-- Icone Email -->
                <div class="emailicon">
                    <img src="../assets/images/email.png" alt="">
                </div>
                <!-- Submit -->
                <div class="message" @click="EmailConfirmed">
                    <p>Validar Email</p>
                </div>
            </div>
        </div>
      </section>
    </div>
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
<script>


export default {
    components: {
    },
  data() {
    return {
      // Confirmação de Validação com Email
      data: false
    };
  },

  
  methods: {
     // Método pra Disparar na API o timeStamp do Usuario
    EmailConfirmed()
    {
      this.data = true;
      console.log(this.data);
    }  
  },
};
</script>


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
  .limitador3 {
    margin-top: 20vh;
    margin-right: 20vw;
  }

  /* Alinhando */
  .limitador4 {
    margin-top: 20vh;   
  }

  /* DEFINIÇÕES FORMULARIO */
  /* Criando Camada Superficial Tampando Fundo */
  .camada {
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    width: 100vw;
    z-index: 2;
  }

    /* Criando Base do Login */
  .camada section {
    background-color: rgb(255, 255, 255);
    width: 45vw;
    height: 65vh;
    border-radius: 5px;
    box-shadow: 
    5px 5px 20px rgba(0, 0, 0, 0.055), 
    -5px -5px 20px rgba(0, 0, 0, 0.048); 
    padding: 15px; 
    position: absolute;
  }

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
    z-index: 2;
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
    background-image: url('../assets/images/icones_coloridos.png');
    background-size: cover; 
    background-position: center; 
    background-repeat: no-repeat; 
    animation: box1Animation 6s infinite;
    display: flex;
  }

  /* Box2 com Fundo e Animação */
  .box2 {
    background-image: url('../assets/images/logo.png');
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

  /* Alinhando Descrição */
  .descricao {
    text-align: center;
  }

  /* Definições H1 Descrição */
  .descricao h1 {
    font-size: 2.59vw;
    color: #373753;
  }

  /* Definições P Descrição */
  .descricao p {
    color: #788B9E;
    font-size: 0.88vw;
  }

/*Configueações Botão BootStrap*/
  button {
    width: 30vw;
    margin-top: 1em;
  }

   /* Definições BackGround da Validação */
  .validator {
    margin-top: 3.5em;
    height: 8em;
    display: flex;
    justify-content: center;
    align-items: center;
  }

   /* Definições Botão */
  .button {
    color: white;
    background-color:#3057F2 ;
    border-radius: 5px;
    width: 15vw;
    text-align: center;
    height: 40px;
    align-items: center;
    display: flex;
    position: fixed;
  }

   /* Icone Email */
  .button img {
    margin-left: 15px;
  }

   /* Botão Texto */
  .button p {
    margin-top: 14px;
    margin-left: 30px;
  }

   /* Botão Hover */
  .button:hover {
    background-color: #2336C7;
  }

   /* Loading */
  .loader {
  border: 4px solid rgba(0, 0, 0, 0.1);
  border-left-color: #373753;
  border-right-color: #373753;
  border-radius: 50%;
  width: 40px;
  height: 40px;
  animation: spin 1s linear infinite;
  margin-right: 25vw;
}

 /* Animação Loading */
@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}
</style>

