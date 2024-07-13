<template>
  <main>

    <!-- Menu -->
    <div class="menu">
      <MenuDash/>
    </div>
    <div class="main-user">teste</div>
  </main>
</template>

<style scoped>
.delete {
  width: 26vw;
  height: 40vh;
  display: flex;
  justify-content: center;
  align-items: end;
}
.delete p {
  background-color: red;
  padding: 5px 50px;
  border-radius: 10px;
  color: white;
  font-weight: bold;
}
.title_edit_collection {
  margin-bottom: 5px;
  font-size: 17px;
  font-weight: bold;
  color: #333;
}

.info_edit_collection {
  text-align: justify;
  height: 4vh;
  font-size: 15px;
  width: 20vw;
  margin-bottom: 5px;
  color: rgba(0, 0, 0, 0.87);
}



.edit_collection {
  background-color: #FEBC28;
  width: 7vw;
  padding: 3px 5px;
  border-radius: 10px;
  text-align: center;
  font-weight: bold;
}

.extra-info {
  width: 25vw;
  height: 300px;
}
.color-colection {
  font-size: 17px;
  display: flex;
}

.textarea-container {
  display: flex;
  flex-direction: column;
  width: 20vw;
}
label {
  margin-bottom: 5px;
  font-size: 14px;
  color: #333;
  font-weight: bold;
}
textarea {
  width: 100%;
  height: 165px;
  padding: 10px;
  font-size: 14px;
  border: 1px solid #ccc;
  border-radius: 5px;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  transition: border-color 0.3s, box-shadow 0.3s;
  white-space: pre-line;
  color: grey;
  margin-bottom: 20px;

}

.main-info label {
  font-size: 17px;
  margin-bottom: 10px;
}


.main-info input {
  height: 4vh;
  font-size: 13px;
  padding-left: 10px;
  width: 20vw;
  margin-bottom: 20px;
  color: grey;
  border: 1px solid #ccc;
  border-radius: 5px;
}
.return img {
  width: 25px;
  margin-left: 25px;
}

.return {
  display: flex;
  padding-top: 10px;
  align-items: center;
}

.return-img
{
  width: 5vw;
  z-index: 999;
}
.header-info {
  position: absolute;
  width: 30vw;
  text-align: center;
  font-size: 18px;
  font-weight: bold;
}

.main-info {
  margin-top: 25px;
  height: 80vh;
  padding-left: 30px;
}

.color-colection {
  display: flex;
  height: 40px;
  align-items: center;
}
.box-color {
  width: 2vw;
  height: 2vw;
  border: 3px solid lightgray;
  border-radius: 50%;
  background-color: #FEBC28;
  margin-left:20px;
}

.modal3 {
  position: absolute;
  background: rgba(0, 0, 0, 0.384);
  width: 100vw;
  height: 100vh;
  display: flex;
  justify-content: end;
  z-index: 1000;
}

.base-modal3 {
  background-color: white;
  width: 30vw;
  height: 100vh;
  border-radius: 10px 0px 0px 10px;

  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
}

* {
  margin: 0;
  padding: 0;
  font-family: Arial, Helvetica, sans-serif;
}
main {
  background-color: #F9FAFC;
  width: 100vw;
  height: 100vh;
  display: flex;
  overflow: hidden;

}

.menu {
  height: 100vh;
  width: 60px;
  background-color: white;
  transition: width 0.3s ease;
  border-right: 2px solid #E1E9F4;
}

.img img {
  width: 60px;
}

.dashboard {
  width: 60px;
  padding: 15px 0px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.dashboard img {
  width: 20px;
  position: absolute;
}

.user img {
  width: 20px;
  position: absolute;
}
.user {
  width: 60px;
  padding: 30px 0px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.user img {
  width: 20px;
  position: absolute;
}
.logout {
  width: 60px;
  padding: 30px 0px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.logout img {
  width: 20px;
  position: absolute;
}

.border {
  height: 20px;
  width: 15px;
  padding: 15px 0px;
  border-radius: 0px 10px 10px 0px;
  background-color: #FFBB28;
  margin-right: 53px;
}

.principal {
  width: 95.7vw;
}

.header {
  width: 95.7vw;
  height: 60px;
}

.header {
  display: flex;
}

.welcome {
  width: 75vw;
}

.welcome h1 {
  font-size: 20px;
  margin-left: 3vw;
  margin-top: 10px;
  color: #222738;
  font-weight: bold;
}
.welcome p {
  margin-left: 3vw;
  font-size: 15px;
  color: #222738;
  font-weight: bold;
}
.create {
  width: 20.7vw;
  display: flex;
  justify-content: center;
  align-items: center;
}

.create p {
  background-color: #3053F2;
  padding: 5px 15px;
  border-radius: 8px;
  color: white;
  font-size: 17px;
  margin-left: 6vw;
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
  width: 50vw;
  background-color: rgb(255, 255, 255);
  height: 53vh;
  filter: blur(0px);
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
}

.content2 {
  width: 50vw;
  background-color: rgb(255, 255, 255);
  height: 40vh;
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

#floatingInput, #floatingPassword{
  height: 6vh;
  width: 30vw;
  min-height: 30px;
  border-radius: 5px;
  border: 1px solid lightgrey;
  font-size:10px
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

/*Configueações Label BootStrap*/


.form-control:focus {
  box-shadow: none;
}

.color {
  display: flex;
  font-size: 12px;
}

.color p {
  margin-top: 5px;
}

.form {
  margin-left: 2vw;
  margin-top: 20px;
}

.choosecolor {
  margin-left: 20px;
}

.submit {
  margin-top: 15px;
  background-color: #FFBB28;
  color: white;
  text-align: center;
  width: 10vw;
  padding: 2px 0px;
  border-radius: 10px;
}

input {
  font-size: 10px;
}

.form-floating > label[data-v-df256515] {
  padding-top: 8px;
  font-size: 12px;
  padding-left: 10px;
  background-color: rgba(0, 0, 0, 0);
  color: grey;
}

.cancel {
  padding-top: 10px;
  margin-left: 19vw;
}
</style>
<script>
import Collection from '../../components/DashBoard/Collection.vue';
import Funil from '../../components/DashBoard/Funil.vue';
import {GetUser} from "@/services/HttpService.js";
import {mapGetters, mapMutations} from 'vuex';
import MenuDash from "@/components/DashBoard/Menu.vue";

export default {
  components: {MenuDash, Collection, Funil},
  data() {
    return {};
  },

  // Validando Email
  methods: {
    PushDashBoard() {
      this.$router.push('/Dashboard');
    },
    ActiveModal() {
      this.modal = !this.modal
    },

    toggleModal2() {
      this.modal2 = !this.modal2;
    },
    updateModal2(newValue) {
      this.modal2 = newValue;
    },

    toggleModal3() {
      this.modal3 = !this.modal3;
    },
    updateModal3(newValue) {
      this.modal3 = newValue;
    },

    toggleModal4() {
      this.modal4 = !this.modal4;
    },
    updateModal4(newValue) {
      this.modal4 = newValue;
    },

    edit_collectionfn() {
      this.edit_collection = !this.edit_collection
    },
    edit_funilfn() {
      this.edit_funil = !this.edit_funil;
    },
    async ShowUser() {
      const response = await GetUser();
      console.log(response);
      this.updateUserId(response.data.id);
      this.updateUserName(response.data.name);
      this.updateUserEmail(response.data.email);
      this.updateUserValidate(response.data.email_verified_at);
      this.updateUserCreated(response.data.created_at);
    },
    ...mapMutations(['updateUserId', 'updateUserName', 'updateUserEmail', 'updateUserValidate', 'updateUserToken', 'updateUserCreated'])

  },
  created() {
    this.ShowUser();
  },

};
</script>