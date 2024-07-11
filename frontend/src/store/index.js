import { createStore } from "vuex";

export default createStore({
  state: {
    user: {
      id: "",
      name: "",
      email: "",
      validated: "",
      token: "",
      created: "",
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
    }

  },
  mutations: {
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
    }
  },
  actions: {},
  modules: {},
});
