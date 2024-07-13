<template>
  <div class="modal2" v-if="succes">
    <div class="container-modal">
      <div class="email">
        <div class="img-up"><img src="../../assets/images/Login/icones_coloridos.png"></div>
        <h3>{{title}}</h3>
        <p>{{content}}</p>
        <div class="router-email">
          <a :href="rota"><div class="content-modal2"><img src="../../assets/images/Login/email.png">{{button}}</div></a>
        </div>
        <div class="img-down"><img src="../../assets/images/Login/icones_coloridos.png"></div>
      </div>
    </div>
  </div>
</template>
<style>
.img-up img {
  margin-top: 1vh;
  width: 150px;
  position: absolute;
  margin-right: 10px;
}

.img-down img {
  width: 150px;
  position: absolute;
  margin-left: 10px;
}

.img-up {
  background-color: red;
  width: 50vw;
  display: flex;
  justify-content: end;
}

.img-down {
  background-color: red;
  width: 50vw;
  display: flex;
  justify-content: start;
}
a {
  text-decoration: none;
}

.content-modal2 {
  color: white;
  font-size: 18px;
  width: 15vw;
  margin-top: 20px;
  padding: 10px 0px;
  border-radius: 10px;
  background-color: #2336C7;
  cursor: pointer;
}

.container-modal {
  background-color: white;
  width: 50vw;
  height: 45vh;
  border-radius: 20px;
  display: flex;
  justify-content: center;
  text-align: center;
}

.email h3 {
  font-size: 35px;
  color: #1a202c;
  margin: 75px 0px 10px 0px
}

.router-email {
  display: flex;
  justify-content: center;
}


.router-email img {
  margin-right: 10px;
}

.router-email p {
  color: white;
  position: absolute;
}

.email p {
  font-size: 18px;
  color: black;
}

.modal2 {
  position: absolute;
  z-index: 999;
  width: 100vw;
  height: 100vh;
  background: rgba(0, 0, 0, 0.384);
  display: flex;
  align-items: center;
  justify-content: center;
}
</style>
<script>
export default {
  name: 'Email',
  props: {
    succes: {
      type: Boolean,
    },
    title: {
      type: String,
    },
    content: {
      type: String,
    },
    rota: {
      type: String,
    },
    button: {
      type: String,
    }
  }
}
</script>