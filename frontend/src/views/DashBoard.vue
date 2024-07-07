<template>
<main>

    <!-- Menu -->
    <div class="menu">
        <div class="colection" v-if="this.modal == false">
            <div class="content">
                <div class="title">
                    <div style="display:flex">
                        <div>
                            <h3>Configurando Coleção</h3>
                            <p>Preencha os Dados e em Poucos segundo utilize seu Funil</p>
                            <hr>
                        </div>
                        <div class="cancel">
                            <img @click="ActiveModal" src="../assets/images/DashBoard/cruz.png" alt="">
                        </div>
                    </div>
                </div>
                    <div class="form">
                        <div class="form-floating mb-3">
                        <input type="name" class="form-control" id="floatingInput" autocomplete="off" v-modal="email">
                        <label for="floatingInput">Nome da Coleção</label>
                        </div>
                        <div class="form-floating mb-3">
                        <input type="name" class="form-control" id="floatingInput" autocomplete="off" v-modal="email">
                        <label for="floatingInput">Descrição da Coleção</label>
                        </div>
                        <div class="color">
                            <div
                            ><p>Insira a cor referencial da sua Coleção</p></div>
                            <div class="choosecolor"><input type="color" id="colorPicker" name="colorPicker" value="#FEBB25">
                            </div>
                        </div>
                        <div class="submit">Criar</div>

                    </div>
                </div>
        </div>
        <div class="img">
         <img src="../assets/images/logoamarelo.png" alt="">
        </div>
        <div class="dashboard">
            <div class="border"></div>
            <img src="../assets/images/DashBoard/dashboard.png" alt="">
        </div>
        <div class="user">
            <img src="../assets/images/DashBoard/user.png" alt="">
        </div>
        <div class="logout">
            <img src="../assets/images/DashBoard/sair.png" alt="">
        </div>
    </div>

    <!-- Main -->
    <div class="principal">
        <!-- Welcome / Create / Modal -->
        <div class="header">
            <div class="welcome">
                <h1>Bem vindo ao seu Customer Relationship Management</h1>
                <p>Comece criando sua coleção</p>
            </div>
            <div class="create" @click="ActiveModal"><p>Nova Coleção</p></div>
        </div>
        <!-- Funil Por meio de Componentes -->
        <div class="funis">
        </div>
        
    </div>

</main>
</template>

<style scoped>

* {
    margin: 0;
    padding: 0;
    font-family: Arial, Helvetica, sans-serif;
}
main {
    background-color: #F9FAFC;
    width: 100vw;
    height: 100vh;
    display: flex;
    overflow: hidden;

}

.menu {
    height: 100vh;
    width: 60px;
    background-color: white;
     transition: width 0.3s ease;
    border-right: 2px solid #E1E9F4;
}

.img img {
    width: 60px;
}

.dashboard {
    width: 60px;
    padding: 15px 0px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.dashboard img {
    width: 20px;
    position: absolute;
}
.user {
    width: 60px;
    padding: 30px 0px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.user img {
    width: 20px;
        position: absolute;
}
.logout {
    width: 60px;
    padding: 30px 0px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.logout img {
    width: 20px;
        position: absolute;
}

.border {
    height: 20px;
    width: 15px;
    padding: 15px 0px;
    border-radius: 0px 10px 10px 0px;
    background-color: #FFBB28;
    margin-right: 4.3vw;
}

.principal {
    width: 95.7vw;
}

.header {
    width: 95.7vw;
    height: 60px;
}

.header {
    display: flex;
}

.welcome {
    width: 75vw;
}

.welcome h1 {
    font-size: 20px;
    margin-left: 3vw;
    margin-top: 10px;
    color: #222738;
}
.welcome p {
    margin-left: 3vw;
    font-size: 15px;
        color: #222738;
}
.create {
    width: 20.7vw;
    display: flex;
    justify-content: center;
    align-items: center;
}

.create p {
    background-color: #3053F2;
    padding: 5px 15px;
    border-radius: 8px;
    color: white;
    font-size: 13px;
}

.colection {
    background: rgba(0, 0, 0, 0.384);
    position: absolute;
    z-index: 3;
    width: 100vw;
    height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;

}

.content {
    width: 50vw;
    background-color: rgba(255, 255, 255, 0.905);
    height: 53vh;
    filter: blur(0px);
    border-radius: 10px;
     box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
}

.title {
    margin-left: 2vw;
    margin-right: 2vw;
    display: flex;
}

.title img {
    width: 30px;
}

.title h3 {
    margin-top: 10px;
    margin-bottom: 5px;
    font-size: 20px;
    font-weight: bold;
}

.title p {
    font-size: 15px;
    margin-bottom: 10px;
}

 #floatingInput, #floatingPassword{
    height: 6vh;
    width: 30vw;
    min-height: 30px;
    border-radius: 5px;
    border: 1px solid lightgrey;
    font-size:10px
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


   .form-control:focus {
    box-shadow: none; 
  } 

  .color {
    display: flex;
    font-size: 12px;
  }

.color p {
    margin-top: 5px;
}

  .form {
    margin-left: 2vw;
    margin-top: 20px;
  }

  .choosecolor {
    margin-left: 20px;
  }

.submit {
    margin-top: 15px;
    background-color: #FFBB28;
    color: white;
    text-align: center;
    width: 10vw;
    padding: 2px 0px;
    border-radius: 10px;
}

input {
    font-size: 10px;
}

.form-floating > label[data-v-df256515] {
    padding-top: 8px;
    font-size: 12px;
    padding-left: 10px;
    background-color: rgba(0, 0, 0, 0);
    color: grey;
}

.cancel {
    padding-top: 10px;
    margin-left: 12vw;
}
</style>

<script>
export default {
  data() {
    // Parametros que serão passados ao BackEnd e Validações
    return {
        modal: false
    };
  },

  // Validando Email
  methods: {
    ActiveModal()
    {
        this.modal = !this.modal
        console.log(this.modal)
    }
  }
};
</script>
