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
            <div class="title">Nome do Contato</div>
            <hr>
            <div class="basecontent">
              <div><p>Nome do Funil</p></div>
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
                <div class="contentcontact">Adicionar Numero</div>
              </div>
              <div class="contato">
                <div class="titlecontact">E-mail:</div>
                <div class="contentcontact">Adicionar E-mail</div>
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
                <div class="contentcontact">000.000.000-00</div>
              </div>
              <div class="contato">
                <div class="titlecontact">Data de<br>nascimento:</div>
                <div class="contentcontact" style="margin-top: 12px">DD/MM/AAAA</div>
              </div>
              <div class="contato">
                <div class="titlecontact">Endereço:</div>
                <div class="contentcontact">-</div>
              </div>
              <div class="contato">
                <div class="titlecontact">Valor:</div>
                <div class="contentcontact">R$ 0,00</div>
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
      dados: false
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
    }
  }
}
</script>

<style scoped>
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
