<template>
  <main>
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


      <section>
        <!-- Parte Superior Acima do Primeiro Input -->
        <div class="logo">
          <!-- Parte onde Ficaria a Imagem -->
         <CenterAnimation/>
          <!-- Descrição da Tela -->
          <div class="descricao">
            <h1>Sua Jornada começa aqui</h1>
            <p>Um único login para o Customer Relationship Management da 3C Plus</p>
          </div>
        </div>

        <!-- Container Formularios -->
        <div class="input">
          <!-- Previnindo Ativação Antecipada do checkdata -->
          <form @submit.prevent="checkdata">
            <div>
              <div>
                <!-- Input Email -->
                <div class="form-floating mb-3">
                  <input type="name" class="form-control" id="floatingInput" autocomplete="off" v-model="email">
                  <label for="floatingInput">Email</label>
                </div>
              </div>
              <!-- Input Senha -->
              <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" v-model="password">
                <label for="floatingPassword">Senha</label>
              </div>
              <!-- Informações Extras Abaixo dos Input -->
              <div class="extra_info">
                <!-- Redefinir Senha -->
                <div class="forgot">
                  <a href="/redefine">
                    <p>Esqueceu sua senha?</p>
                  </a>
                </div>
                <!-- Registrar Usuario -->
                <div class="forgot">
                  <a href="/register">
                    <p>Não tem uma conta? Crie já</p>
                  </a>
                </div>
              </div>

               <!-- Submit -->
              <a id="send" class="btn btn-primary" @click="checkdata">
                Entrar
              </a>
            </div>
          </form>
        </div>
      </section>
    </div>
    <Background/>
    </main>
</template>

<<script>
import { login } from '../../services/HttpService.js';
import Background from '../../components/Login/Background.vue';
import CenterAnimation from "@/components/Login/CenterAnimation.vue";
import { mapGetters, mapMutations } from 'vuex';
import Collection from "@/components/Collection.vue";
import Funil from "@/components/Funil.vue";

export default {
  computed: {
    ...mapGetters(['user_token']),
  },
  components: { Background, CenterAnimation },
  data() {
    return {
      email: "",
      password: "",
      errors: [],
      pass: true
    };
  },

  methods: {
    ValidateEmail() {
      if (this.email.length === 0) {
        this.errors.push('O campo Email é obrigatório!');
        this.pass = false;
      }
    },

    ValidatePassword() {
      if (this.password.length === 0) {
        this.errors.push('O Campo senha é obrigatório!');
        this.pass = false;
      }
    },

    ValidateForm() {
      this.errors = [];
      this.pass = true;
      this.ValidateEmail();
      this.ValidatePassword();
    },

    async checkdata() {
      this.ValidateForm();
      if (this.pass) {
        const data = {
          email: this.email,
          password: this.password
        };

        try {
          const response = await login(data);
          if (response.status === 200) {

            const token = response.data.access_token;
            this.updateUserToken(token);
            this.$router.push('/dashboard');
          }
        } catch (error) {
          if (error.response) {
            console.log('Status do erro:', error.response.status);
            if (error.response.status === 401) {
              this.errors.push('Credenciais Invalidas!');
            } else if (error.response.status === 403) {
              this.errors.push('Verifique seu email para poder realizar o login');
            } else if (error.response.status === 404) {
              this.errors.push('Usuario não encontrado');
            } else {
              this.errors.push('Erro desconhecido ao tentar realizar o login.');
            }
            this.pass = false;
          }

          setTimeout(() => {
            this.pass = true;
            this.errors = [];
          }, 8000);
        }
      }
    },
    ...mapMutations(['updateUserToken'])
  }
};
</script>



<style>
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
    z-index: 2;
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
    z-index: 3;
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

  /* Enviar Button */
  #send {
    width: 30vw;
    margin-top: 1vw;
  }
</style>