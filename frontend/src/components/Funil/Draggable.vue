<template>
  <main>
    <div class="dash">
      <div class="row">
        <div class="col-8">
          <table class="table table-striped">
            <thead class="thead-dark">
            <draggable
                v-model="headers"
                tag="tr"
                :item-key="key => key" handle=".line"
                animation="350">

              <template #item="{ element: header }">
                <th scope="col">
                  <Etapa @ActiveContact="ActiveContact" :dados="header"></Etapa>
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
import {GetFunnel, GetOneFunnel, GetSteps} from "@/services/HttpService.js";
import { mapGetters } from "vuex";
export default {
  name: "DashFunil",
  computed: {
    ...mapGetters(['funnel_id']),
  },
  display: "Table Column",
  order: 9,
  components: {
    Etapa,
    draggable
  },
  data() {
    return {
      headers: [],
      dragging: false,
      data: [],
      returndata: {},
      senddata : [],
      default : [],
      id : ""
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
    },
    SetHeaders(){
      for (let i = 0; i < this.returndata.length; i++){
        if (this.returndata[i].name === "Sem etapa"){
          this.default.push(this.returndata[i]);
          for (let i = 0; i < this.default.length; i++){
            this. id = this.default[i].id
          }
        }
        this.headers.push(this.returndata[i]);
        this.senddata.push(this.returndata[i].id)
      }
      this.$emit('ReceiveIdPost', this.id)
    },
    ActiveContact(value){
      const newdatamain = value
      this.$emit('ActiveContactMain', newdatamain);
    }
  },
  created(){
    this.SendData().then(() => {
      this.SetHeaders();
    })
  }
};
</script>

<style scoped>
.dash {
  width: 90vw;
  height: 85vh;
  overflow-y: auto;
  z-index: 0
}

main {
  width: 95.5vw;
  height: 91.3vh;
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>
