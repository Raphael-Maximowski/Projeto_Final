<template>
  <div class="teste" v-if="dados.dados.name !='EmptyStep'">
    <div class="line" :style="{ backgroundColor: dadosfunilstep.color, opacity: dados.opacity}"></div>
    <div class="content">
      <div v-if="edit" class="title"> <div>{{dados.dados.name}}</div><img @click="ActiveEdit"  src="../../assets/images/Funil/editar.png"></div>
      <div v-if="!edit" class="title">
        <div style="display: flex">
          <input type="text" v-model="name">
          <div class="images">
            <img @click="UpdateStep" width="8px" src="../../assets/images/Funil/tick.png">
            <img @click="ActiveEdit" src="../../assets/images/Funil/remove.png">
          </div>
        </div>
        <img @click="DeleteStep" src="../../assets/images/Funil/delete.png"> </div>
    </div>
    <div class="cards">
      <draggable
          v-model="cards"
          group="cards"
          item-key="id" 
          animation="350"
          @change="event=> log(event, dados.dados.id)"
      >
        <template #item="{element}">
          <div>
            <ContatoCard @OpenCreate="OpenCreate" :size="size" v-if="cards.length !== 0" @ActiveContactEtapa="ActiveContact" :dadoscontact="element"/>
          </div>

        </template>
      </draggable>
    </div>
  </div>
  <div v-if="dados.dados.name =='EmptyStep'"><NewStep :id_funnel="id_funnel" :dadosfunilstep="dadosfunilstep" @ActiveFromStep="ActiveFromStep"/></div>

</template>
<style scoped>
.images {
  position: absolute;
  display: flex;
  margin-bottom: 10px;
  margin-left: 8.2vw;

  height: 10px;
}

input {
  width: 12vw;
  height: 27px;
  border-radius: 5px;
  border: 1px solid grey;
  padding: 10px;
  font-size: 13px;
}

.cards {
  display: flex;
  justify-content: center;
}
.title {
  font-size: 18px;
  font-weight: bold;
  display: flex;
  justify-content: space-between;
}

.title img {
  margin-top: 6px;
  width: 19px;
  height: 19px;
  margin-right: 10px;
  cursor: pointer;
}

.content {
  margin: 10px 15px 10px 15px;
}
.line {
  width: 250px;
  height: 10px;
  border-radius: 50px;
  z-index: 1;
  cursor: pointer;
}
.teste {
  width: 250px;
  height: 79.9vh;
  overflow-y: auto;

}
</style>
<script>
import ContatoCard from "@/components/Funil/Contato.vue";
import draggable from 'vuedraggable';
import {
  DeleteStep,
  GetContacts, GetListContacts,
  UpdateLastStep,
  UpdateNewStep,
  UpdateOwnStep,
  UpdateStepInfo
} from "@/services/HttpService.js";
import {mapGetters} from "vuex";
import Funil from "@/components/DashBoard/Funil.vue";
import SearchBar from "@/components/DashBoard/SearchBar.vue";
import NewStep from "@/components/Funil/CreateEtapa.vue";

export default {
  name: 'etapa',
  components: {NewStep, SearchBar, Funil, ContatoCard, draggable},
  props: {
    dados: {
      type:Object
    },
    dadosfunilstep: {
      type:Object
    },
    id_funnel: {
    }

  },
  computed:{
    ...mapGetters([
      'colors'
    ])
  },
  data(){
    return{
      cards: [],
      object: [],
      data: {},
      key: [],
      evt: {},
      datacontact : {},
      datacontactold: {},
      datacontactnew: {},
      idcontact : "",
      lastStep: "",
      lastPos: "",
      evtremove: {},
      lastId: null,
      newId: null,
      edit: true,
      name : null,
      size : null

    }
  },
  methods: {
    async GetContact(){
      const data = {
        id: this.dados.dados.id
      }
      const response = await GetContacts(data)
      const GetData = response.data
      this.size = GetData.length
      console.log(this.size)
      for (let i = 0; i < GetData.length; i++){
        this.cards.push(GetData[i])
      }
      return response;
    },
    OpenCreate(){
      this.$emit('OpenCreate');
      console.log('Saiu da Etapa')
    },

    log: function(evt, id) {
      this.key = Object.keys(evt)
      this.evt = evt
      console.log(evt, id)

      if (this.key[0] === 'moved') {
        this.evt = evt
        this.idcontact = this.evt.moved.element.id
        this.lastId = id
        this.Moved()
      }  else if (this.key[0] === 'removed'){
        if (this.size === 2) {
          this.size = 1
        }
        this.idcontact = this.evt.removed.element.id
        this.lastId = id
        this.evt = evt
        this.Removed()

      } else if (this.key[0] === "added") {
        this.evt = evt
        this.newId = id
        this.idcontact = this.evt.added.element.id
        console.log('id', this.idcontact)
        this.Added();
      }
    },
    async Moved(){
      this.datacontact = {
        'id' : this.idcontact,
        'posicao' : this.evt.moved.newIndex + 1,
        'step_id' : this.lastId
      }
      const response =  await UpdateOwnStep(this.datacontact)
      return response
    },
    async Removed(){
      const pos = this.evt.removed.oldIndex + 1
      this.datacontact = {
        'id' : this.idcontact,
        'posicao' : pos,
        'step_id' : this.lastId
      }
      const response = await UpdateLastStep(this.datacontact)
      return response
    },
    async Added(){
      if (this.size == 1){
        this.size = 2
      }
      const pos = this.evt.added.newIndex + 1
      this.datacontact = {
        'id' : this.idcontact,
        'newStep_id' : this.newId,
        'newPosition' : pos
      }
      const response = await UpdateNewStep(this.datacontact)
      return response
    },
    ActiveContact(value){
      const newdata =  value
      this.$emit('ActiveContact', newdata);
    },
    ActiveFromStep(){
      this.$emit('ActiveFromStep');
    },
    ActiveEdit(){
      this.edit = !this.edit
    },
    async DeleteStep(){
      const data = {
        'id' : this.dados.dados.id,
      }
      const response = DeleteStep(data)
      return response
    },
    async UpdateStep(){
      const data = {
        'id' : this.dados.dados.id,
        'name' :  this.name
      }
      const response = UpdateStepInfo(data)
      return response;
    },


  },

  created(){
    this.GetContact()
    this.name = this.dados.dados.name
    console.log(this.size)
  }
}
</script>