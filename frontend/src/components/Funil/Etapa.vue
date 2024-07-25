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
import {GetContacts, UpdateOwnStep} from "@/services/HttpService.js";

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

      if (this.key[0] === 'moved') {
        this.evt = evt
        this.idcontact = this.evt.moved.element.id
        this.Moved()
      }  else if (this.key[0] === 'removed'){
        this.evtremove = evt
        console.log(this.evtremove, id)
        this.lastStep = id
        this.lastPos = (this.evtremove.removed.oldIndex) + 1

      } else if (this.key[0] === "added") {
        this.evt = evt
        console.log(this.evt, id)
        this.data = {
          'id' : this.evt.added.element.id,
          'posicao' : this.lastStep,
          'step_id' : this.lastPos,
        }
      }
    },
    async Moved(){
      this.datacontact = {
        'id' : this.idcontact,
        'posicao' : this.evt.moved.newIndex + 1,
        'step_id' : this.evt.moved.element.step_id
      }
      const response =  await UpdateOwnStep(this.datacontact)
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