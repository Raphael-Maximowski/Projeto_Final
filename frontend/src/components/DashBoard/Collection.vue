<template>
<div class="base" :style="{ border: '2px solid ' + collection.color }">
  <div class="info">
    <div class="title">
      <div>{{collection.name}}</div>
      <div class="more-info" @click="OpenInfoCollection"><img src="../../assets/images/DashBoard/info.png" alt=""></div>
      </div>
    <div class="crud">
      <div class="funil" v-if="admin == 1" @click="showfunil">
        <p :style="{ backgroundColor: collection.color}">Novo Funil</p>
      </div>
    </div>
  </div>
  <div class="group">
    <div v-for="funil in funnels">
      <Funil :color="color" @OpenInformations="OpenInformations" :funil="funil"/>
    </div>
  </div>
</div>
</template>
<script>
import Funil from './Funil.vue';
import {mapMutations, mapGetters } from 'vuex';
import {GetFunnel} from "@/services/HttpService.js";
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

    resync: {
      type: Boolean
    }
  },

  data ()
  {
    return {
      open_info: true,
      open_info_collection: true,
      name : '',
      desc: '',
      color: '',
      id_collection: '',
      data: [],
      receive_data: [],
      funnel: [],
      funnels: {}
    }
  },
  created() {
    this.SyncData()
    this.color = this.collection.color
    this.updateColors(this.color)
    this.$emit('Color')
    this.GetFunnels()
  },
  methods: {
    OpenModal()
    {
      this.$emit('OpenModal', this.data)
    },
    showfunil() {
      this.id_collection = this.collection.id
      this.$emit('ShowFunil', this.id_collection);
    },
    OpenInformations(value){
      const values = value
      this.data = [
          this.name =  values.name,
          this.desc  = values.description,
          this.color = this.collection.color,
          this.id_collection = this.collection.id,
          this.open_info,
        this.open_info_collection = false,
        this.id_funil = values.id
      ]
      this.OpenModal()
    },
    OpenInfoCollection(){
      this.data = [
        this.name = this.collection.name,
        this.desc = this.collection.description,
        this.color = this.collection.color,
        this.id_collection = this.collection.id,
        this.open_info,
        this.open_info_collection = true
      ]
      this.OpenModal()
    },
    SyncData(){
      this.receive_data = this.collection
      this.id_collection = this.collection.id
      this.$emit('ResetResync');
      this.funnel = []


      for(let i = 0; i < this.funnels.length; i++){
        let id = this.funnels[i].collection_id;
        if (id === this.id_collection){
          this.funnel.push(this.funnels[i])
        }
      }
    },
    async GetFunnels()
    {
      const data = {
        collection_id : this.collection.id
      }
      const response = await GetFunnel(data);
      this.funnels =  response.data
      console.log('Funil Collection', this.funnels)
    },
    ...mapMutations(['updateColors'])
  },
  watch: {
    resync(value) {
      if (value ===  true){
        this.SyncData()
      }
    }
  }, 
  computed: {
  ...mapGetters(["admin"]),
},

}
</script>

<style scoped>
.base {
  height: 170px;
  margin: 30px 45px;
  border-radius: 5px;

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
  margin-left: 1.5vw;
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
  margin-right: 1vw;
}

.funil p {
    background-color: #FEBC28;
    padding: 5px 15px;
    border-radius: 8px;
    font-size: 17px;
    margin-top: 17px;
    margin-left: 15px;
}

.title img {
  width: 23px;
  margin-left: 20px;
  margin-bottom: 2px;
}

.group {
  display: flex;
  flex-wrap: wrap;
  justify-content: left;
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

.more-info {
  cursor:pointer;
}

</style>
