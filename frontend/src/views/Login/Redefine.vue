<template>
    <main>
      <Alert :pass="pass" :errors="errors" />
      <Email :succes="succes" title="Email enviado com sucesso" content="Confira seu email para realizar as alterações" button="Conferir Email" rota="http://localhost:8025" />
      <div class="camada">
        <section>
          <div class="logo">
           <CenterAnimation/>
            <Description title="Redefinindo Senha" description="Em poucos passos iremos recuperar seu acesso"/>
          </div>
          <div class="input">
            <form action="" method="post">
              <div>
                <div>
                    <h3 class="email">Insira seu Email</h3>
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
  import Email from "@/components/Login/Email.vue"
  import Alert from "@/components/Login/Alert.vue";
  import Description from "@/components/Login/DescriptionView.vue";
  export default {
    components: {
      Description,
      Email,
      Alert,
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
            console.log('Status da resposta:', response.status);
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
      z-index: 1;
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
      z-index: 1000;
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
      font-size:15px
    }

    .form-floating > label {
      padding: 0px;
      padding-top: 8px;
      font-size: 12px;
      padding-left: 10px;
      background-color: rgba(0, 0, 0, 0);
      color: grey;
    }

    .form-floating > label::after {
      padding-bottom: 20px;
    }

    .extra_info 
    {
      display: flex;
      justify-content: space-between;
    }

    .forgot p {
      margin-top: 5px;
      font-size: 13px;
      color: #1a202c;
      text-decoration: underline;
    }

    .form-control:focus {
      box-shadow: none; 
    }

    h3 {
      font-size: 16px;
      color: #1a202c;
    }

  </style>