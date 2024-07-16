<template>
<main>

    <div class="menu">
      <div v-if="modal">
        <CreateModal
            @closeModal="closeModal"
            title="Configurando Coleção"
            content="Preencha os dados e em crie sua coleção"
            header="Nome da Coleção"
            secondheader="Descrição da Coleção"
            :activecollection="activecollection"
            title2="Configurando Funil"
            content2="Preencha os Dados e em Poucos segundo utilize seu Funil"
            header2="Nome do Funil"
            thidheader="Descrição do Funil"
            @SendData="SendData"
        />

      </div>

      <InfoModal
          :data_collection="data_collection"
          @CloseModal="CloseInfo" v-if="OpenModal"
          main1="Informações da Coleção"
          main2="Informações do Funil"
          title1="Nome Associado a Coleção"
          title2="Nome Associado ao Funil"
          description1="Descrição Associada a Coleção"
          description2="Descrição Associada ao Funil"
      />

    <MenuDash/>
    </div>


    <div class="principal">
        <div class="header">
            <div class="welcome">
                <h1>Bem vindo ao seu Customer Relationship Management</h1>
                <p>Comece criando sua coleção</p>
            </div>
            <div class="create" @click="ActiveModal"><p>Nova Coleção</p></div>
        </div>
        <div class="funis">
          <div v-for="collection in collections"><Collection :collection="collection" @ShowFunil="ActiveFunil" @values_collection="DataCollection" @OpenModal="ShowInfo" /></div>
        </div>
    </div>

</main>
</template>

<script>
import Collection from '../../components/DashBoard/Collection.vue';
import Funil from '../../components/DashBoard/Funil.vue';
import CreateModal from '../../components/DashBoard/CreateModal.vue';
import {
  DeleteCollection,
  GetCollection,
  GetUser,
  SendCollection,
  SendFunnel,
  UpdateCollection
} from "@/services/HttpService.js";
import { mapState, mapMutations } from 'vuex';
import MenuDash from "@/components/DashBoard/Menu.vue";
import InfoModal from "@/components/DashBoard/InfoModal.vue";
export default {
  components: {InfoModal, CreateModal, MenuDash, Collection, Funil },
  computed:
      {
        ...mapState({
          id_user: state => state.user.id
        })
      },
  data() {
    return {
      modal: false,
      OpenModal: false,
      showinfo: false,
      activecollection: false,
      edit_collection: false,
      edit_funil: false,

      collections: [],
      data_collection: [],

    };
  },

  // Validando Email
  methods: {
    closeModal(){
      this.modal = false
      this.activecollection = false
    },
    ActiveFunil(){
      this.activecollection = false
      this.modal = true
    },
    CloseInfo(){
      this.OpenModal = false;
    },

    DataCollection(value){
      this.data_collection = value
    },

    ShowInfo(value){
      if (value[4] === true){
        this.OpenModal = true;
      }
      this.data_collection = value;
    },

    async GetCollection()
    {
      const response = await GetCollection();
      this.collections = response.data;
    },
    async SendData(value){
      const data = value
      if (data.type === true)
      {
        const response = await SendCollection(data);
        return response;
      } else {
        const response = await SendFunnel(data);
        return response;
      }
    },

    ActiveModal()
    {
      this.activecollection = true
      this.modal = true
    },

    async ShowUser()
    {
      const response = await GetUser();
      this.updateUserId(response.data.id);
      this.updateUserName(response.data.name);
      this.updateUserEmail(response.data.email);
      this.updateUserValidate(response.data.email_verified_at);
      this.updateUserCreated(response.data.created_at);
    },
    ...mapMutations(['updateUserId','updateUserName','updateUserEmail','updateUserValidate','updateUserToken','updateUserCreated'])

  },
  created() {
    this.ShowUser();
    this.GetCollection();
  },
};
</script>


<style scoped>
.delete {
  width: 26vw;
  height: 40vh;
  display: flex;
  justify-content: center;
  align-items: end;
}
.delete p {
  background-color: red;
  padding: 5px 50px;
  border-radius: 10px;
  color: white;
  font-weight: bold;
}
.title_edit_collection {
  margin-bottom: 5px;
  font-size: 17px;
  font-weight: bold;
  color: #333;
}

.info_edit_collection {
  text-align: justify;
  height: 4vh;
  font-size: 15px;
  width: 20vw;
  margin-bottom: 5px;
  color: rgba(0, 0, 0, 0.87);
}



.edit_collection {
  background-color: #FEBC28;
  width: 7vw;
  padding: 3px 5px;
  border-radius: 10px;
  text-align: center;
  font-weight: bold;
}

.color-colection {
  font-size: 17px;
  display: flex;
}

.textarea-container {
  display: flex;
  flex-direction: column;
  width: 20vw;
}
label {
  margin-bottom: 5px;
  font-size: 14px;
  color: #333;
  font-weight: bold;
}
textarea {
  width: 100%;
  height: 165px;
  padding: 10px;
  font-size: 14px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  transition: border-color 0.3s, box-shadow 0.3s;
  white-space: pre-line;
  color: grey;
  margin-bottom: 20px;

}

.main-info label {
  font-size: 17px;
  margin-bottom: 10px;
}


.main-info input {
  height: 4vh;
  font-size: 13px;
  padding-left: 10px;
  width: 20vw;
  margin-bottom: 20px;
  color: grey;
  border: 1px solid #ccc;
  border-radius: 5px;
}
.return img {
  width: 25px;
  margin-left: 25px;
}

.return {
  display: flex;
  padding-top: 10px;
  align-items: center;
}

.return-img
{
  width: 5vw;
  z-index: 999;
}
.header-info {
  position: absolute;
  width: 30vw;
  text-align: center;
  font-size: 18px;
  font-weight: bold;
}

.main-info {
  margin-top: 25px;
  height: 80vh;
  padding-left: 30px;
}

.color-colection {
  display: flex;
  height: 40px;
  align-items: center;
}
.box-color {
  width: 2vw;
  height: 2vw;
  border: 3px solid lightgray;
  border-radius: 50%;
  background-color: #FEBC28;
  margin-left:20px;
}

.modal3 {
  position: absolute;
  background: rgba(0, 0, 0, 0.384);
  width: 100vw;
  height: 100vh;
  display: flex;
  justify-content: end;
  z-index: 1000;
}

.base-modal3 {
  background-color: white;
  width: 30vw;
  height: 100vh;
  border-radius: 10px 0px 0px 10px;

  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
}

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
    font-weight: bold;
}
.welcome p {
    margin-left: 3vw;
    font-size: 15px;
        color: #222738;
        font-weight: bold;
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
    font-size: 17px;
    margin-left: 6vw;
}
</style>