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
      >
        <template #item="{element}">
          <ContatoCard/>
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
import {GetContacts} from "@/services/HttpService.js";

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
      cards: [

      ]
    }
  },
  methods: {
    async GetContact(){
      const data = {
        id: this.dados.id
      }
      const response = await GetContacts(data)
      console.log(response.data)
      return response;
    }
  },

  created(){
    this.GetContact()
  }
}
</script>