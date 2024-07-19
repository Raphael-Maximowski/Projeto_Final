<template>
  <div class="body">
    <div class="line"></div>
    <div class="info">
      Teste
      <div class="img"><img src="../../assets/images/Funil/mais.png"></div>
    </div>
    <div class="col-6">
      <draggable
          :list="dados"
          :disabled="!enabled"
          item-key="Nome"
          class="list-group"
          ghost-class="ghost"
          :move="checkMove"
          @start="dragging = true"
          @end="dragging = false"
      >
        <template #item="{ element }">
          <div >
            <Contato :dados="element"/>
          </div>
        </template>
      </draggable>
    </div>
  </div>
</template>

<style>
.info{
  display: flex;
  margin-top: 10px;
  justify-content: space-between;
  padding: 0px 10px;
  font-weight: bold;
}

.img {
  background-color: #4b5563;;
  height: 25px;
  width: 25px;
  border-radius: 5px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.info img {
  width: 20px;
}
.line{
  background-color: #4b5563;
  width: 250px;
  height: 10px;
  border-radius: 20px;
  cursor: pointer;
}
.body {

  background-color: #ededef;
  overflow-x: auto;
  font-weight: lighter;

}
</style>
<script>
import draggable from 'vuedraggable';
import Contato from "@/components/Funil/Contato.vue";
let id = 1;
export default {

  components: {
    Contato,
    draggable
  },
  data() {
    return {
      enabled: true,
      dados: [
        { Nome: "Raphael", Price: "1235" },
        { Nome: "Pedro", Price: "1099" },
        { Nome: "João", Price: "5097" },
        { Nome: "Claudio", Price: "12.410" }
      ],
      dragging: false
    };
  },
};
</script>