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
        <div><p v-if="dadoscontact == null && !team" style="margin-left: 16vw" @click="SendContact">Criar Contato</p></div>
        <div><p v-if="dadoscontact != null  && !team" style="margin-left: 14vw" @click="UpdateContact">Atualizar Contato</p></div>
        <div><p v-if="team" @click="SendData">Criar Time</p></div>
      </div>


      <div class="body">
        <div class="contentbody">
          <div class="base" v-if="!team">
            <div class="title" v-if="!edit_name && !team" @click="ActiveEditName">
              {{ name_expose }}
            </div>

            <div class="input" v-if="edit_name" >
              <input type="text" v-model="name">
              <div class="confirm">
                <img @click="CloseName" width="13px" src="../../assets/images/Funil/cancel.png">
                <img @click="SaveName" width="16px" src="../../assets/images/Funil/confirm.png">
              </div>
            </div>
            <hr>
            <div class="basecontent" v-if="!team">
              <div>
                <p>{{ nomefunil }}</p>
              </div>
              <div class="funil">
                <div id="border1" >Sem Etapa</div>
                <div class="etapa">Prospecção</div>
                <div class="etapa">Contato</div>
                <div id="border2">Proposta</div>
              </div>
            </div>
          </div>
          <div class="base"  v-if="!team">
            <div style="display: flex">
              <div v-if="!contato" @click="opencontato" style="margin-top: 14px; margin-left: 15px"><img style="transform: rotate(90deg); cursor: pointer" width="13px" src="../../assets/images/Funil/seta.png"></div>
              <div v-if="contato" @click="opencontato" style="margin-top: 14px; margin-left: 15px"><img style="transform: rotate(270deg); cursor: pointer" width="13px" src="../../assets/images/Funil/seta.png"></div>
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
          <div class="base" v-if="!team">
            <div style="display: flex">
              <div v-if="!dados" @click="opendados" style="margin-top: 14px; margin-left: 15px; cursor: pointer"><img style="transform: rotate(90deg);" width="13px" src="../../assets/images/Funil/seta.png"></div>
              <div v-if="dados" @click="opendados" style="margin-top: 14px; margin-left: 15px"><img style="transform: rotate(270deg); cursor: pointer" width="13px" src="../../assets/images/Funil/seta.png"></div>
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
                <div class="titlecontact">Nascimento:</div>
                <div @click="ActiveDate" v-if="!edit_date" class="contentcontact">{{ date_expose }}</div>
                <div v-if="edit_date" class="contentcontact">
                  <input v-model="date">
                  <div class="confirm-little">
                    <img @click="CloseDate" width="13px" height="13px" src="../../assets/images/Funil/cancel.png">
                    <img @click="SaveDate" width="16px" height="16px"  src="../../assets/images/Funil/confirm.png">
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
          <div v-if="team">
            <div class="base"  v-if="team">
              <div style="display: flex">
                <div v-if="!activeteam" @click="StateTeam" style="margin-top: 14px; margin-left: 15px"><img style="transform: rotate(90deg); cursor: pointer" width="13px" src="../../assets/images/Funil/seta.png"></div>
                <div v-if="activeteam" @click="StateTeam" style="margin-top: 14px; margin-left: 15px"><img style="transform: rotate(270deg); cursor: pointer" width="13px" src="../../assets/images/Funil/seta.png"></div>
                <div class="title">Dados Time</div>
              </div>
              <div v-if="activeteam" class="basecontent">
                <div class="contato">
                  <div class="titlecontact">Nome:</div>
                  <div @click="ActiveNameTeam" v-if="!edit_nameteam"  class="contentcontact">{{ nometeam_expose }}</div>
                  <div v-if="edit_nameteam" class="contentcontact">
                    <input v-model="nometeam">
                    <div class="confirm-little">
                      <img @click="CloseNameTeam" width="13px" height="13px" src="../../assets/images/Funil/cancel.png">
                      <img @click="SaveNameTeam" width="16px" height="16px" src="../../assets/images/Funil/confirm.png">
                    </div>
                  </div>
                </div>
                <div class="contato">
                  <div class="titlecontact">Descrição:</div>
                  <div @click="ActiveDescTeam" v-if="!edit_descteam" class="contentcontact">{{ descteam_expose }}</div>
                  <div v-if="edit_descteam" class="contentcontact">
                    <input v-model="descteam">
                    <div class="confirm-little">
                      <img @click="CloseDescTeam" width="13px" height="13px" src="../../assets/images/Funil/cancel.png">
                      <img @click="SaveDescTeam" width="16px" height="16px" src="../../assets/images/Funil/confirm.png">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="base"  v-if="team">
              <div style="display: flex">
                <div v-if="!activecompany" @click="StateCompany" style="margin-top: 14px; margin-left: 15px"><img style="transform: rotate(90deg); cursor: pointer" width="13px" src="../../assets/images/Funil/seta.png"></div>
                <div v-if="activecompany" @click="StateCompany" style="margin-top: 14px; margin-left: 15px"><img style="transform: rotate(270deg); cursor: pointer" width="13px" src="../../assets/images/Funil/seta.png"></div>
                <div class="title">Dados da Empresa</div>
              </div>
              <div v-if="activecompany" class="basecontent">
                <div class="contato">
                  <div class="titlecontact">Nome:</div>
                  <div @click="ActiveNameCompany" v-if="!edit_namecompany"  class="contentcontact">{{ namecompany_expose }}</div>
                  <div v-if="edit_namecompany" class="contentcontact">
                    <input v-model="namecompany">
                    <div class="confirm-little">
                      <img @click="CloseNameCompany" width="13px" height="13px" src="../../assets/images/Funil/cancel.png">
                      <img @click="SaveNameCompany" width="16px" height="16px" src="../../assets/images/Funil/confirm.png">
                    </div>
                  </div>
                </div>
                <div class="contato">
                  <div class="titlecontact">Razão social:</div>
                  <div @click="ActiveRazao" v-if="!edit_razao" class="contentcontact">{{ razao_expose }}</div>
                  <div v-if="edit_razao" class="contentcontact">
                    <input v-model="razao">
                    <div class="confirm-little">
                      <img @click="CloseRazao" width="13px" height="13px" src="../../assets/images/Funil/cancel.png">
                      <img @click="SaveRazao" width="16px" height="16px" src="../../assets/images/Funil/confirm.png">
                    </div>
                  </div>
                </div>
                <div class="contato">
                  <div class="titlecontact">CNPJ:</div>
                  <div @click="EditCnpj" v-if="!edit_cnpj" class="contentcontact">{{ cnpj_expose }}</div>
                  <div v-if="edit_cnpj" class="contentcontact">
                    <input v-model="cnpj">
                    <div class="confirm-little">
                      <img @click="CloseCnpj" width="13px" height="13px" src="../../assets/images/Funil/cancel.png">
                      <img @click="SaveCnpj" width="16px" height="16px" src="../../assets/images/Funil/confirm.png">
                    </div>
                  </div>
                </div>
                <div class="contato">
                  <div class="titlecontact">Inscrição estadual:</div>
                  <div  style="margin-top: 10px" @click="EditInscri" v-if="!edit_inscri" class="contentcontact">{{ insc_expose }}</div>
                  <div v-if="edit_inscri" class="contentcontact">
                    <input style="margin-top: 10px" v-model="insc">
                    <div class="confirm-little">
                      <img  style="margin-top: 10px" @click="CloseInscri" width="13px" height="13px" src="../../assets/images/Funil/cancel.png">
                      <img  style="margin-top: 10px" @click="SaveInscri" width="16px" height="16px" src="../../assets/images/Funil/confirm.png">
                    </div>
                  </div>
                </div>
                <div class="contato">
                  <div class="titlecontact">Data de fundação:</div>
                  <div  style="margin-top: 10px" @click="EditFund" v-if="!edit_fund" class="contentcontact">{{ fund_expose }}</div>
                  <div v-if="edit_fund" class="contentcontact">
                    <input  style="margin-top: 10px" v-model="fund">
                    <div class="confirm-little">
                      <img  style="margin-top: 10px" @click="CloseFund" width="13px" height="13px" src="../../assets/images/Funil/cancel.png">
                      <img  style="margin-top: 10px" @click="SaveFund" width="16px" height="16px" src="../../assets/images/Funil/confirm.png">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="delete" v-if="dadoscontact != null" @click="DeleteContact">
            <div><img src="../../assets/images/Funil/lixeira.png"></div>
            <div>Excluir Contato</div>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {
  CreateCompany,
  CreateTeam,
  DeleteContact,
  GetOneStep,
  SendContact,
  UpdateInfoContact
} from "@/services/HttpService.js";
import {mapGetters} from "vuex";

export default {
  name: 'ModalContato',
  props: {
    id : {type:Number},
    nomefunil: {type:String},
    dadoscontact: {type:Object},
    team:{type:Boolean}
  },
  data(){
    return{
      contato : false,
      dados: false,
      activeteam : false,
      activecompany: false,
      edit_name : false,
      name: "",
      number: "",
      email: "",
      cpf : "",
      date : "",
      addres: "",
      value : "",
      size : "",
      nometeam : "",
      descteam: "",
      namecompany: "",
      razao : "",
      cnpj : "",
      insc : "",
      fund : "",
      name_expose: "Nome do Contato",
      number_expose: "Adicionar Numero",
      email_expose : "Adicionar E-mail",
      cpf_expose : "000.000.000-00",
      date_expose : "DD/MM/AAAA",
      addres_expose : "-",
      value_expose : "0,00",
      nometeam_expose: "Nome do Time",
      descteam_expose : "Descrição do Time",
      namecompany_expose : "Nome da Empresa",
      razao_expose : "Razão Social da Empresa",
      cnpj_expose : "00.000.000/0001-00",
      insc_expose : "000.000.000",
      fund_expose : "DD/MM/AAAA",
      edit_number : false,
      edit_email : false,
      edit_cpf : false,
      edit_date : false,
      edit_addres : false,
      edit_value : false,
      edit_nameteam : false,
      edit_descteam : false,
      edit_namecompany : false,
      edit_razao : false,
      edit_cnpj : false,
      edit_inscri : false,
      edit_fund : false,
      // Nome time - Desc time - Nome Empresa -  Razao - CNPJ - Inscri - Fund
    }
  },
  methods: {
    async UpdateContact(){
      const data = {
        'id' : this.dadoscontact.id,
        'name' : this.name,
        'phone' : this.number,
        'email' : this.email,
        'cpf' : this.cpf,
        'data_de_nascimento' : this.date,
        'endereco' : this.addres,
        'value' : this.value,
      }
      const response =  await UpdateInfoContact(data)
      window.location.reload();
      return response
    },
    async DeleteContact(){
      const data = this.dadoscontact.id
      const response = await DeleteContact(data)
      return response;
    },
    CloseModal(){
      this.$emit('CloseModal')
      this.$emit('returnteam')
      this.SetNullFunil()
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
      if (this.dadoscontact != null) {
        this.name_expose = this.dadoscontact.name
      }
      this.edit_name = !this.edit_name
    },
    ActiveEditNumber(){
      this.edit_number = !this.edit_number
    },
    CloseNumber(){
      this.edit_number = !this.edit_number
      this.number_expose = "Adicionar Numero"
      if (this.dadoscontact != null){
        this.number_expose = this.dadoscontact.phone
      }
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
      if (this.dadoscontact != null) {
        this.email_expose = this.dadoscontact.email
      }
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
      if (this.dadoscontact != null) {
        this.cpf_expose = this.dadoscontact.cpf
      }
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
      if (this.dadoscontact != null) {
        this.date_expose =  this.dadoscontact.data_de_nascimento}
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
      if (this.dadoscontact != null) {
        this.addres_expose = this.dadoscontact.endereco
      }
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
      if (this.dadoscontact != null) {this.value_expose = this.dadoscontact.value}
    },
    SaveValue(){
      this.edit_value = !this.edit_value
      this.value_expose =  this.value
    },
    ActiveNameTeam(){
      this.edit_nameteam = !this.edit_nameteam
    },
    CloseNameTeam(){
      this.edit_nameteam = !this.edit_nameteam
      this.nometeam_expose = "Nome do Time"
    },
    SaveNameTeam(){
      this.edit_nameteam = !this.edit_nameteam
      this.nometeam_expose =  this.nometeam
    },
    ActiveDescTeam(){
      this.edit_descteam = !this.edit_descteam
    },
    CloseDescTeam(){
      this.edit_descteam = !this.edit_descteam
      this.descteam_expose = "Descrição do Time"
    },
    SaveDescTeam(){
      this.edit_descteam = !this.edit_descteam
      this.descteam_expose = this.descteam
    },
    ActiveNameCompany(){
      this.edit_namecompany = !this.edit_namecompany
    },
    CloseNameCompany(){
      this.edit_namecompany = !this.edit_namecompany
      this.namecompany_expose = "Nome da Empresa"
    },
    SaveNameCompany(){
      this.edit_namecompany = !this.edit_namecompany
      this.namecompany_expose = this.namecompany
    },
    ActiveRazao(){
      this.edit_razao =  !this.edit_razao
    },
    CloseRazao(){
      this.edit_razao =  !this.edit_razao
      this.razao_expose = "Razão Social da Empresa"
    },
    SaveRazao(){
      this.edit_razao =  !this.edit_razao
      this.razao_expose = this.razao
    },
    EditCnpj(){
      this.edit_cnpj =  !this.edit_cnpj
    },
    CloseCnpj () {
      this.edit_cnpj =  !this.edit_cnpj
      this.cnpj_expose ="00.000.000/0001-00"
    },
    SaveCnpj(){
      this.edit_cnpj =  !this.edit_cnpj
      this.cnpj_expose =  this.cnpj
    },
    EditInscri(){
      this.edit_inscri = !this.edit_inscri
    },
    CloseInscri(){
      this.edit_inscri = !this.edit_inscri
      this.insc_expose = "000.000.000"
    },
    SaveInscri(){
      this.edit_inscri = !this.edit_inscri
      this.insc_expose = this.insc
    },
    EditFund(){
      this.edit_fund = !this.edit_fund
    },
    CloseFund(){
      this.edit_fund = !this.edit_fund
      this.fund_expose = "DD/MM/AAAA"
    },
    SaveFund(){
      this.edit_fund = !this.edit_fund
      this.fund_expose = this.fund
    },
    async SaveTeam(){
      const data = {
        'name' : this.nometeam,
        'description' : this.descteam,
        'admin_id' : this.user_id
      }
      const response = await CreateTeam(data);
      const getdata =  response.data;
      const id =  getdata.id
      this.$emit('IdTeam', id)
      console.log('Evento Emitido')
      return response;
    },
    async SaveCompany(){
      const data = {
        'nome' : this.namecompany,
        'razao' : this.razao,
        'cnpj' : this.cnpj,
        'inscri_estadual' : this.insc,
        'fundacao' : this.fund,
        'admin_id' : this.user_id
      }
      const response = await CreateCompany(data);
      return response;
    },
    SendData(){
      this.SaveCompany().then(() => {
        this.SaveTeam();
      })

    },

    async GetSize(){
      const response = await GetOneStep(this.id)
      const datastep = response.data;
      this.size = datastep.contacts
      return response;
    },
    async SendContact(){
      await this.GetSize();
      const data = {
        'posicao' : (this.size.length) + 1,
        'name' : this.name,
        'phone' : this.number,
        'email' : this.email,
        'cpf' : this.cpf,
        'data_de_nascimento' : this.date,
        'endereco' : this.addres,
        'value' : this.value,
        'step_id' : this.id
      }
      const response =  await SendContact(data);
      window.location.reload();
      return response;
    },
    SetNullFunil(){
      this.$emit('SetNull');
    },
    StateTeam(){
      this.activeteam =  !this.activeteam
    },
    StateCompany(){
      this.activecompany =  !this.activecompany
    }
  },
  created() {
    if (this.dadoscontact != null) {
      this.name_expose = this.dadoscontact.name
      this.name = this.dadoscontact.name
      this.number_expose = this.dadoscontact.phone
      this.number = this.dadoscontact.phone
      this.email_expose = this.dadoscontact.email
      this.email = this.dadoscontact.email
      this.cpf_expose = this.dadoscontact.cpf
      this.cpf = this.dadoscontact.cpf
      this.date_expose =  this.dadoscontact.data_de_nascimento
      this.date = this.dadoscontact.data_de_nascimento
      this.addres_expose = this.dadoscontact.endereco
      this.addres = this.dadoscontact.endereco
      this.value_expose = this.dadoscontact.value
      this.value = this.dadoscontact.value
    }
  },
  computed: {
    ...mapGetters(['user_id']),
  },
}
</script>

<style scoped>
.delete {
  margin-top: 30px;
  background-color: #e1e9f4;
  display: flex;
  color: #677c92;
  font-weight: bold;
  padding: 6px;
  border-radius: 10px;
  justify-content: center;
  font-size: 15px;
  cursor: pointer;
}

.delete img {
  width: 17px;
  margin-right: 20px;
}



input:focus {
  outline: none;
}

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
  margin-top: 9px;
  margin-left: 24.5vw;
  cursor: pointer;

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
  margin-top: 13px;
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
  cursor: pointer;
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
  transform: rotate(0deg);
  position: absolute;
  cursor: pointer;
}

.header p {
  background-color: blue;
  color: white;
  padding: 5px 33px;
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

.body {

  height: 620px;
}

@keyframes slideInFromRight {
  from {
    opacity: 0;
    transform: translateX(5px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.content {
  background-color: #f9fafc;
  z-index: 2000;
  width: 40vw;
  border-radius: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
  animation: slideInFromRight 0.5s ease forwards;
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
