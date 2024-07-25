<template>
  <div class="base-search">
    <div class="flex-box" >
      <div v-if="!contact"><input type="text" placeholder="Encontrar Funil" v-model="name"></div>
      <div v-if="contact"><input type="text" placeholder="Encontrar Contato" v-model="name"></div>
      <div class="search-img" v-if="!close"><img @click="SendSearch" src="../../assets/images/DashBoard/lupa.png"></div>
      <div class="search-img" v-if="close"><img @click="CleanSearch" src="../../assets/images/DashBoard/cruz.png"></div>
    </div>
    <div class="returnapi" v-if="hidden && !contact"  >
      <div v-if="!contact" class="content-search" v-for="item in returndata.funnels" @click="CRM(item.id)">
        <div class="type">
          <div v-if="!contact"><p>Funil</p></div>
          <div v-if="!contact"><img src="../../assets/images/DashBoard/funil.png"></div>
        </div>
        <div class="info-search">
          <p>{{ item.name }}</p>
          <p>{{item.created_at }}</p>
        </div>
        <div class="describe">{{ item.description}}</div>
        <div class="limit">
          <hr>
        </div>
      </div>
    </div>
    <div class="returnapi" v-if="hidden && contact"   >
      <div v-if="contact" class="content-search" v-for="item in returndata.users" @click="CRMWithContact(item.id, item.step_id)">
        <div class="type">
          <div v-if="contact"><p>Contato</p></div>
          <div v-if="contact"><img src="../../assets/images/Funil/user1.png"></div>
        </div>
        <div class="info-search">
          <p>{{ item.name }}</p>
          <p>{{item.email }}</p>
        </div>
        <div class="describe">{{ item.description}}</div>
        <div class="limit">
          <hr>
        </div>
      </div>
    </div>

  </div>
</template>

<script>
import {GetOneStep, SearchContact, SearchFunnel} from "@/services/HttpService.js";
import {mapMutations} from "vuex";

export default {
  name: 'SearchBar',
  props: {
    contact:{type:Boolean}
  },
  data(){
    return {
      name: "",
      returndata: "empty",
      close: false,
      hidden: false,
      arroba: false,
      data: {},
      content : {}
    }
  },
  methods: {
    async CRMWithContact(id, step_id){
      const response = await GetOneStep(step_id)
      const returnjson = response.data
      this.updateFunnelId(returnjson.funnel_id)
      this.$router.push('/Funil')
    },
    async SendSearch(){
      if (this.contact !== true)
      {
        const data = {name : this.name}
        const response = await SearchFunnel(data)
        this.close = true;
        this.hidden = true
        this.returndata = response.data;
      }

      else if (this.contact === true)
      {
        this.data = {name: this.name}
        const response =  await SearchContact(this.data)
        this.close = true;
        this.hidden = true
        this.returndata = response.data;
      }
    },
    CleanSearch(){
      this.hidden = false
      this.close = false
    },
    CRM(id){
      this.updateFunnelId(id)
      this.$router.push('/Funil');
    },
    ...mapMutations(['updateFunnelId'])

  }
}
</script>

<style scoped>
hr {
  width: 18vw;
  margin-top: 2vh;

}

.base-search {
  z-index: 5000;
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

}

.content-search:hover {
  font-weight: bold;
}



.returnapi {
  width: 20vw;
  position: absolute;
  margin-top: 5px;
  border: 2px solid lightgray;
  border-radius: 5px;
  background-color: #F9FAFC;
  cursor: pointer;
  z-index: 1000;
}


.search-img {
  position: absolute;
  margin-left: 17vw;
  margin-top: 3px;
  padding-right: 0.8vw;
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