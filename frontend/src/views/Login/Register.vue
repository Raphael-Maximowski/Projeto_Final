<template>
  <main>
    <Email :succes="succes" title="Usuario Cadastrado  com Sucesso" content="Valide o seu Email para Acessar o Sistema" button="Conferir Email" rota="http://localhost:8025" />
    <Alert :pass="pass" :errors="errors" />
    <div class="camada">
      <section>
        <div class="logo">
         <CenterAnimation/>

          <Description title="Sua Jornada começa aqui" description="Crie sua conta para acessar o Customer Relationship Management da 3C Plus"/>
        </div>

        <div class="input">
          <form action="" method="post">
            
            <div>                       
                <div>
                    <div class="form-floating mb-3">
                        <input type="name" class="form-control" id="floatingInput" autocomplete="off" v-model="nome">
                  <label for="floatingInput">Nome</label>
                </div>
              </div>
              <div>
                <div class="form-floating mb-3">
                  <input type="name" class="form-control" id="floatingInput" autocomplete="off" v-model="email">
                  <label for="floatingInput">Email</label>
                </div>
              </div>
              <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword"  v-model="password">
                <label for="floatingPassword">Senha</label>
              </div>
              <div class="form-floating">
                <input type="password" class="form-control" id="floatingPassword" v-model="confirmpassword">
                <label for="floatingPassword">Confirme sua Senha</label>
              </div>
              <div class="extra_info">
                <div class="forgot">
                  <a href="/">
                      <p>Ja possui uma conta? Realize login</p>
                  </a>
                </div>
              </div>
                <Button text="Registrar usuario" @click="ValidateForm"/>
            </div>
          </form>
        </div>
      </section>
    </div>
   <Background/>
    </main>
</template>
<script>
import { SendUser } from '../../services/HttpService.js';
import Background from '../../components/Login/Background.vue'
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
      nome: "",
      email: "",
      password: "",
      confirmpassword: "",
      succes: false,
      errors: [],
      user: {},
      pass: true
    };
  },

  methods: {
    ValidateName()
    {
      if (this.nome.length == 0)
      {
        this.errors.push('O Campo nome é Obrigatório!')
        this.pass = false;
        setTimeout(() => {
          this.pass = true;
          this.errors = [];
        }, 8000); 
      }
      else if (this.nome.length < 3)
      {
        this.errors.push('Insira pelo menos três Caracteres!')
        this.pass = false;
        setTimeout(() => {
          this.pass = true;
          this.errors = [];
        }, 8000); 
      }
      else if (this.nome.length > 30)
      {
        this.errors.push('O Campo nome excedeu o limite máximo de Caracteres!');
        this.pass = false;
        setTimeout(() => {
          this.pass = true;
          this.errors = [];
        }, 8000); 
      }
    },

    ValidateEmail()
    {

      if (this.email.length == 0)
      {
        this.errors.push('O campo Email é obrigatório!')
        this.pass = false;
        setTimeout(() => {
          this.pass = true;
          this.errors = [];
        }, 8000); 
      }
    },

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
        this.errors.push('Alguma das Senhas esta incorreta, insira novamente')
        this.pass = false;
        setTimeout(() => {
          this.pass = true;
          this.errors = [];
        }, 8000); 
      }
    },

    ValidateForm()
    {
      this.ValidateName(),
      this.ValidateEmail(),
      this.ValidatePassword(),
      this.ValidateConfirmPassword(),
      this.CheckPassword(),
      this.sendForm()
    },

    async sendForm() {
  if (this.pass === true) {
    this.succes = true;

    try {
      const user = {
        name: this.nome,
        email: this.email,
        password: this.password,
    };

      const response = await SendUser(user);
      this.succes = true;
      console.log('Resposta da API:', response);
      console.log('Dados do usuário:', this.ValidateName, this.email, this.password); 
    } catch (error) {
      console.error('Erro ao cadastrar usuário:', error);
    }

  } else {
    this.pass = false; 
  }
}
  },
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
    z-index: 2;
  }

  .camada section {
    background-color: rgb(255, 255, 255);
    width: 45vw;
    height: 90vh;
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

  .form-floating{
    margin-bottom: 15px;
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
</style>
