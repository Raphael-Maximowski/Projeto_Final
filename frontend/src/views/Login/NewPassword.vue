<template>
  <main>
    <Email :succes="succes" title="Nova senha Cadastrada" content="Seu acesso ao sistema foi liberado novamente" button="Login" rota="http://localhost:8085/" />
    <Alert :pass="pass" :errors="errors" />
    <div class="camada">
      <section>
        <div class="logo">
          <CenterAnimation/>
          <Description title="Redefinindo sua Senha" description="Insira sua nova senha para acessar o CRM da 3C Plus"/>
        </div>
        <div class="input">
          <form action="" method="post">
            <div>
              <div>
                <div class="form-floating mb-3">
                  <input type="password" class="form-control" id="floatingInput"  autocomplete="off" v-model="password">
                  <label for="floatingInput">Nova Senha</label>
                </div>
              </div>
              <div class="form-floating" style="margin-bottom: 20px">
                <input type="password" class="form-control" id="floatingPassword" v-model="confirmpassword" >
                <label  for="floatingPassword">Confirme sua nova senha</label>
              </div>
              <Button text="Alterar Senha" @click="ValidateForm"/>
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
import Button from "@/components/Login/Button.vue";
import Alert from "@/components/Login/Alert.vue";
import Email from "@/components/Login/Email.vue";
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
    ValidatePassword()
    {
      if (this.password.length == 0)
      {
         this.errors.push('O Campo senha é obrigatório!')
         this.pass = false;
         setTimeout(() => {
          this.pass = true;
          this.errors = [];
        }, 8000); 
      }

      else if (this.password.length < 8)
      {
        this.errors.push('Insira pelo menos oito Caracteres!')
        this.pass = false;
        setTimeout(() => {
          this.pass = true;
          this.errors = [];
        }, 8000); 
      }
    },

    ValidateConfirmPassword()
    {
      if (this.confirmpassword.length == 0)
      {
        this.errors.push('O Campo Confirmar Senha é obrigatório!')
        this.pass = false;
        setTimeout(() => {
          this.pass = true;
          this.errors = [];
        }, 8000);   
      }

      else if (this.confirmpassword.length < 8)
      {
        this.errors.push('Insira pelo menos oito Caracteres!')
        this.pass = false;
        setTimeout(() => {
          this.pass = true;
          this.errors = [];
        }, 8000); 
      }
    },

    CheckPassword()
    {
      if (this.password != this.confirmpassword)
      {
        this.errors.push('Senhas Divergentes')
        this.pass = false;
        setTimeout(() => {
          this.pass = true;
          this.errors = [];
        }, 8000); 
      }
    },

    ValidateForm()
    {
      this.ValidatePassword(),
      this.ValidateConfirmPassword(),
      this.CheckPassword(),
      this.sendForm()
    },

    async sendForm() {
        if (this.pass === true) {
          try {
              const data = {
              password: this.password,
              token: this.token,
              email: this.email
            }

            const response = await SendPassword(data);
              this.succes = true;
            } catch (error) {
          }
        }

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


  .forgot p {
    margin-top: 5px;
    font-size: 13px;
    color: #1a202c;
    text-decoration: underline;
  }


  .form-control:focus {
    box-shadow: none; 
  } 

</style>