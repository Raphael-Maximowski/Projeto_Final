<template>
  <div class="zindex">
    <div class="img">
      <img style="cursor: pointer" @click="SetDash" src="../../assets/images/Login/logoamarelo.png" alt="">
    </div>
    <div>
      <Icones v-if="dash_state" imageSrc="/src/assets/images/DashBoard/active_dashboard.png"/>
      <DefaultIcon @click="SetDash" v-if="!dash_state" imageSrc="/src/assets/images/DashBoard/dashboard.png"/>
    </div>
    <div>
      <Icones  v-if="user_state" imageSrc="/src/assets/images/DashBoard/active-user.png"/>
      <DefaultIcon @click="SetUser" v-if="!user_state" imageSrc="/src/assets/images/DashBoard/user.png"/>
    </div>
    <div>
      <Icones v-if="team_state" imageSrc="/src/assets/images/DashBoard/team.png"/>
      <DefaultIcon @click="SetTeam" v-if="!team_state" imageSrc="/src/assets/images/DashBoard/active_team.png"/>
    </div>
    <div >
      <Icones v-if="chat_state" imageSrc="/src/assets/images/DashBoard/activechat.png"/>
      <DefaultIcon @click="SetChat" v-if="!chat_state" imageSrc="/src/assets/images/DashBoard/chat.png"/>
    </div>
    <div style="margin-top: 60vh">
      <DefaultIcon @click="SetLogout" imageSrc="/src/assets/images/DashBoard/active_logout.png"/>
    </div>

  </div>

</template>

<script>
import Icones from "@/components/DashBoard/Icones.vue";
import DefaultIcon from "@/components/DashBoard/DefaultIcon.vue";
import {mapMutations, mapGetters} from "vuex";

export default {
  name: 'MenuDash',
  components: {DefaultIcon, Icones },
  data() {
    return {
      active_chat : false
    }
  },
  methods: {
    SetLogout(){
      this.$store.dispatch('clearState');
      this.$router.push('/');
    },
    SetDash(){
      this.UpdateDashState(true)
      this.UpdateUserState(false)
      this.UpdateTeamState(false)
      this.UpdateChatState(false)
      this.$router.push('/dashboard');
    },
    SetUser(){
      this.UpdateUserState(true)
      this.UpdateDashState(false)
      this.UpdateTeamState (false)
      this.UpdateChatState (false)
      this.UpdateUser(this.user_id);
      this.$router.push('/UserProfile')
    },
    SetTeam(){
      this.UpdateUserState(false)
      this.UpdateDashState(false)
      this.UpdateTeamState (true)
      this.UpdateChatState (false)
      this.$router.push('/Team')
    },
    SetChat(){
      this.UpdateUserState(false)
      this.UpdateDashState(false)
      this.UpdateTeamState (false)
      this.UpdateChatState (!this.chat_state)
      this.$emit('active_chat')
    },
    ...mapMutations(['UpdateUser', 'UpdateDashState', 'UpdateUserState', 'UpdateTeamState', 'UpdateChatState'])
  },
  computed: {
    ...mapGetters(['user_id', 'user_profile', 'dash_state', 'user_state', 'team_state', 'chat_state']),
  },
}
</script>

<style scoped>
.img img {
  width: 60px;
}
.zindex {
  z-index: 50000;
}

.img {
  height: 60px;
}


.dashboard img {
  width: 20px;
  position: absolute;
}
</style>
