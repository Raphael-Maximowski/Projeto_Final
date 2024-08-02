<template>
  <main>
    <ModalContato :id="id"
                  v-if="activecontact"
                  @CloseModal="CloseModal"
                  :nomefunil="nomefunil"
                  :dadoscontact="dadoscontact"
                  @SetNull="SetNull"
                  :step="step"
    />
    <div>
      <MenuDash/>
    </div>
    <div>
      <div class="header">
        <div class="name">
          <h1>Funil</h1>
          <p>{{dadosfunil.name}}</p>
        </div>
        <div class="buttons">
          <div class="search"><SearchBar
              :contact="contact"
              @OpenContacts="OpenContacts"
          /></div>
          <div class="create">
            <div class="background">
              <div class="img"><img src="../../assets/images/Funil/newuser.png"></div>
              <div class="label" @click="CloseModal">Novo Contato</div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <Draggable @OpenCreate="OpenCreate" @ActiveFromStep="ActiveFromStep" :dadosfunil="dadosfunil"  @ActiveContactMain="ActiveContactMain" @ReceiveIdPost="ReceiveIdPost" @ReceiveId = "ReceiveId" />
      </div>
    </div>
  </main>
</template>

<script>
import { defineComponent } from "vue";
import MenuDash from "@/components/DashBoard/Menu.vue";
import SearchBar from "@/components/DashBoard/SearchBar.vue";
import Draggable from "@/components/Funil/Draggable.vue";
import ModalContato from "@/components/Funil/CreateContact.vue";
import { mapGetters } from "vuex";
import {GetOneFunnel} from "@/services/HttpService.js";

export default defineComponent({
  components: { ModalContato, Draggable, SearchBar, MenuDash },
  computed: {
    ...mapGetters(['funnel_id']),
  },
  data() {
    return {
      activecontact: false,
      dadosfunil : "",
      id : "",
      nomefunil: "",
      dadoscontact :  null,
      contact: null,
      step: null
    };
  },
  methods: {
    OpenCreate(){
      this.activecontact = !this.activecontact
    },
    OpenContacts() {
      this.activecontact =  true
    },
    SetNull(){
      this.dadoscontact = null
    },
    SearchContact(){
      this.contact = true;
    },
    ActiveContactMain(value){
      this.dadoscontact =  value
      this.activecontact = true
    },
    CloseModal() {
      this.activecontact = !this.activecontact;
    },
    async ReceiveId(value){
      const response = await GetOneFunnel(value)
      this.dadosfunil =  response.data
      this.nomefunil = this.dadosfunil.name
      return response
    },
    ReceiveIdPost(value){
      this.id = value
    },
    ActiveFromStep(){
      this.activecontact = true
      this.step =  true
    }
  },
  created() {
    this.SearchContact()
  }

});
</script>


<style scoped>


.label {

  width: 200px;
  text-align: center;
}
.create{
  margin-top: 5px;
}
.background {
  background-color: blue;
  display: flex;
  justify-content: space-between;
  width: 200px;
  color: white;
  padding: 5px 0px;
  border-radius: 10px;
  cursor: pointer;
}

.background img {
  width: 20px;
  margin-top: 3px;
  margin-left: 14px;
  position: absolute;
}
.search {

  width: 350px;
  height: 60px;
}
.buttons {
  display: flex;
  height: 60px;
  width: 50vw;
  align-items: center;
  margin-left: 5.5vw;
}

.name {
  height: 60px;
  width: 50vw;
  padding-left: 50px;
  display: flex;
}

.name p {
  position: absolute;
  font-size: 22px;
  margin-top: 19px;
}

.name h1 {
  font-size: 15px;
  margin-top: 7px;
}
main {
  display: flex;
  overflow: hidden;
}

.header {
  display: flex;
  z-index: 100000;
  align-items: center;
  height: 60px;
  width: 100vw;
}
</style>
