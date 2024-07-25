<template>
  <div class="teste">
    <div class="line"></div>
    <div class="content">
      <div class="title"> {{dados.name}} </div>
    </div>
    <div class="cards">
      <draggable
          v-model="cards"
          group="cards"
          item-key="id"
          drag-class="drag"
          ghost-class="ghost"
          animation="350"
          @change="event=> log(event, dados.id)"
      >
        <template #item="{element}">
          <ContatoCard @ActiveContactEtapa="ActiveContact" :dadoscontact="element"/>

        </template>
      </draggable>
    </div>
  </div>
</template>
<style scoped>

.cards {
  display: flex;
  justify-content: center;
}
.title {
  font-size: 18px;
  font-weight: bold;
}
.content {
  margin: 10px 15px 10px 15px;
}
.line {
  background-color: rgba(255, 186, 39, 0.55);
  width: 250px;
  height: 10px;
  border-radius: 50px;
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

export default {
  name: 'etapa',
  components: {ContatoCard, draggable},
  props: {
    dados: {
      type:Object
    },
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
        id: this.dados.id
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
    }

  },

  created(){
    this.GetContact()
  }
}
</script>