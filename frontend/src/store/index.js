import { createStore } from "vuex";
import createPersistedState from 'vuex-persistedstate';

export default createStore({
  state: {
    user: {
      id: "",
      name: "",
      email: "",
      validated: "",
      token: "",
      created: "",
      funnel_id: "",
      colors: "",
      team: "",
      admin : "",
      user_profile : "",
      team_users : {},
      state_dash : "",
      state_user: "",
      state_team: "",
      state_chat: ""
    }
  },
  getters: {
    user_id: state => state.user.id,
    user_name: state => state.user.name,
    user_email: state => state.user.email,
    user_validated: state => state.user.validated,
    user_token: state => state.user.token,
    created: state => state.user.created,
    logged_in: state => {
      return state.user;
    },
    funnel_id : state => state.user.funnel_id,
    colors : state => state.user.colors,
    team : state => state.user.team,
    admin : state => state.user.admin,
    user_profile : state => state.user.user_profile,
    team_users : state => state.user.team_users,
    dash_state : state => state.user.state_dash,
    user_state : state => state.user.state_user,
    team_state : state => state.user.state_team,
    chat_state : state => state.user.state_chat
  },
  mutations: {
    CLEAR_STATE(state) {
      state.user.id = "";
      state.user.name = "";
      state.user.email = "";
      state.user.validated = "";
      state.user.token = "";
      state.user.created = "";
      state.user.funnel_id = "";
      state.user.colors = "";
      state.user.team = "";
      state.user.admin = "";
      state.user.user_profile = "";
      state.user.team_users =  "";
      state.user.state_dash = "";
      state.user.state_user = "";
      state.user.state_team = "";
      state.user.state_chat = "";

    },
    UpdateDashState(state, NewState){
      state.user.state_dash = NewState
    },
    UpdateUserState(state, NewState){
      state.user.state_user = NewState
    },
    UpdateTeamState(state, NewState){
      state.user.state_team = NewState
    },
    UpdateChatState(state, NewState){
      state.user.state_chat = NewState
    },
    updateTeam(state, NewTeam){
      state.user.team =  NewTeam
    },
    UpdateAdmin(state, NewState) {
      state.user.admin = NewState
    },
    updateUserId(state, NewId)
    {
      state.user.id = NewId;
    },
    updateUserName(state, NewName){
      state.user.name = NewName;
    },
    updateUserEmail(state, NewEmail){
      state.user.email = NewEmail;
    },
    updateUserValidate(state, NewValidate){
      state.user.validated = NewValidate;
    },
    updateUserToken(state, NewToken){
      state.user.token = NewToken;
    },
    updateUserCreated(state, NewDate){
      state.user.created =  NewDate;
    },
    updateFunnelId(state, NewFunnelId){
      state.user.funnel_id =  NewFunnelId
    },
    updateColors(state, NewColor) {
      state.user.colors = NewColor
    },
    UpdateUser(state, NewUser) {
      state.user.user_profile =  NewUser
    },
    UpdateTeamUsers(state, NewUsers) {
      state.user.team_users =  NewUsers
    }
  },
  actions: {
    clearState({ commit }) {
      commit('CLEAR_STATE');
    },
  },
  modules: {},
  plugins: [createPersistedState()],
});
