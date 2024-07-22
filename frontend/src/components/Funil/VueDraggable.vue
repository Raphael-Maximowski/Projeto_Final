<template>
  <main>
    <div class="content">
      <Contato/>
    </div>
  </main>
</template>
<style scoped>
.content{
  background-color: rgba(255, 0, 0, 0.17);
  height: 80vh;
  width: 90vw;
}
main {
  display: flex;
  justify-content: center;
  align-items: center;
  background-color: rgba(0, 0, 0, 0.14);
  height: 91.8vh;
  width: 96vw;
}

</style>
<script>
import draggable from "vuedraggable";
import Contato from "@/components/Funil/Contato.vue";

export default {
  name: "table-column-example",
  display: "Table Column",
  order: 9,
  components: {
    Contato,
    draggable
  },
  data() {
    return {
      headers: ["id", "name", "sport"],
      list: [
        { id: 1, name: "Abby", sport: "basket" },
        { id: 2, name: "Brooke", sport: "foot" },
        { id: 3, name: "Courtenay", sport: "volley" },
        { id: 4, name: "David", sport: "rugby" }
      ],
      dragging: false
    };
  }
};
</script>>