<template>
    <main>
      <Alert :pass="pass" :errors="errors" />
      <div class="camada">
  
        <section>
          <div class="logo">
            <CenterAnimation />
            <Description title="Painel de Administrador" description="Defina um novo administrador do site em apenas alguns cliques"/>
          </div>
          <div class="input">
            <form @submit.prevent="checkdata">
              <div>
                <div>
                  <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" autocomplete="off" v-model="email" />
                    <label for="floatingInput">Email</label>
                  </div>
                </div>
                <div class="extra_info">
                </div>
                <Button text="Adicionar" @click="checkdata" />
              </div>
            </form>
          </div>
        </section>
      </div>
      <Background />
    </main>
  </template>
  
  <script>
  import { login } from '../services/HttpService.js';
  import Background from '../components/Login/Background.vue';
  import CenterAnimation from "@/components/Login/CenterAnimation.vue";
  import Alert from "@/components/Login/Alert.vue";
  import { mapGetters, mapMutations } from 'vuex';
  import Button from "@/components/Login/Button.vue";
  import Description from "@/components/Login/DescriptionView.vue";
  
  export default {
    computed: {
      ...mapGetters(['user_token']),
    },
    components: {Description, Alert, Button, Background, CenterAnimation },
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
              console.log(token)
              this.updateUserToken(token);
              this.$router.push('/dashboard');
            }
          } catch (error) {
            if (error.response) {
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
          }
        } else { setTimeout(() => {
          this.pass = true;
          this.errors = [];
        }, 8000);
        }
      },
      ...mapMutations(['updateUserToken'])
    }
  };
  </script>
  
  <style scoped>
  * {
    margin: 0;
    padding: 0;
  }
  main {
    overflow: hidden;
  }
  .camada {
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    width: 100vw;
    z-index: 2;
  }
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
  .logo {
    height: 30vh;
  }
  .input {
    height: 40vh;
    padding-top: 2em;
    display: flex;
    justify-content: center;
  }
  #floatingInput, #floatingPassword{
    height: 6vh;
    width: 30vw;
    min-height: 30px;
    border-radius: 5px;
    border: 1px solid lightgrey;
    font-size:15px;
  }
  .form-floating > label {
    padding: 0px;
    padding-top: 8px;
    font-size: 12px;
    padding-left: 10px;
    background-color: rgba(0, 0, 0, 0);
  }
  .form-floating > label::after {
    padding-bottom: 20px;
  }
  .extra_info
  {
    display: flex;
    justify-content: space-between;
  }
  .form-control:focus {
    box-shadow: none;
  }
  </style>
  