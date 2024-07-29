<template>
  <div class="main">
    <ModalContato
        v-if="team == true"
        :team = team
        @returnteam="returnteam"
    />
    <div><MenuDash/></div>
    <div class="content">
      <div class="welcome">
        <div class="title">
          <h1>Team CRM 3C+</h1>
          <p>Configure seus times de forma dinamica</p>
        </div>
        <div class="create"><p style="color: white; font-size: 17px; font-weight: normal" @click="ActiveModal">Criar Team</p></div>
      </div>
      <div class="main-content">
        <div class="content1">a</div>
        <div class="content2">
          <div class="list">
            <div class="headerlist">Usuarios Inseridos no seu Time</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
.headerlist {
  background-color: #FEBC28;
  height: 40px;
  color: white;
  font-size: 16px;
  font-weight: bold;
  border-radius: 6px 6px 0px 0px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.list {
  height: 80vh;
  border: 2px solid #FEBC28;
  width: 30vw;
  border-radius: 10px;
}

.content1 {
  width: 48.05vw;
  background-color: grey;
}
.content2{
  width: 48.05vw;
  background-color: white;
  display: flex;
  align-items: center;
  justify-content: center;
}


.main-content {
  background-color: red;
  width: 96.1vw;
  height: 88.4vh;
  display: flex;
}
.title {
  width: 73vw
}
.create {
  margin-top: 10px;
  height: 70px;
  width: 26.2vw;
  display: flex;
  justify-content: center;
  align-items: center;
}

.create p {
  background-color: blue;
  padding: 5px 40px;
  border-radius: 10px;
}
.main {
  display: flex;
  overflow: hidden;
}
.welcome {
  width: 54vw;
  display: flex;

  padding-top: 5px;
  width: 100vw;
}

.welcome h1 {
  font-size: 20px;
  margin-left: 3vw;

  color: #222738;
  font-weight: bold;
}
.welcome p {
  margin-left: 3vw;
  font-size: 15px;
  color: #222738;
  font-weight: bold;
}

.content {
  width: 100vw;
  height: 100vh;
  background-color: #F9FAFC;
}

</style>
<script>
import {defineComponent} from "vue";
import MenuDash from "@/components/DashBoard/Menu.vue";
import CadastroTeam from "@/components/ExtraFeatures/CadastroTeam.vue";
import ModalContato from "@/components/Funil/CreateContact.vue";

export default defineComponent({
  components: {ModalContato, CadastroTeam, MenuDash},
  data(){
    return{
      team: false
    }
  },
  methods: {
    ActiveModal(){
      this.team = !this.team
    },
    returnteam(){
      this.team = !this.team
    }
  }
})
</script>