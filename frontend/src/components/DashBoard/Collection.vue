<template>
<div class="base">
  <div class="info">
    <div class="title">
      <div>{{collection.name}}</div>
      <div class="more-info" @click="showinfo"><img src="../../assets/images/DashBoard/info.png" alt=""></div>
      </div>
    <div class="crud">
      <div class="funil" @click="showfunil">
        <p>Novo Funil</p>
      </div>
    </div>
  </div>
  <div class="group">
  </div>
</div>
</template>
<script>
import Funil from './Funil.vue';
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
    },
    collection: {
      type: Object,
      required: true
    },
  },

  data ()
  {
    return {
      name_collection : '',
      desc_collection: '',
      color_collection: '',
      id_collection: '',
    }
  },
  created() {
    this.name_collection = this.collection.name;
    this.desc_collection = this.collection.description;
    this.color_collection = this.collection.color;
    this.id_collection = this.collection.id;
  },
  methods: {
    showData(){
      const data = [
          this.name_collection,
          this.desc_collection,
          this.color_collection,
          this.id_collection
      ]
      this.$emit('values_collection', data);
    },
    showfunil() {
      console.log('Evento ShowFunil emitido'); // Adicione este log
      this.$emit('ShowFunil');
    },
    showinfo()
    {
      this.$emit('update-modal3', !this.modal3);
      this.showData();
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
  margin-top: 15px;
  height: 50px;
  width: 94vw;
  display: flex;
  align-items: center;
  font-size: 18px;
  font-weight: bold;
  padding-left: 0px
}

.crud {
  height: 50px;
  width: 15vw;
  display: flex;
  justify-content: space-evenly;
  align-items: center;
}

.funil {
  cursor: pointer;
  margin-top: 15px;
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
  margin-bottom: 2px;
}

.group {
  display: flex;
  flex-wrap: wrap;
}

.create h3 {
  font-size: 15px;
  margin-left: 10px;
  margin-top: 15px;
  margin-bottom: 20px;
}

floatingInput{
  height: 1vh;
  width: 5vw;
  min-height: 30px;
  border-radius: 5px;
  border: 1px solid lightgrey;
  font-size:10px;
}

.form-floating > label {
  padding: 0px 5px;
  font-size: 12px;
  margin-left: 10px;
  background-color: white;
  color: grey;
}

form-control:not(:placeholder-shown) {
  padding-top: 20px;
  padding-bottom: 0px;
}

input {
  font-size: 10px;
  margin-bottom: 20px;
  z-index: 100000;
}
label {
  margin-bottom: 1000px;
}


</style>
