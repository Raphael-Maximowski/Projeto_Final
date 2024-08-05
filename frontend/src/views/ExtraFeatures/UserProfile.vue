<template>
  <main>
    <chat v-if="chat" @CloseChat="active_chat"/>
    <div><MenuDash  @active_chat="active_chat"/></div>
    <div class="content">
      <Blocker v-if="team == null && admin == 0"/>
      <div class="profilecontent">
        <div class="photo">
          <div class="imgphoto"></div>
          <div class="inputphoto">
            <input type="file" >
            <p>Insira sua Foto</p>
          </div>
        </div>

        <div class="infouser">
          <div class="block1user">
            <div class="flexuser">
              <div class="titleinfo">Nome: </div>
              <div class="contentinfo">{{ dados.user.name }}</div>
            </div>
            <div class="flexuser">
              <div class="titleinfo">Cargo: </div>
              <div class="contentinfo" v-if="dados.user.is_admin == 1">Gestor</div>
              <div class="contentinfo" v-if="dados.user.is_admin != 1">Colaborador</div>
            </div>
            <div class="flexuser">
              <div class="titleinfo">Email: </div>
              <div class="contentinfo">{{ dados.user.email }}</div>
            </div>
            <div class="flexuser">
              <div class="titleinfo">Status: </div>
              <div class="contentinfo">Indefinido</div>
            </div>
          </div>
          <div class="block2user">
            <p style="font-weight: bold">Emblemas Adquiridos</p>
            <p>Em Breve  </p>
          </div>
        </div>
      </div>
      <div class="contentlogs">
        <div class="headerlogs">
          <h3>Registro de Logs do Usuario(a)</h3>
          <div class="logscontent">
            <div  v-for="data in datas">
              <CardLogs :data="data"/>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>
</template>
<style scoped>
.inputphoto {
  width: 13vw;
  display: flex;
  justify-content: center;
  text-align: center;
}
.inputphoto input{
  position: absolute;
  font-size: 12px;
  margin-left: 70px;
  margin-top: 30px;
  z-index: 2;
  opacity: 0;
}

.inputphoto p {
  margin-top: 30px;
  padding: 5px 10px;
  border-radius: 5px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  background-color: #FEBC28;
  position: absolute;
  width: 10vw;
}

.imgphoto input {
  font-size: 30px;
  width: 10vw;
  height: 10vh;
}

.emblemas {
  height: 220px;
  width: 25vw;
  border-radius: 10px;
  background-color: grey;
}

.emblemas p {
  margin: 10px 20px;
}
.block2user {
  width: 30vw;
}

.block2user img {
  width: 200px;
  border-radius: 10px;
}

.block2user  p {
  margin-top: 13px;
}
.block1user {

  width: 30vw;
}
.flexuser {
  display: flex;
  margin-left: 20px;
  margin-top: 15px;
}

.titleinfo {
  font-weight: bold;
  margin-right: 10px;
}

.infouser{
  border: 2px solid lightgray;
  height: 250px;
  width: 57.5vw;
  margin-top: 6vw;
  border-radius: 10px;
  display: flex;
}
.imgphoto {
  background-color: white;
  width:250px;
  height: 250px;
  border-radius: 50%;
  border: 3px solid #FEBC28;

}
.photo {
  width: 23vw;
  margin-top: 7%;
  margin-left: 10%;
  align-items: center;
  justify-content: center;
}
.logscontent {
  border: 2px solid #FEBC28;
  width: 85vw;
  height: 200px;
  overflow-y: auto;
  border-radius: 0px 0px 10px 10px;
  display: flex;
  flex-wrap: wrap;
}

h3 {
  background-color: #FEBC28;
  margin: 0;
  font-size: 17px;
  padding: 5px 20px;
  border-radius: 10px 10px 0px 0px;
  color: white;
  font-weight: bold;
}
.contentlogs {

  height: 50vh;
  display: flex;
  justify-content: center;
  align-items: center;
}
.profilecontent {

  height: 50vh;
  display: flex;
}
main {
  display: flex;
  }

.content {
  background-color: #F9FAFC;
  width: 100vw;
  height: 100vh;
}
</style>
<script>

import {defineComponent} from "vue";
import MenuDash from "@/components/DashBoard/Menu.vue";
import {GetLogs, GetPhoto, GetUserProfile, UploadPhoto} from "@/services/HttpService.js";
import {mapGetters, mapMutations} from "vuex";
import CardLogs from "@/components/ExtraFeatures/CardLogs.vue";
import Chat from "@/components/ExtraFeatures/Chat.vue";
import Blocker from "@/components/Blocker.vue";

export default defineComponent({
  components: {Blocker, Chat, CardLogs, MenuDash},
  data(){
    return {
      dados: {},
      chat: false,
      datas: [],
      photo: "",
      fileName: "",
      returnpicture : ""
    }
  },
  methods: {
    async onFileChange(event) {
      const file = event.target.files[0];
      if (file) {
        this.photo = file;
        this.fileName = file.name;

        let formData = new FormData();
        formData.append('photo', this.photo);

        try {
          const response = await this.uploadPhoto(formData);
          console.log('Foto enviada com sucesso:', response);
        } catch (error) {
          console.error('Erro ao enviar a foto:', error.response ? error.response.data : error);
        }
      }
    },
    async uploadPhoto(formData) {
      return await UploadPhoto(formData);

    },
    async GetUser(){
      const data = {
        id: this.user_profile
      }
      const response = await GetUserProfile(data)
      this.dados = response.data
      return response;
    },
    active_chat(){
      this.chat = !this.chat
    },
    async GetUserPhoto() {
      try {
        const data = this.user_id;
        const response = await GetPhoto(data);

        let photoUrl = response.data.photo_url;

        if (photoUrl) {
          // Corrige barras invertidas na URL
          photoUrl = photoUrl.replace(/\\/, '/');
          // Define a URL da foto
          this.returnpicture = photoUrl;
        } else {
          this.returnpicture = null;
        }

        console.log(this.returnpicture); // Verifique a URL da foto no console
        this.errorMessage = '';
      } catch (error) {
        console.error('Erro ao buscar a foto:', error);
        this.errorMessage = error.response ? error.response.data.message : 'Erro desconhecido';
        this.returnpicture = null;
      }
    },
    async GetLogsUsers(){
      const response = await GetLogs()
      const temporatydata =  response.data

      for (let i = 0; i < temporatydata.logs.length; i++){
        if (this.dados.user.id === temporatydata.logs[i].user_id){
          const object = {
            'log' : temporatydata.logs[i],
            'Step' : temporatydata.steps[i]
          }
          this.datas.push(object)
        }
      }
      return response;
    }

  },
  created(){
    this.GetUser().then(() => {
      this.GetLogsUsers();
    })
    this.GetUserPhoto()
  },
  computed: {
    ...mapGetters(['user_profile', 'team', 'admin', 'user_id']),
  },
})
</script>