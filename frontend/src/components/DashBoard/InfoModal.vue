<template>
  <div class="modal3" >
    <div class="base-modal3">
      <div class="header-info">
        <div class="img-info"><img @click="CloseInfo" src="../../assets/images/DashBoard/return.png"></div>
        <div v-if="ValidateCollection" class="title-info"><h1>{{main1}}</h1></div>
        <div v-if="!ValidateCollection " class="title-info"><h1>{{main2}}</h1></div>
      </div>
      <div class="main-info">
        <div>
          <div v-if="ValidateCollection" class="subtitle-info"><h2>{{title1}}</h2></div>
          <div v-if="ValidateCollection && !Edit" class="content-info"><p>{{data_collection[0]}}</p></div>
          <div v-if="!ValidateCollection" class="subtitle-info"><h2>{{title2}}</h2></div>
          <div v-if="!ValidateCollection && !Edit" class="content-info"><p>{{data_collection[0]}}</p></div>

          <input v-if="Edit"  type="text" v-model="name">

        </div>
        <div>
          <div v-if="ValidateCollection" class="subtitle-info"><h2>{{description1}}</h2></div>
          <div v-if="ValidateCollection && !Edit" class="content-info"><p>{{data_collection[1]}}</p></div>
          <div v-if="!ValidateCollection " class="subtitle-info"><h2>{{description2}}</h2></div>
          <div v-if="!ValidateCollection && !Edit" class="content-info"><p>{{data_collection[1]}}</p></div>

          <input v-if="Edit" type="text"  v-model="description">
        </div>
        <div>
          <div v-if="ValidateCollection" class="subtitle-info">
            <div><h2>Cor Associada a Coleção</h2></div>
            <div class="border-info"  v-if="!Edit"><div :style="{ backgroundColor: data_collection[2]}" class="box-color-info"></div></div>
            <input v-if="Edit"  v-model="color" style="margin-left: 20px" type="color">
          </div>
        </div>
        <div class="buttons-info">
          <div class="edit-info" v-if="!Edit && admin == 1"  @click="EditInfo"><p>Editar</p></div>
          <div class="edit-info" v-if="Edit && admin == 1"  @click="Validator"><p>Enviar</p></div>
        </div>


      </div>
      <div class="delete-info" style="margin-top: 260px" v-if="Edit && admin == 1">
        <div @click="DeleteInfo"><p>Excluir</p></div>
      </div>
    </div>
  </div>
</template>
<script>
import HttpService, {DeleteCollection, DeleteFunnel, UpdateCollection, UpdateFunnel} from "@/services/HttpService.js";
import store from '../../store/index.js';
import {mapGetters} from "vuex";

export default{
  name: 'InfoModal',
  props: {
    data_collection: {type: Array},
    main1: {type: String},
    main2: {type: String},
    title1: {type:String},
    title2: {type:String},
    description1: {type:String},
    description2: {type:String},

  },
  data(){
    return{
      ValidateCollection: false,
      Edit: false,
      name: "",
      description: "",
      color: "",
      errors: [],
    }
  },
  methods: {
    SyncInfo(){
      this.ValidateCollection = this.data_collection[5]
      this.name = this.data_collection[0];
      this.description = this.data_collection[1];
      this.color = this.data_collection[2]
    },
    CloseInfo(){
      this.$emit('CloseModal')
    },
    EditInfo(){
      this.Edit = !this.Edit
    },
    ValidateName(){
      if (this.name.length === 0){
        this.errors.push('O campo nome é obrigatório');
      } else if (this.name.length > 12) { this.errors.push('Nome excedeu caracteres maximos') }
    },
    ValidateDescription(){
      if(this.description.length === 0 ){
        this.errors.push('O campo descrição é obrigatório');
      }
    },

    Validator(){
      this.ValidateName()
      this.ValidateDescription()
      if (this.errors.length === 0 ){
        this.SendData()
      } else { this.$emit('Error', this.errors[0])
      }

      this.errors = []
    },

    async SendData(){
      if (this.ValidateCollection){
        const data = {
          user_id: store.getters.user_id,
          id: this.data_collection[3],
          name : this.name,
          description : this.description,
          color : this.color,
          team_id : this.team
        }
        const response = await UpdateCollection(data)
        setTimeout(() => {
          window.location.reload();
        }, 500);
        return response;
      } else {
        const data = {
          user_id: store.getters.user_id,
          id: this.data_collection[6],
          name : this.name,
          description : this.description,
        }
        const response = await UpdateFunnel(data);
        setTimeout(() => {
          window.location.reload();
        }, 500);
        return response;
      }

    },
    async DeleteInfo(){
      if (this.ValidateCollection){
        const data = {
          user_id : store.getters.user_id,
          id: this.data_collection[3],
        }
        const response = await DeleteCollection(data)
        return response;
      } else {
        const data = {
          user_id : store.getters.user_id,
          id: this.data_collection[6],
        }
        const response = await DeleteFunnel(data);
        return response;
      }

    }
  },
  created(){
    this.SyncInfo()
  },
  computed: {
  ...mapGetters(["admin", "team"]),
},
}
</script>
<style scoped>
.modal3 {
  position: absolute;
  background: rgba(0, 0, 0, 0.384);
  width: 100vw;
  height: 100vh;
  display: flex;
  justify-content: end;
  z-index: 3;
}

@keyframes slideInFromRight {
  from {
    opacity: 0;
    transform: translateX(5px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.base-modal3 {
  background-color: white;
  width: 30vw;
  height: 100vh;
  border-radius: 10px 0px 0px 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
  animation: slideInFromRight 0.5s ease forwards;
}

.header-info {
  height: 55px;
  display: flex;
  align-items: center;
}

.img-info {
  width: 5vw;
  height: 55px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.img-info img {
  width: 25px;
  cursor: pointer;
}

.title-info {
  width: 25vw;
  height: 55px;
  display: flex;
  align-items: center;
}


.title-info h1 {
  margin-top: 8px;
  font-size: 18px;
  color: black;
  font-weight: bold;
}

.main-info {
  width: 30vw;
  height: 550px;

}

.delete-info {
  width: 30vw;

  display: flex;
  align-items: center;
  justify-content: center;
}

.delete-info p {
  margin-top: 15px;
  background-color: red;
  padding: 5px 60px;
  font-size: 16px;
  border-radius: 15px;
  cursor: pointer;
  color: white;
  font-weight: bold;
}

.subtitle-info{
  display: flex;
}

.box-color-info {
  margin-left: 2vw;
  background-color: #FEBC28;
  width: 50px;
  height: 25px;
  border: 3px solid #a8a8a8;
}

.border-info {
}

.subtitle-info h2{
  font-size: 15px;
  margin-left: 1.7vw;
  font-weight: bold;

}

.content-info p {
  margin-left: 1.7vw;
  margin-bottom: 20px;
  font-size: 15px;
  margin-right: 40px;
}

.buttons-info{
  width: 8vw;
  text-align: center;
  justify-content: center;
}

.buttons-info p {
  background-color: #FEBC28;
  margin-left: 1.7vw;
  padding-top: 5px;
  padding-bottom: 5px;
  border-radius: 10px;
  cursor: pointer;
  margin-top: 10px;
}

input[type="text"] {
  margin-left: 1.7vw;
  margin-bottom: 15px;
  width: 20vw;
  border-radius: 5px;
  border: 1px solid grey;
  font-size: 13px;
  padding: 5px 0px;
  padding-left: 10px;
  color: grey;
}



</style>