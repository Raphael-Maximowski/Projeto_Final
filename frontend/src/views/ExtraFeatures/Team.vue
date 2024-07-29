<template>
  <div class="main">
    <ModalContato
        v-if="team == true"
        :team = team
        @returnteam="returnteam"
    />
    <div><MenuDash/></div>
    <div class="content">
      <div class="welcome1">
        <div class="title1">
          <h1>Team CRM 3C+</h1>
          <p>Configure seus times de forma dinamica</p>
        </div>
        <div class="create"><p style="color: white; font-size: 17px; font-weight: normal" @click="ActiveModal">Criar Team</p></div>
      </div>
      <div class="main-content">
        <div class="content1">
          <div class="centercontent">
            <div class="info1">
              <div class="busca">
                <div class="buscaheader">Adicione um Usuario no seu Time</div>
                <div class="inputsearch"><input placeholder="Insira o e-mail do seu funcionário"></div>
              </div>
            </div>
            <div  class="info2">b</div>
          </div>
        </div>
        <div class="content2">
          <div class="list">
            <div class="headerlist">Usuarios Inseridos no seu Time</div>
            <div class="contentuser">
              <WorkerCards/>
              <WorkerCards/>
              <WorkerCards/>
              <WorkerCards/>
              <WorkerCards/>
              <WorkerCards/>
              <WorkerCards/>
              <WorkerCards/>
              <WorkerCards/>
              <WorkerCards/>
              <WorkerCards/>
              <WorkerCards/>
              <WorkerCards/>
              <WorkerCards/>
            </div>
            <div class="bottomlist"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
input {
  width: 37.3vw;
  margin: 10px 20px;
  padding: 7px 10px;
  border-radius: 5px;
  border: 1px solid lightgray;
  font-size: 13px;
}

input:focus {
  box-shadow: none;
}

.buscaheader {
  background-color: #febc28;
  height: 40px;
  border-radius: 10px 10px 0px 0px;
  display: flex;
  align-items: center;
  padding-left: 15px;
  font-size: 18px;
  color: white;
  font-weight: bold;
}
.info1 {
  height: 40.5vh;
  background-color: red;
}
.info2 {
  height: 40.5vh;
  background-color: blue;
}

.centercontent {
  background-color: white;
  width: 40vw;
  height: 81vh;
}

.contentuser {
  height: 70vh;
  overflow-y: auto;
}

.bottomlist {
  background-color: #FEBC28;
  height: 40px;
  border-radius: 0px 0px 6px 6px;
}

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
  width: 30vw;
  border-radius: 10px;

}

.content1 {
  width: 48.05vw;
  background-color: grey;
  display: flex;
  justify-content: center;
  align-items: center;
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
.title1 {
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
.welcome1 {
  width: 54vw;
  display: flex;

  padding-top: 5px;
  width: 100vw;
}

.welcome1 h1 {
  font-size: 20px;
  margin-left: 3vw;

  color: #222738;
  font-weight: bold;
}
.welcome1 p {
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
import ModalContato from "@/components/Funil/CreateContact.vue";
import WorkerCards from "@/components/ExtraFeatures/WorkerCard.vue";

export default defineComponent({
  components: {WorkerCards, ModalContato, MenuDash},
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