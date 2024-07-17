<template>
  <div class="img">
    <img src="../../assets/images/Login/logoamarelo.png" alt="">
  </div>
  <div>
    <Icones v-if="active_dash" imageSrc="/src/assets/images/DashBoard/active_dashboard.png"/>
    <DefaultIcon @click="SetDash" v-if="!active_dash" imageSrc="/src/assets/images/DashBoard/dashboard.png"/>
  </div>
  <div>
    <Icones  v-if="active_user" imageSrc="/src/assets/images/DashBoard/active-user.png"/>
    <DefaultIcon @click="SetUser" v-if="!active_user" imageSrc="/src/assets/images/DashBoard/user.png"/>
  </div>
  <div>
    <Icones v-if="active_team" imageSrc="/src/assets/images/DashBoard/team.png"/>
    <DefaultIcon @click="SetTeam" v-if="!active_team" imageSrc="/src/assets/images/DashBoard/active_team.png"/>
  </div>
  <div>
    <Icones v-if="active_logout" imageSrc="/src/assets/images/DashBoard/logout.png"/>
    <DefaultIcon @click="SetLogout" v-if="!active_logout" imageSrc="/src/assets/images/DashBoard/active_logout.png"/>
  </div>
</template>

<script>
import Icones from "@/components/DashBoard/Icones.vue";
import DefaultIcon from "@/components/DashBoard/DefaultIcon.vue";

export default {
  name: 'MenuDash',
  components: {DefaultIcon, Icones },
  data() {
    return {
      active_dash: true,
      active_team: false,
      active_user: false,
      active_logout: false,
    }
  },
  methods: {
    SetDash(){
      this.active_dash = true
      this.active_user = false
      this.active_team = false
      this.active_logout = false
      this.$router.push('/dashboard');
    },
    SetUser(){
      this.active_dash = false
      this.active_user = true
      this.active_team = false
      this.active_logout = false
      this.$router.push('/UserProfile')
    },
    SetTeam(){
      this.active_dash = false
      this.active_user = false
      this.active_team = true
      this.active_logout = false
    },
    SetLogout(){
      this.active_dash = false
      this.active_user = false
      this.active_team = false
      this.active_logout = true
    }
  }
}
</script>

<style scoped>
.img img {
  width: 60px;
}

.img {
  height: 60px;
}


.dashboard img {
  width: 20px;
  position: absolute;
}
</style>
