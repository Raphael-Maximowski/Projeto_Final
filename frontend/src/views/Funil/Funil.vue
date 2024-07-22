<template>
  <main>
    <ModalContato v-if="activecontact"
    @CloseModal="CloseModal"
    />
    <div>
      <MenuDash/>
    </div>
    <div>
      <div class="header">
        <div class="name">
          <h1>Funil</h1>
          <p>Name</p>
        </div>
        <div class="buttons">
          <div class="search"><SearchBar/></div>
          <div class="create">
            <div class="background">
              <div class="img"><img src="../../assets/images/Funil/newuser.png"></div>
              <div class="label" @click="CloseModal">Novo Contato</div>
            </div>
          </div>
        </div>
      </div>
      <div>
        <Draggable/>
      </div>
    </div>
  </main>
</template>

<script>
import {defineComponent} from "vue";
import MenuDash from "@/components/DashBoard/Menu.vue";
import SearchBar from "@/components/DashBoard/SearchBar.vue";
import Draggable from "@/components/Funil/Draggable.vue";
import ModalContato from "@/components/Funil/CreateContact.vue";

export default {
  components: {ModalContato, Draggable, SearchBar, MenuDash},
  data(){
    return {
      activecontact : false
    }
  },
  methods: {
    CloseModal(){
      this.activecontact = !this.activecontact
      console.log(this.activecontact)
    }
  }
}
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
}

.name {

  height: 60px;
  width: 50vw;
  padding-left: 15px;
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

  align-items: center;
  height: 60px;
  width: 100vw;
}
</style>
