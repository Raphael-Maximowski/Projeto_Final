<template>
  <main>
      <div id="modal" v-if="this.pass != 1">
        <div class="info-modal">
          <div class="icon">
            <div class="ghost">
              <div class="img-modal">
              </div>
            </div>
            <div class="error">
              <p>{{this.errors[0]}}</p>
            </div>
          </div>
          <div class="line">
          </div>
        </div>
      </div>
    <div class="camada">
      <section>
        <div class="logo">
          <div class="img">
            <div class="background">
              <div class="containerimg">
                <div class="box box1"></div>
                <div class="box box2"></div>
              </div>
            </div>
          </div>
          <div class="descricao">
            <h1>Sua Jornada começa aqui</h1>
            <p>Crie sua conta para acessar o Customer Relationship Management da 3C Plus</p>
          </div>
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
                <a class="btn btn-primary" @click="ValidateForm">Entrar</a>
            </div>
          </form>
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
import { SendUser } from '../services/HttpService';

export default {
    components: {
    },
  data() {
    return {
      nome: "",
      email: "",
      password: "",
      confirmpassword: "",
      errors: [],
      user: [],
      pass: 1
    };
  },

  methods: {
    ValidateName()
    {
      if (this.nome.length == 0)
      {
        this.errors.push('O Campo nome é Obrigatório!')
        this.pass = 0;
        setTimeout(() => {
          this.pass = 1;
          this.errors = [];
        }, 8000); 
      }
      else if (this.nome.length < 3)
      {
        this.errors.push('O Campo nome precisa de pelo menos três Caracteres!')
        this.pass = 0;
        setTimeout(() => {
          this.pass = 1;
          this.errors = [];
        }, 8000); 
      }
      else if (this.nome.length > 30)
      {
        this.errors.push('O Campo nome excedeu o limite máximo de Caracteres!') 
        this.pass = 0;
        setTimeout(() => {
          this.pass = 1;
          this.errors = [];
        }, 8000); 
      }
    },

    ValidateEmail()
    {

      if (this.email.length == 0)
      {
        this.errors.push('O campo Email é obrigatório!')
        this.pass = 0;
        setTimeout(() => {
          this.pass = 1;
          this.errors = [];
        }, 8000); 
      }
    },

    ValidatePassword()
    {
      if (this.password.length == 0)
      {
         this.errors.push('O Campo senha é obrigatório!')   
         this.pass = 0;
         setTimeout(() => {
          this.pass = 1;
          this.errors = [];
        }, 8000); 
      }
      else if (this.password.length < 8)
      {
        this.errors.push('O Campo senha precisa de pelo menos oito Caracteres!')
        this.pass = 0;
        setTimeout(() => {
          this.pass = 1;
          this.errors = [];
        }, 8000); 
      }
    },

    ValidateConfirmPassword()
    {
      if (this.confirmpassword.length == 0)
      {
        this.errors.push('O Campo Confirmar Senha é obrigatório!') 
        this.pass = 0;
        setTimeout(() => {
          this.pass = 1;
          this.errors = [];
        }, 8000);   
      }
      else if (this.confirmpassword.length < 8)
      {
        this.errors.push('O Campo Confirmar senha precisa de pelo menos oito Caracteres!')
        this.pass = 0;
        setTimeout(() => {
          this.pass = 1;
          this.errors = [];
        }, 8000); 
      }
    },

    CheckPassword()
    {
      if (this.password != this.confirmpassword)
      {
        this.errors.push('Alguma das Senhas esta incorreta, insira novamente')
        this.pass = 0;
        setTimeout(() => {
          this.pass = 1;
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
      console.log(this.pass);
    },

    async sendForm() {
  if (this.pass === 1) {
    alert('Usuário Cadastrado');
    const user = {
  nome: this.nome,
  email: this.email,
  password: this.password,
};

    try {
      const response = await SendUser(user);
      console.log('Resposta da API:', response);
      console.log('Dados do usuário:', this.user); // Ajuste aqui para exibir os dados corretos
    } catch (error) {
      console.error('Erro ao cadastrar usuário:', error);
      // Trate o erro, se necessário
    }
  } else {
    this.pass = 0; // Corrija a condição para verificar se this.pass não é igual a 0
  }
}

  },
};
</script>


<style>
@keyframes moveUpDown {
  0% {
    opacity: 0;
    transform: translateY(0);
  }
  5%, 10% {
    opacity: 1; /* Aparece */
    transform: translateY(0); /* Mantém na posição inicial */
  }
  20% {
    opacity: 1; /* Aparece */
    transform: translateY(40px); /* Desce 200px */
  }
  30%, 90% {
    opacity: 1; /* Aparece */
    transform: translateY(40px); /* Mantém por 8 segundos (16s * 0.5 a 1.5) */
  }
  100% {
    opacity: 0; /* Desaparece */
    transform: translateY(0);
  }
}

#modal {
  display: flex;
  justify-content: center;
  width: 100vw;
  height: 100vh;
  position: absolute;
    z-index: 100;
}

.info-modal {
  position: relative;
  opacity: 0;
  animation: moveUpDown 8s ease-in-out 1;
  margin-right:65vw;
}

.error h2 {
  font-size: 20px;
}
.error p {
  margin-top: 10px;
  font-size: 13px;
}


.img-modal {
  background-image: url('../assets/images/modal.png');
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  width: 50px;
  height: 50px;
}

.info-modal {
  background-color: rgb(255, 255, 255);
  width: 15vw;
  height: 10vh;
  border-radius: 10px;
  position: absolute;
}

.icon {
  height: 8vh;
  display: flex;
}
.line {
  background-color: red;
  height: 2vh;
  border-radius: 0px 0px 10px 10px;
}

.ghost {
  width: 6vw;
  height: 8vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

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
    height: 90vh;
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

  .form-floating{
    margin-bottom: 15px;
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
</style>
