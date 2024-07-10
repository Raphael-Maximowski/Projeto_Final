<template>
<div class="base">
  <div class="info">
    <div class="title">
      <div>Novas Vendas</div>
      <div class="more-info" @click="showinfo"><img src="../assets/images/DashBoard/info.png" alt=""></div>
      </div>
    <div class="crud">
      <div class="funil" @click="showfunil">
        <p>Novo Funil</p>
      </div>
    </div>
  </div>
  <div class="group">
    <Funil/>
    <Funil/>
    <Funil/>
    <Funil/>
    <Funil/>
    <Funil/>
    <Funil/>
    <Funil/>
    <Funil/>
    <Funil/>
  </div>
</div>
</template>
<script>
import Funil from '../components/Funil.vue';
export default {
  components: { Funil },
  name: 'Collection',

  props: {
    modal2: {
      type: Boolean,
      default: false
    },
    modal3: {
      type: Boolean,
      default: false
    }
  },

  data ()
  {
    return {
    }
  },
  methods: {
    showfunil() {
      this.$emit('update-modal2', !this.modal2);
      console.log(this.modal2);
    },
    showinfo()
    {
      this.$emit('update-modal3', !this.modal3);
      console.log(this.modal3);
    }
  }
}
</script>

<style scoped>
.base {
  height: 170px;
  margin: 30px 45px;
  border-radius: 5px;
  border: 2px solid #FEBC28;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
}

h1 {
  font-size: 25px;
  margin-top: 10px;
  margin-left: 20px;
}

.info {
  width: 89.6vw;
  height: 50px;
  display: flex;
  align-items: center;
}

.title {
  height: 50px;
  width: 75vw;
  display: flex;
  align-items: center;
  font-size: 18px;
  font-weight: bold;
  padding-left: 20px
}

.crud {
  height: 50px;
  width: 15vw;
  display: flex;
  justify-content: space-evenly;
  align-items: center;
}

.funil p {
    background-color: #FEBC28;
    padding: 5px 15px;
    border-radius: 8px;
    color: white;
    font-size: 17px;
    margin-top: 17px;
    margin-left: 27px;
}

.title img {
  width: 23px;
  margin-left: 20px;
}

.group {
  display: flex;
  flex-wrap: wrap;
}




</style>
