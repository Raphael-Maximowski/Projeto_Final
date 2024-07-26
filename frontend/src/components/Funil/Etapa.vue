<template>
  <div class="teste" v-if="dados.dados.name !='EmptyStep'">
    <div class="line" :style="{ backgroundColor: dadosfunilstep.color, opacity: dados.opacity}"></div>
    <div class="content">
      <div class="title"> <div>{{dados.dados.name}}</div></div>
    </div>
    <div class="cards">
      <draggable
          v-model="cards"
          group="cards"
          item-key="id"
          drag-class="drag"
          ghost-class="ghost"
          animation="350"
          @change="event=> log(event, dados.dados.id)"
      >
        <template #item="{element}">
          <div>
            <ContatoCard v-if="cards.length !== 0" @ActiveContactEtapa="ActiveContact" :dadoscontact="element"/>
          </div>

        </template>
      </draggable>
    </div>
  </div>
  <div v-if="dados.dados.name =='EmptyStep'"><NewStep :dadosfunilstep="dadosfunilstep" @ActiveFromStep="ActiveFromStep"/></div>

</template>
<style scoped>

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
  width: 27px;
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
import {GetContacts, UpdateLastStep, UpdateNewStep, UpdateOwnStep} from "@/services/HttpService.js";
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
      idcontact : "",
      lastStep: "",
      lastPos: "",
      evtremove: {},
      lastId: null,
      newId: null

    }
  },
  methods: {
    async GetContact(){
      const data = {
        id: this.dados.dados.id
      }
      const response = await GetContacts(data)
      const GetData = response.data
      for (let i = 0; i < GetData.length; i++){
        this.cards.push(GetData[i])
      }
      return response;
    },

    log: function(evt, id) {
      this.key = Object.keys(evt)
      this.evt = evt

      if (this.key[0] === 'moved') {
        this.evt = evt
        this.idcontact = this.evt.moved.element.id
        this.Moved()
      }  else if (this.key[0] === 'removed'){
        this.idcontact = this.evt.removed.element.id
        this.lastId = id
        this.evt = evt
        this.Removed()

      } else if (this.key[0] === "added") {
        this.evt = evt
        this.newId = id
        this.idcontact = this.evt.added.element.id
        this.Added()
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
      const pos = this.evt.added.newIndex + 1
      const newId = this.lastId
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
    }

  },

  created(){
    this.GetContact()
  }
}
</script>