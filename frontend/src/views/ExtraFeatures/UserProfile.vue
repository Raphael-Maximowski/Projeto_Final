<template>
  <main>
    <chat v-if="chat" @CloseChat="active_chat"/>
    <div><MenuDash  @active_chat="active_chat"/></div>
    <div class="content">
      <div class="profilecontent">
        <div class="photo">
          <div class="imgphoto"></div>
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
  margin-top: 3.5vw;
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
  width: 32vw;
  display: flex;
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
import {GetLogs, GetUserProfile} from "@/services/HttpService.js";
import {mapGetters, mapMutations} from "vuex";
import CardLogs from "@/components/ExtraFeatures/CardLogs.vue";
import Chat from "@/components/ExtraFeatures/Chat.vue";

export default defineComponent({
  components: {Chat, CardLogs, MenuDash},
  data(){
    return {
      dados: {},
      chat: false,
      datas: []
    }
  },
  methods: {
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
      console.log('SizeFinalData', this.datas.length)
      return response;
    }

  },
  created(){
    this.GetUser().then(() => {
      this.GetLogsUsers();
    })
  },
  computed: {
    ...mapGetters(['user_profile']),
  },
})
</script>