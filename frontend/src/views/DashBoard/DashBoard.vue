<template>
<main>
  <Alert :pass="pass" :errors="errors" />
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
            @Error = "Error"
            :id_collection="id_collection"
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
          @Error="Error"
      />

    <div class="z-index">
      <MenuDash/>
    </div>

    </div>
    <div class="principal">

        <div class="header">
            <div class="welcome">
                <h1>Bem vindo ao seu Customer Relationship Management</h1>
                <p>Comece criando sua coleção</p>
            </div>
          <div><SearchBar/></div>
            <div class="create" v-if="admin == 1" @click="ActiveModal"><p>Nova Coleção</p></div>
        </div>
      <div class="outer">
          <div class="funis">
            <div v-for="collection in collections.collections">
              <Collection
                  :collection="collection"
                  :resync="resync"
                  @ShowFunil="ActiveFunil"
                  @values_collection="DataCollection"
                  @OpenModal="ShowInfo"
                  @ResetResync="ResetResync"
              />
            </div>
          </div>
          <div class="page" >
            <div class="center-page" v-if="sizepages.length > 4">
              <div v-if="collections.current_page > 1" class="changepage" @click="PaginationBack"><p>Anterior</p></div>
              <div v-if="collections.current_page > 1 && collections.current_page < collections.total_pages" class="changepage" @click="PaginationSkip"><p>Proxima</p></div>
              <div style="margin-left: 83vw" v-if="collections.current_page == 1 && collections.current_page < collections.total_pages" class="changepage" @click="PaginationSkip"><p>Proxima</p></div>
            </div>
          </div>
        </div>
      </div>

</main>
</template>

<script>
import Collection from '../../components/DashBoard/Collection.vue';
import Funil from '../../components/DashBoard/Funil.vue';
import CreateModal from '../../components/DashBoard/CreateModal.vue';
import {
  GetCollection, GetFunnel,
  GetUser,
  SendCollection,
  SendFunnel,
  Pagination,
} from "@/services/HttpService.js";
import { mapState, mapMutations, mapGetters } from 'vuex';
import MenuDash from "@/components/DashBoard/Menu.vue";
import InfoModal from "@/components/DashBoard/InfoModal.vue";
import Alert from "@/components/Login/Alert.vue";
import collection from "@/components/DashBoard/Collection.vue";
import SearchBar from "@/components/DashBoard/SearchBar.vue";
import Blocker from "@/components/Blocker.vue";
export default {
  computed: {
    collection() {
      return collection
    }, 
    ...mapGetters(["admin"]),
  },
  components: {Blocker, SearchBar, Alert, InfoModal, CreateModal, MenuDash, Collection, Funil },
  data() {
    return {
      modal: false,
      OpenModal: false,
      showinfo: false,
      activecollection: false,
      edit_collection: false,
      edit_funil: false,
      id_collection: "",
      collections: {},
      funnels: {},
      data_collection: [],
      page: 1,
      sizepages: 0,
      resync: false,
      pass : true,
      errors: [],

    };
  },

  methods: {
    Error(value){
      this.pass = false
      this.errors[0] = value
      setTimeout(() => {
        this.pass = true;
        this.errors = [];
      }, 8000);
    },
    ResetResync(){
      this.resync =  false
    },
    closeModal(){
      this.modal = false
      this.activecollection = false
    },
    ActiveFunil(value){
      this.id_collection = value
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
      this.page = 1
      const response = await Pagination(this.page);
      this.collections = response.data
      console.log(this.collections)
      this.sizepages = this.collections.collections
      return response
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
      console.log('user', response.data)
      this.updateUserId(response.data.id);
      this.updateUserName(response.data.name);
      this.updateUserEmail(response.data.email);
      this.updateUserValidate(response.data.email_verified_at);
      this.updateUserCreated(response.data.created_at);
      this.updateTeam(response.data.team_id);
      this.UpdateAdmin(response.data.is_admin)
    },

    async PaginationSkip()
    {
      this.page++
      const response = await Pagination(this.page);
      this.collections = response.data
      this.resync =  true;
      return response
    },

    async PaginationBack()
    {
      this.page--
      const response = await Pagination(this.page);
      this.collections = response.data
      this.resync =  true;
      return response
    },


    ...mapMutations(['updateUserId','updateUserName','updateUserEmail','updateUserValidate','updateUserToken','updateUserCreated', 'updateTeam', 'UpdateAdmin'])

  },
  created() {
    this.GetCollection()
    this.ShowUser();
  },
};
</script>
<style scoped>
.z-index {
  z-index: 2;
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
  z-index: 2;
}

.header {
    width: 95.7vw;
    height: 60px;
}

.header {
    display: flex;
}

.welcome {
    width: 54vw;
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
  cursor: pointer;
}

.page {
  padding: 0px 0px 50px 0px;
  display: flex;
  justify-content: center;
}


.outer {
  height: 95vh;
  overflow-y: auto; /* Permitir rolagem no eixo Y */
  overflow-x: hidden; /* Ocultar rolagem no eixo X */
}

.center-page {
  width: 89.6vw;
  display: flex;
  justify-content: space-between;
}



.changepage p{
  background-color: #3053F2;
  padding: 5px 20px;
  color: white;
  border-radius: 10px;
  cursor: pointer;
}

.changepage p:hover{
  background-color: #2336C7;
  padding: 5px 20px;
  color: white;
  border-radius: 10px;
  cursor: pointer;
}
</style>