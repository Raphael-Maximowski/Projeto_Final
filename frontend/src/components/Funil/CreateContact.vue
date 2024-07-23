<template>
  <div class="modalcontato">
    <div class="content">
      <div class="header">
        <div class="displayheader">
          <div @click="CloseModal" class="closemodal" >
            <img src="../../assets/images/Funil/seta.png">
          </div>
          <div><h1>Voltar</h1></div>
        </div>
        <div><p>Criar Contato</p></div>
      </div>
      <div class="body">
        <div class="contentbody">
          <div class="base">
            <div class="title" v-if="!edit_name" @click="ActiveEditName">
              {{ name_expose }}
            </div>
            <div class="input" v-if="edit_name">
              <input type="text" v-model="name">
              <div class="confirm">
                <img @click="CloseName" width="13px" src="../../assets/images/Funil/cancel.png">
                <img @click="SaveName" width="16px" src="../../assets/images/Funil/confirm.png">
              </div>
            </div>
            <hr>
            <div class="basecontent">
              <div>
                <p>Nome do Funil</p>
              </div>
              <div class="funil">
                <div id="border1" >Sem Etapa</div>
                <div class="etapa">Prospecção</div>
                <div class="etapa">Contato</div>
                <div id="border2">Proposta</div>
              </div>
            </div>
          </div>
          <div class="base" >
            <div style="display: flex">
              <div v-if="!contato" @click="opencontato" style="margin-top: 14px; margin-left: 15px"><img style="transform: rotate(90deg);" width="13px" src="../../assets/images/Funil/seta.png"></div>
              <div v-if="contato" @click="opencontato" style="margin-top: 14px; margin-left: 15px"><img style="transform: rotate(270deg);" width="13px" src="../../assets/images/Funil/seta.png"></div>
              <div class="title">Contatos</div>
            </div>
            <div v-if="contato" class="basecontent">
              <div class="contato">
                <div class="titlecontact">Telefone:</div>
                <div @click="ActiveEditNumber" v-if="!edit_number"  class="contentcontact">{{ number_expose }}</div>
                <div v-if="edit_number" class="contentcontact">
                  <input v-model="number">
                  <div class="confirm-little">
                    <img @click="CloseNumber" width="13px" height="13px" src="../../assets/images/Funil/cancel.png">
                    <img @click="SaveNumber" width="16px" height="16px" src="../../assets/images/Funil/confirm.png">
                  </div>
                </div>
              </div>
              <div class="contato">
                <div class="titlecontact">E-mail:</div>
                <div @click="ActiveEmail" v-if="!edit_email" class="contentcontact">{{ email_expose }}</div>
                <div v-if="edit_email" class="contentcontact">
                  <input v-model="email">
                  <div class="confirm-little">
                    <img @click="CloseEmail" width="13px" height="13px" src="../../assets/images/Funil/cancel.png">
                    <img @click="SaveEmail" width="16px" height="16px" src="../../assets/images/Funil/confirm.png">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="base">
            <div style="display: flex">
              <div v-if="!dados" @click="opendados" style="margin-top: 14px; margin-left: 15px"><img style="transform: rotate(90deg);" width="13px" src="../../assets/images/Funil/seta.png"></div>
              <div v-if="dados" @click="opendados" style="margin-top: 14px; margin-left: 15px"><img style="transform: rotate(270deg);" width="13px" src="../../assets/images/Funil/seta.png"></div>
              <div class="title">Dados</div>
            </div>
            <div v-if="dados" class="basecontent">
              <div class="contato">
                <div class="titlecontact">CPF:</div>
                <div v-if="!edit_cpf" class="contentcontact" @click="ActiveCPF"> {{ cpf_expose}}</div>
                <div v-if="edit_cpf" class="contentcontact">
                  <input v-model="cpf">
                  <div class="confirm-little">
                    <img @click="CloseCPF" width="13px" height="13px" src="../../assets/images/Funil/cancel.png">
                    <img @click="SaveCPF" width="16px" height="16px" src="../../assets/images/Funil/confirm.png">
                  </div>
                </div>

              </div>
              <div class="contato">
                <div class="titlecontact">Data de<br>nascimento:</div>
                <div @click="ActiveDate" v-if="!edit_date" class="contentcontact" style="margin-top: 12px">{{ date_expose }}</div>
                <div v-if="edit_date" class="contentcontact">
                  <input v-model="date" style="margin-top: 8px">
                  <div class="confirm-little">
                    <img @click="CloseDate" width="13px" height="13px" style="margin-top: 8px" src="../../assets/images/Funil/cancel.png">
                    <img @click="SaveDate" width="16px" height="16px" style="margin-top: 8px" src="../../assets/images/Funil/confirm.png">
                  </div>
                </div>
              </div>
              <div class="contato">
                <div class="titlecontact">Endereço:</div>
                <div @click="ActiveAddres" v-if="!edit_addres" class="contentcontact"> {{ addres_expose }}</div>
                <div v-if="edit_addres" class="contentcontact">
                  <input v-model="addres" >
                  <div class="confirm-little">
                    <img @click="CloseAddres" width="13px" height="13px"  src="../../assets/images/Funil/cancel.png">
                    <img @click="SaveAddres" width="16px" height="16px"  src="../../assets/images/Funil/confirm.png">
                  </div>
                </div>
              </div>
              <div class="contato">
                <div class="titlecontact">Valor:</div>
                <div @click="ActiveValue" v-if="!edit_value" class="contentcontact">R$ {{value_expose}}</div>
                <div v-if="edit_value" class="contentcontact">
                  <div class="fixed">R$</div>
                  <input v-model="value" style="padding-left: 30px">
                  <div class="confirm-little">
                    <img @click="CloseValue" width="13px" height="13px"  src="../../assets/images/Funil/cancel.png">
                    <img @click="SaveValue" width="16px" height="16px"  src="../../assets/images/Funil/confirm.png">
                  </div>
                </div>

              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'ModalContato',
  data(){
    return{
      contato : false,
      dados: false,
      edit_name : false,
      name: "",
      name_expose: "Nome do Contato",
      edit_number : false,
      number: "",
      number_expose: "Adicionar Numero",
      edit_email : false,
      email: "",
      email_expose : "Adicionar E-mail",
      edit_cpf : false,
      cpf : "",
      cpf_expose : "000.000.000-00",
      edit_date : false,
      date : "",
      date_expose : "DD/MM/AAAA",
      edit_addres : false,
      addres: "",
      addres_expose : "-",
      value : "",
      edit_value : false,
      value_expose : "0,00",

    }
  },
  methods: {
    CloseModal(){
      this.$emit('CloseModal')
    },
    opencontato(){
      this.contato =  !this.contato
    },
    opendados(){
      this.dados =  !this.dados
    },
    ActiveEditName(){
      this.edit_name = !this.edit_name
    },
    SaveName(){
      this.name_expose = this.name
      this.edit_name = !this.edit_name
    },
    CloseName(){
      this.name_expose = "Nome do Contato"
      this.edit_name = !this.edit_name
    },
    ActiveEditNumber(){
      this.edit_number = !this.edit_number
    },
    CloseNumber(){
      this.edit_number = !this.edit_number
      this.number_expose = "Adicionar Numero"
    },
    SaveNumber(){
      this.number_expose = this.number
      this.edit_number = !this.edit_number
    },
    ActiveEmail(){
      this.edit_email =  !this.edit_email
    },
    CloseEmail(){
      this.edit_email = !this.edit_email
      this.email_expose =  "Adicionar E-mail"
    },
    SaveEmail(){
      this.email_expose =  this.email
      this.edit_email = !this.edit_email
    },
    ActiveCPF(){
      this.edit_cpf = !this.edit_cpf
    },
    CloseCPF(){
      this.edit_cpf = !this.edit_cpf
      this.cpf_expose = "000.000.000-00"
    },
    SaveCPF(){
      this.cpf_expose =  this.cpf
      this.edit_cpf = !this.edit_cpf
    },
    ActiveDate(){
      this.edit_date =  !this.edit_date
    },
    CloseDate(){
      this.edit_date =  !this.edit_date
      this.date_expose = "DD/MM/AAAA"
    },
    SaveDate(){
      this.edit_date =  !this.edit_date
      this.date_expose = this.date
    },
    ActiveAddres(){
      this.edit_addres = !this.edit_addres
    },
    CloseAddres(){
      this.edit_addres = !this.edit_addres
      this.addres_expose = "-"
    },
    SaveAddres(){
      this.edit_addres = !this.edit_addres
      this.addres_expose = this.addres
    },
    ActiveValue(){
      this.edit_value = !this.edit_value
    },
    CloseValue(){
      this.edit_value = !this.edit_value
      this.value_expose =  "0,00"
    },
    SaveValue(){
      this.edit_value = !this.edit_value
      this.value_expose =  this.value
    }

  }
}
</script>

<style scoped>
.fixed {
  position: absolute;
  margin-left: 10px;
  margin-top: 3px;
}
.confirm-little {
  display: flex;
  width: 2.7vw;
  justify-content: space-between;
  position: absolute;
  margin-top: 10px;
  margin-left: 24.5vw;

}
.contentcontact {
  display: flex;
}
input {
  width: 28vw;
  height: 30px;
  border-radius: 5px;
  border: 1px solid lightgrey;
  padding: 3px 10px;
  color: #677c92;

}

.confirm img {
  margin: 0px 5px;
  cursor: pointer;
}

.confirm {
  position: absolute;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-top: 17px;
  margin-left: 29.7vw;
  height: 35px;
  width: 5vw;
}
.input {
  display: flex;
}
.input input {
  margin: 15px 20px 15px 20px;
  width: 33.2vw;
  border: 1px solid lightgrey;
  font-size: 17px;
  font-weight: bold;
  border-radius: 5px;
  padding: 5px 10px;
  color: #373753;
}
.contato {
  display: flex;
  margin-bottom: 10px;
}
.titlecontact {
  color: #575778;
  width: 7vw;
  font-size: 14px;
  font-weight: bold;
}

.contentcontact {
  color: #677c92;
  cursor: pointer;

}
#border2 {
  padding: 3px 0px;
  width: 7.8vw;
  background-color: #f4f5f8;
  text-align: center;
  border-radius: 5px 20px 20px 0px;
  display: flex;
  justify-content: center;
  color: grey;
}

#border1 {
  width: 7.8vw;
  background-color: #e1e9f4;
  color: #677c92;;
  text-align: center;
  border-radius: 20px 5px 5px 20px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.etapa {
  background-color: #f4f5f8;
  width: 7.8vw;
  text-align: center;
  border-radius: 5px;
  display: flex;
  justify-content: center;
  align-items: center;
  color: grey;
}
.funil {
  display: flex;
  justify-content: space-between;
  font-size: 13px;
}
.basecontent {
  margin: 10px 20px;
  color: #373753;
}
hr {
  margin: 0px 20px;
  color: gray;
}
.title {
  margin: 15px 0px 15px 20px;
  font-size: 17px;
  font-weight: bold;
  color: #373753;
}

.base {
  background-color: white;
  border: 1px solid lightgray;
  border-radius: 10px;
  margin-top: 10px;
}
.contentbody {
  margin: 0px 2vw;
}
.displayheader {
  display: flex;
}
.displayheader h1  {
  margin-top: 5px;
  font-size: 18px;
  padding-top: 6px;
  margin-left: 6vw;
  color: #373753;
  font-weight: bold;
}
.closemodal {
  margin-top: 2px;
  margin-left: 2vw;
  background-color: white;
  padding: 5px 10px;
  border: 1px solid lightgrey;
  border-radius: 50%;
  transform: rotate(180deg);
  position: absolute;
  cursor: pointer;
}

.header p {
  background-color: blue;
  color: white;
  padding: 5px 40px;
  margin-top: 20px;
  border-radius: 10px;
  margin-right: 2vw;
  cursor: pointer;
}
.header img {
  margin-bottom: 2px;
  width: 13px;
  height: 13px;
}
.header {
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.header {

  height: 70px;
}
.body {

  height: 620px;
}

.content {
  background-color: #f9fafc;
  width: 40vw;
  border-radius: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
}

.modalcontato {
  position: absolute;
  z-index: 2000;
  width: 100vw;
  height: 100vh;
  background: rgba(0, 0, 0, 0.384);
  display: flex;
  justify-content: end;
  overflow-y: hidden;
}

</style>
