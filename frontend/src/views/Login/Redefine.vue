<template>
    <main>
      <div class="modal2" v-if="succes == true">
        <div class="container-modal">
          <div class="email">
            <div class="img-up"><img src="../../assets/images/Login/icones_coloridos.png"></div>
            <h3>Codigo Enviado com Sucesso</h3>
            <p>Confira seu email para redefinir sua senha</p>
            <div class="router-email">
              <a href="http://localhost:8025/"><div class="content-modal2"><img src="../../assets/images/Login/email.png"> Conferir Email</div></a>
            </div>
            <div class="img-down"><img src="../../assets/images/Login/icones_coloridos.png"></div>
          </div>
        </div>
      </div>
      <div class="camada">
            <div class="camada">
      <!-- Ativação Alerta -->
       <div id="modal" v-if="!this.pass">
        <!-- Container Principal do Modal -->
        <div class="info-modal">
          <!-- Background Icone -->
          <div class="icon">
            <!-- Background Ghost -->
            <div class="ghost">
              <!-- Inserindo Imagem Ghost -->
              <div class="img-modal">
              </div>
            </div>
            <!-- Background Erros -->
            <div class="error">
              <!-- Exibindo Primeiro erro Disparado na Array -->
              <p>{{this.errors[0]}}</p>
            </div>
          </div>
          <!-- Underline Vermelho no Alerta -->
          <div class="line">
          </div>
        </div>
      </div>
       </div>

       <!-- Formulário -->
        <section>
          <!-- Parte Superior Acima do Primeiro Input -->
          <div class="logo">
            <!-- Parte onde Ficaria a Imagem -->
           <CenterAnimation/>
            <!-- Descrição da Tela -->
            <div class="descricao">
              <h1>Redefinindo Senha</h1>
              <p>Em poucos passos iremos recuperar seu acesso</p>
            </div>
          </div>

          <!-- Container Formularios -->
          <div class="input">
            <form action="" method="post">
              <div>
                <div>
                    <h3 class="email">Insira seu Email</h3>
                    <!-- Input Email -->
                  <div class="form-floating mb-3">
                    <input type="name" class="form-control" id="floatingInput" placeholder="name@example.com" autocomplete="off" v-model="email">
                    <label for="floatingInput" >Email</label>
                  </div>
                </div>
                <div class="extra_info">
                </div>

                <Button text="Enviar redefinição de senha" @click="Validator"/>
              </div>
            </form>
          </div>
        </section>
      </div>
     <Background/>
    </main>
</template>

<script>
  import {ResetPassword} from '@/services/HttpService.js';
  import Background from '../../components/Login/Background.vue'
  import CenterAnimation from "@/components/Login/CenterAnimation.vue";
  import Button from "@/components/Login/Button.vue";
  export default {
    components: {
      Button,
      CenterAnimation,
      Background
    },
    data() {
      return {
        email: "",
        errors: [],
        succes: false,
        pass: true
      };
    },

    methods: {
      ValidateEmail() {
        if (this.email.length === 0) {
          this.errors.push('O campo Email é obrigatório!');
          this.pass = false;
          setTimeout(() => {
            this.pass = true;
            this.errors = [];
          }, 8000);
        }
      },

      async sendemail() {
        if (this.pass === true) {
          try {
            const data = {email: this.email};
            const response = await ResetPassword(data);
            console.log('Status da resposta:', response.status); // Aqui você pode acessar o status da resposta
            this.succes = true;
          } catch (error) {
              if (error.response.status === 404) {
                this.errors.push('Usuario não encontrado');
                this.pass = false;
            }
          }
          setTimeout(() => {
            this.pass = true;
            this.errors = [];
          }, 8000);
        }
      },

      Validator() {
        this.ValidateEmail();
        if (this.pass) {
          this.sendemail();
        }
      }
    }
  };

</script>



<style>
.img-up img {
  width: 150px;
  position: absolute;
  margin-right: 10px;
}

.img-down img {
  width: 150px;
  position: absolute;
  margin-left: 10px;
}

.img-up {
  background-color: red;
  width: 50vw;
  display: flex;
  justify-content: end;
}

.img-down {
  background-color: red;
  width: 50vw;
  display: flex;
  justify-content: start;
  margin-top: 25px;
}
a {
  text-decoration: none;
}

.content-modal2 {
  color: white;
  font-size: 18px;
  width: 15vw;
  margin-top: 20px;
  padding: 10px 0px;
  border-radius: 10px;
  background-color: #2336C7;
}

.container-modal {
  background-color: white;
  width: 50vw;
  height: 45vh;
  border-radius: 20px;
  display: flex;
  justify-content: center;
  text-align: center;
}

.email h3 {
  font-size: 35px;
  color: #1a202c;
  margin: 75px 0px 10px 0px
}

.router-email {
  display: flex;
  justify-content: center;
}


.router-email img {
  margin-right: 10px;
}

.router-email p {
  color: white;
  position: absolute;
}

.email p {
  font-size: 18px;
  color: black;
}

.modal2 {
  position: absolute;
  z-index: 999;
  width: 100vw;
  height: 100vh;
  background: rgba(0, 0, 0, 0.384);
  display: flex;
  align-items: center;
  justify-content: center;
}

/* DEFINIÇÕES ALERTA */
/* Animação Aparecer e Sumir */
@keyframes moveUpDown {
  0% {
    opacity: 0;
    transform: translateY(0);
  }
  5%, 10% {
    opacity: 1;
    transform: translateY(0);
  }
  20% {
    opacity: 1;
    transform: translateY(110px);
  }
  30%, 90% {
    opacity: 1;
    transform: translateY(110px);
  }
  100% {
    opacity: 0;
    transform: translateY(0);
  }
}

/* Background Alerta */
#modal {
  display: flex;
  justify-content: center;
  width: 100vw;
  height: 100vh;
  position: absolute;
  z-index: 1;
}

/* Principal Elemento Visual Modal */
.info-modal {
  position: relative;
  opacity: 0;
  animation: moveUpDown 8s ease-in-out 1;
  margin-right: 65vw;
}

/* Configuração Texto */
.error p {
  margin-top: 10px;
  font-size: 13px;
}

/* Imagem Ghost */
.img-modal {
  background-image: url('../../assets/images/Login/modal.png');
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  width: 50px;
  height: 50px;
}

/* Redefinições Extras Modal */
.info-modal {
  background-color: rgb(255, 255, 255);
  width: 15vw;
  height: 10vh;
  border-radius: 10px;
  position: absolute;
}

/* Tamanho Background icon ghost */
.icon {
  height: 8vh;
  display: flex;
}

/* Linha */
.line {
  background-color: red;
  height: 2vh;
  border-radius: 0px 0px 10px 10px;
}

/* Background Ghost */
.ghost {
  width: 6vw;
  height: 8vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Background Erro */
.error {
  width: 9vw;
  height: 8vh;
}

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

/* H3 Email */
.email {
    font-size: 1vw;
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
    /* DEFINIÇÕES FORMULARIO */
    /* Criando Camada Superficial Tampando Fundo */
    .camada {
      position: absolute;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      width: 100vw;
      z-index: 1;
    }
  
      /* Criando Base do Login */
    .camada section {
      background-color: rgb(255, 255, 255);
      width: 45vw;
      height: 70vh;
      border-radius: 5px;
      box-shadow: 
      5px 5px 20px rgba(0, 0, 0, 0.055), 
      -5px -5px 20px rgba(0, 0, 0, 0.048); 
      padding: 15px; 
      position: absolute;
      z-index: 1000;
    }
  
    /* Região Superior Abrangindo Animação e Descrição */
    .logo {
      height: 30vh;
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
      font-size: 0.96vw;
    }
  
    /* Definições Base do Input, Abrange toda Região Abaixo da Descrição */
    .input {
      height: 40vh;
      padding-top: 2em;
      display: flex;
      justify-content: center;
    }
  
  /*Configueações Input BootStrap*/
    #floatingInput, #floatingPassword{
      height: 6vh;
      width: 30vw;
      min-height: 30px;
      border-radius: 5px;
      border: 1px solid lightgrey;
      font-size:15px
    }
  
    /*Configueações Label BootStrap*/
    .form-floating > label {
      padding: 0px;
      padding-top: 8px;
      font-size: 12px;
      padding-left: 10px;
      background-color: rgba(0, 0, 0, 0);
      color: grey;
    }
  
    /*Configueações Label BootStrap*/
    .form-floating > label::after {
      padding-bottom: 20px;
    }
  
    /*Configueações Informaçoes Extras (Senha/Nova Conta) BootStrap*/
    .extra_info 
    {
      display: flex;
      justify-content: space-between;
    }
  
    /*Configueações escritas*/
    .forgot p {
      margin-top: 5px;
      font-size: 13px;
      color: grey;
      text-decoration: underline;
    }
  
    /*Configueações Botão BootStrap*/
    button {
      width: 30vw;
      margin-top: 1em;
    }
  
    /*Configueações Input BootStrap*/
    .form-control:focus {
      box-shadow: none; 
    } 

    #send {
      width: 30vw;
    }
  </style>