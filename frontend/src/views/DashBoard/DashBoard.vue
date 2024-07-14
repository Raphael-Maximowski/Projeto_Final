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

      <div class="modal3" v-if="modal3 == true">
        <div class="base-modal3">
          <div class="return">
            <div class="return-img" @click="toggleModal3"><img src="../../assets/images/DashBoard/return.png"></div>
            <div class="header-info">Informações da Coleção</div>
          </div>
          <div class="main-info">
            <div v-if="edit_collection == false">
              <div class="title_edit_collection">
                Nome Associado a Coleção
              </div>
              <div class="info_edit_collection">
                {{ data_collection[0]}}
              </div>
              <div class="title_edit_collection">Descrição Associada a Coleção</div>
              <div class="info_edit_collection">
                <p>{{ data_collection[1] }}</p>
                <div style="margin-top: 15px; display: flex" class="title_edit_collection">
                  Cor Associada a Coleção
                  <div class="box-color"></div>
                </div>
                <div class="edit_collection" @click="edit_collectionfn">Editar</div>
                <div class="delete"  @click="DeleteCollection"><p>Excluir Coleção</p></div>
              </div>

            </div>
            <form v-if="edit_collection == true">
              <div>
                <label>Nome Associado a Coleção</label>
                <br><input type="text" v-model="update_name_collection">
              </div>
              <div>
                <label>Descrição Associada a Coleção<br></label>
                <div class="textarea-container">
                  <textarea id="message" name="message" placeholder="Digite sua mensagem aqui..." v-model="update_desc_collection">{{ update_desc_collection }}</textarea>
                </div>
              </div>
              <div class="color-colection">
                <div><label>Cor Associada a Coleção</label></div>
                <div class="box-color"></div>
              </div>
              <div class="edit_collection" @click="UpdateCollection">Atualizar</div>
              <div class="delete" @click="DeleteCollection"><p>Excluir Coleção</p></div>
            </form>
          </div>
        </div>
      </div>

      <div class="modal3" v-if="modal4 == true">
        <div class="base-modal3">
          <div class="return">
            <div class="return-img" @click="toggleModal4"><img src="../../assets/images/DashBoard/return.png"></div>
            <div class="header-info">Informações do Funil</div>
          </div>
          <div class="main-info">
            <div v-if="edit_funil == false">
              <div class="title_edit_collection">
                Nome Associado ao Funil
              </div>
              <div class="info_edit_collection">
                Vendas Chinelo
              </div>
              <div class="title_edit_collection">Descrição Associada ao Funil</div>
              <div class="info_edit_collection">
                <p>O funil de vendas será utilizado para vender nossa plataforma de gestão de projetos, impulsionando o reconhecimento da marca, engajamento dos leads e conversão em clientes leais. Este funil é essencial para otimizar nossas estratégias de marketing e vendas, garantindo que cada etapa do processo seja eficaz e direcionada.</p>
                <div style="margin-top: 15px; display: flex" class="title_edit_collection">
                  Cor Associada ao Funil
                  <div class="box-color"></div>
                </div>
                <div class="edit_collection" @click="edit_funilfn">Editar</div>
                <div class="delete"><p>Excluir Funil</p></div>
              </div>

            </div>
            <form v-if="edit_funil == true">
              <div>
                <label>Nome Associado ao Funil</label>
                <br><input type="text" value="Novas Vendas">
              </div>
              <div>
                <label>Descrição Associada ao Funil<br></label>
                <div class="textarea-container">
                  <textarea id="message" name="message" placeholder="Digite sua mensagem aqui...">O funil de vendas será utilizado para vender nossa plataforma de gestão de projetos, impulsionando o reconhecimento da marca, engajamento dos leads e conversão em clientes leais. Este funil é essencial para otimizar nossas estratégias de marketing e vendas, garantindo que cada etapa do processo seja eficaz e direcionada.</textarea>
                </div>
              </div>
              <div class="color-colection">
                <div><label>Cor Associada ao Funil</label></div>
                <div class="box-color"></div>
              </div>
              <div class="edit_collection" @click="edit_funilfn">Atualizar</div>
              <div class="delete"><p>Excluir Funil</p></div>
            </form>
          </div>
        </div>
      </div>

    <MenuDash/>
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
          <div v-for="collection in collections"><Collection :collection="collection" @ShowFunil="ActiveFunil" @values_collection="DataCollection" @update-modal2="updateModal2" :modal3="modal3" @update-modal3="updateModal3" /></div>
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
export default {
  components: {CreateModal, MenuDash, Collection, Funil },
  computed:
      {
        ...mapState({
          id_user: state => state.user.id
        })
      },
  data() {
    // Parametros que serão passados ao BackEnd e Validações
    return {
      modal: false,
      activecollection: false,
      modal2: false,
      modal3: false,
      modal4: false,
      edit_collection: false,
      edit_funil: false,

      // Dados Collection
      collection_name: "",
      collection_desc: "",
      collection_color: "",
      collections: [],
      data_collection: [],

      // Update Collection
      update_name_collection: "",
      update_desc_collection: "",
      update_color_collection: "",
    };
  },

  // Validando Email
  methods: {
    closeModal(){
      this.modal = false
      this.activecollection = false
    },
    async DeleteCollection() {
      const data = {
        id : this.data_collection[3],
      }

      const response = DeleteCollection(data);
      return response;
    },
    async UpdateCollection(){
      const data = {
        id: this.data_collection[3],
        name: this.update_name_collection,
        description: this.update_desc_collection,
        user_id : this.id_user,
        color: 'teste'
      }
      this.edit_collection = false;
      this.modal3 = false;
      const response = await UpdateCollection(data);
      console.log(response);
      window.location.reload();

    },
    DataCollection(value){
      this.data_collection = value
      this.update_name_collection =  this.data_collection[0];
      this.update_desc_collection = this.data_collection[1];
      this.update_color_collection = this.data_collection[2]
    },
    async GetCollection()
    {
      const data = {
        id :  this.id_user
      }

      const response = await GetCollection(data);
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

    PushProfile(){
      this.$router.push('/UserProfile');
    },
    ActiveModal()
    {
      this.activecollection = true
      this.modal = true
      console.log(this.activecollection)
    },
    ActiveFunil(){
      this.activecollection = false
      this.modal = true
    },

    updateModal2(newValue) {
      this.modal2 = newValue;
    },

    toggleModal3() {
      this.modal3 = !this.modal3;
    },
    updateModal3(newValue) {
      this.modal3 = newValue;
    },

    toggleModal4()
    {
      this.modal4 =  !this.modal4;
    },
    updateModal4(newValue) {
      this.modal4 =  newValue;
    },

    edit_collectionfn()
    {
      this.edit_collection =  !this.edit_collection
    },
    edit_funilfn()
    {
      this.edit_funil = !this.edit_funil;
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