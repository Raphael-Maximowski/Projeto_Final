<template>
  <main>
    <div class="modal2" v-if="succes == true">
      <div class="container-modal">
        <div class="email">
          <div class="img-up"><img src="../../assets/images/Login/icones_coloridos.png"></div>
          <h3>Nova senha Cadastrada</h3>
          <p>Seu acesso ao sistema foi liberado novamente</p>
          <div class="router-email">
            <div class="content-modal2" @click="push">Login</div>
          </div>
          <div class="img-down"><img src="../../assets/images/Login/icones_coloridos.png"></div>
        </div>
      </div>
    </div>

    <div id="modal" v-if="this.pass != 1">
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

    <!-- Formulário -->
    <div class="camada">
      <section>
        <!-- Parte Superior Acima do Primeiro Input -->
        <div class="logo">
          <!-- Parte onde Ficaria a Imagem -->
          <CenterAnimation/>
          <!-- Descrição da Tela -->
          <div class="descricao">
            <h1>Redefinindo sua Senha</h1>
            <p>Insira sua nova senha para acessar o CRM da 3C Plus</p>
          </div>
        </div>

        <!-- Container Formularios -->
        <div class="input">
          <form action="" method="post">
            <div>
              <div>
                <!-- Input Nova Senha -->
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="floatingInput"  autocomplete="off" v-model="password">
                  <label for="floatingInput">Nova Senha</label>
                </div>
              </div>
              <!-- Input Confirmação Nova Senha -->
              <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" v-model="confirmpassword" >
                <label for="floatingPassword">Confirme sua nova senha</label>
              </div>

              <!-- Disparando pra API e Validando -->
              <a class="button">
                  <a id="send" class="btn btn-primary" @click="ValidateForm">
                    Alterar Senha
                  </a>
              </a>
            </div>
          </form>
        </div>
      </section>
    </div>
   <Background/>
    </main>
</template>
<script>
import { SendPassword } from '../../services/HttpService.js';
import Background from "../../components/Login/Background.vue"
import CenterAnimation from "@/components/Login/CenterAnimation.vue";
export default {
    components: {
      CenterAnimation,
      Background
    },
  data() {
  // Parametros que serão passados ao BackEnd e Validações
    return {
      password: "",
      confirmpassword: "",
      token: '',
      email: '',
      succes: false,
      errors: [],
      data: {},
      pass: true
    };
  },

  mounted() {
    this.token = this.$route.params.token;
    this.email = this.$route.params.email;
  },

  methods: {
    // Validando Senha
    ValidatePassword()
    {
      if (this.password.length == 0)
      {
        // Push caso não valide
         this.errors.push('O Campo senha é obrigatório!')   
         // Redefine Passagem como falsa
         this.pass = false;
         // Após Aparecer Erro Reseta os Parametros
         setTimeout(() => {
          this.pass = true;
          this.errors = [];
        }, 8000); 
      }

      else if (this.password.length < 8)
      {
        // Push caso não valide
        this.errors.push('Insira pelo menos oito Caracteres!')
        // Redefine Passagem como falsa
        this.pass = false;
        // Após Aparecer Erro Reseta os Parametros
        setTimeout(() => {
          this.pass = true;
          this.errors = [];
        }, 8000); 
      }
    },

    // Validando Confirmaçao de Senha
    ValidateConfirmPassword()
    {
      if (this.confirmpassword.length == 0)
      {
        // Push caso não valide
        this.errors.push('O Campo Confirmar Senha é obrigatório!') 
        // Redefine Passagem como falsa
        this.pass = false;
        // Após Aparecer Erro Reseta os Parametros
        setTimeout(() => {
          this.pass = true;
          this.errors = [];
        }, 8000);   
      }

      else if (this.confirmpassword.length < 8)
      {
        // Push caso não valide
        this.errors.push('Insira pelo menos oito Caracteres!')
        // Redefine Passagem como falsa
        this.pass = false;
         // Após Aparecer Erro Reseta os Parametros
        setTimeout(() => {
          this.pass = true;
          this.errors = [];
        }, 8000); 
      }
    },

    // Validando os dois Inputs
    CheckPassword()
    {
      if (this.password != this.confirmpassword)
      {
        // Push caso não valide
        this.errors.push('Senhas Divergentes')
        // Redefine Passagem como falsa
        this.pass = false;
        // Após Aparecer Erro Reseta os Parametros
        setTimeout(() => {
          this.pass = true;
          this.errors = [];
        }, 8000); 
      }
    },

    // Validando Formulário e Chamando Métodos
    ValidateForm()
    {
      this.ValidatePassword(),
      this.ValidateConfirmPassword(),
      this.CheckPassword(),
      this.sendForm()
    },

    // Enviando Dados Após Validação
    async sendForm() {
      // Validação OK
        if (this.pass === true) {
          try {
              const data = {
              password: this.password,
              token: this.token,
              email: this.email
            }

            const response = await SendPassword(data);
              this.succes = true;
            console.log('Resposta da API:', response);
            } catch (error) {
            console.error('Erro ao Trocar Password:', error);
          }
        }

        // Redefine Passagem como falsa
        else if (this.pass != true)
        {
            this.pass = false; 
        }
    },
    push()
    {
      this.$router.push('/');
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
  cursor: pointer;
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
  margin-right:65vw;
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
  .button {
    width: 30vw;
    margin-top: 2em;
  }

  /*Configueações Input BootStrap*/
  .form-control:focus {
    box-shadow: none; 
  } 

  /* Enviar Button */
  #send {
    width: 30vw;
    margin-top: 2vw;
  }
</style>