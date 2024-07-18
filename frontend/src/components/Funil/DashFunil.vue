<template>
  <div class="row">
    <div class="col-8">
      <table class="table table-striped">
        <thead class="thead-dark">
        <draggable v-model="headers" tag="tr" :item-key="key => key" handle=".line">
          <template #item="{ element: header }">
            <th scope="col">
              <Etapa :data="header"></Etapa>
            </th>
          </template>
        </draggable>
        </thead>
      </table>
    </div>
  </div>
</template>

<script>
import draggable from 'vuedraggable';
import Etapa from "@/components/Funil/Etapa.vue";
import index from "vuex";
import {GetFunnel} from "@/services/HttpService.js";
export default {
  name: "DashFunil",
  computed: {
    index() {
      return index
    }
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
    };
  },
  methods: {
    async GetFunnels(){
      const response = await GetFunnel();
      this.data = response.data
      for (let i = 0; i < this.data.length; i++){
        this.headers.push(this.data[i])
      }
      console.log(this.headers)
      return response;
    },

  },
  created(){
    this.GetFunnels()
  }
};
</script>
<style scoped>
th {
  width: 100px;
}
</style>