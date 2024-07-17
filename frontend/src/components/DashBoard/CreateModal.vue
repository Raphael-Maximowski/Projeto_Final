<template>
  <div class="colection">
    <div class="content">
    <div class="maincontent">
      <div class="title">
        <div style="display:flex">
          <div style="width: 29vw">
            <h3  v-if="activecollection">{{title}}</h3>
            <p v-if="activecollection">{{content}}</p>
            <h3 v-if="!activecollection">{{title2}}</h3>
            <p v-if="!activecollection">{{content2}}</p>
            <hr>
          </div>
          <div @click="teste" class="cancel">
            <img src="../../assets/images/DashBoard/cruz.png" alt="">
          </div>
        </div>
      </div>
      <div class="form">
        <div class="form-floating mb-3">
          <input type="name" class="form-control" id="floatingInput" autocomplete="off" v-model="name">
          <label for="floatingInput" v-if="activecollection">{{header}}</label>
          <label for="floatingInput" v-if="!activecollection">{{header2}}</label>
        </div>
        <div class="form-floating mb-3">
          <input type="name" class="form-control" id="floatingInput" autocomplete="off" v-model="description">
          <label for="floatingInput" v-if="activecollection">{{secondheader}}</label>
          <label for="floatingInput" v-if="!activecollection">{{thidheader}}</label>
        </div>
        <div class="color" v-if="activecollection">
          <div>
            <p>Insira a cor referencial da sua Coleção</p>
          </div>
          <div class="choosecolor">
            <input type="color" id="colorPicker" name="colorPicker" value="#FFBB28" v-model="color">
          </div>
        </div>
    </div>

      </div>

      <div class="backsubmit">
        <div class="submit" @click="SendData">Criar</div>
      </div>
    </div>

  </div>
</template>

<script>
import {mapGetters} from "vuex";

export default {
  name: 'CreateModal',
  computed:{
    ...mapGetters([
      'user_id'
    ])
  },
  props: {
    title: {type: String},
    content: {type: String},
    header: {type: String},
    secondheader: {type: String},
    title2: {type:String},
    content2: {type:String},
    header2:{type:String},
    thidheader:{type:String},
    activecollection: {type: Boolean},
    id_collection: {type:String}
  },
  data(){
    return{
      name: "",
      description: "",
      color: "#ffffff",
      type: "",
      idcollection: ""
    }
  },
    methods: {
      teste() {
        this.$emit('closeModal')
      },

      SendData(){
        this.type = this.activecollection === true;
        const data = {
          collection_id : this.id_collection,
          user_id : this.user_id,
          name : this.name,
          description : this.description,
          color : this.color,
          type : this.type
        }
        this.$emit('SendData', data)
      }
    },
};
</script>

<style scoped>
hr {
  width: 30vw;
}
.maincontent {
  height: 290px;
}
.backsubmit{
  display: flex;
  justify-content: center;
}
.choosecolor {
  margin-left: 20px;
  cursor: pointer;
}

.submit {
  background-color: #FFBB28;
  color: white;
  text-align: center;
  width: 30vw;
  padding: 5px 0px;
  border-radius: 10px;
  cursor: pointer;
}

.color {
  display: flex;
  font-size: 12px;
}

.color p {
  margin-top: 5px;
}

.form-control:focus {
  box-shadow: none;
}

#floatingInput, #floatingPassword {
  height: 6vh;
  width: 30vw;
  min-height: 30px;
  border-radius: 5px;
  border: 1px solid lightgrey;
  font-size: 10px;
}

/*Configueações Label BootStrap*/
.form-floating > label {
  padding: 0px;
  padding-top: 8px;
  font-size: 12px;
  padding-left: 10px;
  background-color: rgba(0, 0, 0, 0);
  color: grey;
}

.form-floating > label[data-v-df256515] {
  padding-top: 8px;
  font-size: 12px;
  padding-left: 10px;
  background-color: rgba(0, 0, 0, 0);
  color: grey;
}

.form {
  margin-left: 2vw;
  margin-top: 20px;
}

.cancel {
  padding-top: 10px;
  margin-left: 0vw;
  cursor: pointer;
}

.colection {
  background: rgba(0, 0, 0, 0.384);
  position: absolute;
  z-index: 3;
  width: 100vw;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

.content {
  width: 34vw;
  background-color: rgb(255, 255, 255);
  height: 350px;
  filter: blur(0px);
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
}

.title {
  margin-left: 2vw;
  margin-right: 2vw;
  display: flex;
}

.title img {
  width: 30px;
}

.title h3 {
  margin-top: 10px;
  margin-bottom: 5px;
  font-size: 20px;
  font-weight: bold;
}

.title p {
  font-size: 15px;
  margin-bottom: 10px;
}
</style>
