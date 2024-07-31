<template>
  <main>
    <div class="dash">
      <div class="row">
        <div class="col-8">
          <table class="table table-striped">
            <thead class="thead-dark" v-if='dadosfunil != ""'>
            <draggable
                v-model="headers"
                tag="tr"
                :item-key="key => key" handle=".line"
                animation="350"
                @change="event=> log(event)"
            >
              <template #item="{ element: header }">
                <th scope="col">
                  <Etapa :id_funnel="id_funnel" @ActiveFromStep="ActiveFromStep" :dadosfunilstep="dadosfunil" @ActiveContact="ActiveContact" :dados="header"></Etapa>
                </th>
              </template>
            </draggable>
            </thead>
          </table>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
import draggable from 'vuedraggable';
import Etapa from "@/components/Funil/Etapa.vue";
import {GetFunnel, GetOneFunnel, GetSteps, UpdateStepPosition} from "@/services/HttpService.js";
import { mapGetters } from "vuex";
import NewStep from "@/components/Funil/CreateEtapa.vue";
export default {
  name: "DashFunil",
  computed: {
    ...mapGetters(['funnel_id']),
  },
  display: "Table Column",
  order: 9,
  components: {
    NewStep,
    Etapa,
    draggable
  },
  props: {
    dadosfunil: {type:Object}
  },
  data() {
    return {
      headers: [],
      dragging: false,
      data: [],
      returndata: {},
      senddata : [],
      default : [],
      id : "",
      newdata: {},
      id_funnel : null,
      size : null
    };
  },
  methods: {
    async SendData(){
      const data = {
        id : this.funnel_id
      }
      const response = await GetSteps(data);
      this.$emit('ReceiveId', data.id)
      this.returndata =  response.data;
      this.size = this.returndata.length
    },
    SetHeaders(){
      const porcentage = (100 / this.returndata.length) / 70
      let opacity = 0

      for (let i = 0; i < this.returndata.length; i++){
        if (this.returndata[i].name === "Sem etapa"){
          this.default.push(this.returndata[i]);
          for (let i = 0; i < this.default.length; i++){
            this. id = this.default[i].id
          }
        }

        opacity = opacity + porcentage
        this.returndata[i] = {
          'dados' : this.returndata[i],
          'opacity' : opacity
        }
        this.headers.push(this.returndata[i]);
        this.senddata.push(this.returndata[i].id)
      }
      this.$emit('ReceiveIdPost', this.id)
    },
    ActiveContact(value){
      const newdatamain = value
      this.$emit('ActiveContactMain', newdatamain);
    },
    log: function(evt) {
      const pos = (evt.moved.newIndex) + 1
      console.log('ID FUNNEL', evt.moved.element.dados.id)
      this.newdata = {
        'id' : evt.moved.element.dados.id,
        'posicao' : pos,
        'funnel_id' : evt.moved.element.dados.funnel_id,
      }
      this.SendDataStep()
    },
    async SendDataStep(){
      const response =  await UpdateStepPosition(this.newdata)
      return response;
    },
    ActiveFromStep(){
      this.$emit('ActiveFromStep');
    }
  },
  created(){
    this.SendData().then(() => {
      this.SetHeaders();
      this.id_funnel = {
        'id' : this.funnel_id,
        'size' : this.size
      }
    })
  }
};
</script>

<style scoped>
.dash {
  width: 90vw;
  height: 85vh;
  z-index: 0;
  display: flex;
  overflow-y: auto;
}

main {
  width: 95.5vw;
  height: 91.3vh;
  display: flex;
  justify-content: center;
  align-items: center;
  overflow-y: auto;
}
</style>