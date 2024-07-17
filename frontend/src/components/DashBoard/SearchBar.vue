<template>
  <div class="base-search">
    <div class="flex-box" >
      <div><input type="text" placeholder="Encontrar Funil" v-model="name"></div>
      <div class="search-img" v-if="!close"><img @click="SendSearch" src="../../assets/images/DashBoard/lupa.png"></div>
      <div class="search-img" v-if="close"><img @click="CleanSearch" src="../../assets/images/DashBoard/cruz.png"></div>
    </div>
    <div class="returnapi" v-if="hidden"  >
      <div class="content-search" v-for="funil in returndata.funnels">
        <div class="type">
          <div><p>Funil</p></div>
          <div><img src="../../assets/images/DashBoard/funil.png"></div>
        </div>
        <div class="info-search">
          <p>{{ funil.name }}</p>
          <p>{{funil.created_at }}</p>
        </div>
        <div class="describe">{{ funil.description}}</div>
        <div class="limit">
          <hr>
        </div>

      </div>
    </div>

  </div>
</template>

<script>
import {SearchFunnel} from "@/services/HttpService.js";

export default {
  name: 'SearchBar',
  data(){
    return {
      name: "",
      returndata: "empty",
      close: false,
      hidden: false,
    }
  },
  methods: {
    async SendSearch(){
      const data = {name : this.name}
      const response = await SearchFunnel(data)
      this.close = true;
      this.hidden = true
      this.returndata = response.data;
      console.log('retorno')
      console.log(this.returndata)
    },
    CleanSearch(){
      this.hidden = false
      this.close = false
    }
  }
}
</script>

<style scoped>
hr {
  width: 18vw;
  margin-top: 2vh;

}

.base-search {
  z-index: 1001;
}
.describe {
  font-size: 12px;
  width: 18vw;
}
.info-search {
  display: flex;
  justify-content: space-between;
  margin-top: 5px;
  height: 20px;
  font-size: 12px;
}

.type {
  display: flex;
  height: 30px;
  display: flex;
  justify-content: space-between;
  font-size: 14px;
  font-weight: bold;
}

.type img {
  width: 20px;
}
.content-search {
  width: 18vw;
  margin: 1vw 1vw;
  background-color: #F9FAFC;
}

.content-search:hover {
  color: #2336C7;
  font-size: 18px;
}

.info-search:hover{
  color: #2336C7;
}

.returnapi {
  width: 20vw;
  margin-top: 5px;
  border: 2px solid lightgray;
  border-radius: 5px;
  background-color: #F9FAFC;
  cursor: pointer;



}
.search-img {
  position: absolute;
  margin-left: 17vw;
  margin-top: 3px;
  padding-right: 0.9vw;
  padding-left: 0.7vw;
  padding-bottom: 2px;
  z-index: 2;
  background-color: #F9FAFC;
}
.flex-box {
  display: flex;
  margin-top: 15px;

}

.search-img img {
  width: 18px;
  background-color: #F9FAFC;
  cursor: pointer;
}
input {
  width: 20vw;
  border: 2px solid lightgray;
  padding: 5px 10px;
  border-radius: 5px;
  background-color: #F9FAFC;
  font-size: 13px;
  user-focus: none;
}


</style>