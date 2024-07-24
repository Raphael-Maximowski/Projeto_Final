<template>
  <div id="modal" v-if="pass != true">
    <!-- Container Principal do Modal -->
    <div class="info-modal">
      <!-- Background Icone -->
      <div class="icon">
        <!-- Background Ghost -->
        <div class="ghost">
          <!-- Inserindo Image Ghost -->
          <div class="img-modal"></div>
        </div>
        <!-- Background Erros -->
        <div class="error">
          <!-- Exibindo Primeiro erro Disparado na Array -->
          <p>{{ errors[0] }}</p>
        </div>
      </div>
      <!-- Underline Vermelho no Alerta -->
      <div class="line"></div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Alert',
  props: {
    pass: {
      type: Boolean,
      required: true
    },
    errors: {
      type: Array,
      required: true
    }
  },
  methods: {
    setTrue() {
      this.$emit('update:pass', true);
    }
  }
};
</script>

<style>
@keyframes moveUpDown {
  0% {
    opacity: 0;
    transform: translateY(0);
  }
  5%, 10% {
    opacity: 1;
    transform: translateY(0);
  }
  20% {
    opacity: 1;
    transform: translateY(40px);
  }
  30%, 90% {
    opacity: 1;
    transform: translateY(40px);
  }
  100% {
    opacity: 0;
    transform: translateY(0);
  }
}

/* Background Alerta */
#modal {
  display: flex;
  justify-content: end;
  width: 30vw;
  height: 100vh;
  position: absolute;
  z-index: 4;

}

/* Principal Elemento Visual Modal */
.info-modal {
  position: relative;
  opacity: 0;
  animation: moveUpDown 8s ease-in-out 1;
}

/* Configuração Texto */
.error p {
  margin-top: 10px;
  font-size: 13px;
}

/* Imagem Ghost */
.img-modal {
  background-image: url('../../assets/images/Login/modal.png');
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  width: 50px;
  height: 50px;
}

/* Redefinições Extras Modal */
.info-modal {
  background-color: rgb(255, 255, 255);
  width: 15vw;
  height: 10vh;
  border-radius: 10px;
  position: absolute;
}

/* Tamanho Background icon ghost */
.icon {
  height: 8vh;
  display: flex;
}

/* Linha */
.line {
  background-color: red;
  height: 2vh;
  border-radius: 0px 0px 10px 10px;
}

/* Background Ghost */
.ghost {
  width: 6vw;
  height: 8vh;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* Background Erro */
.error {
  width: 9vw;
  height: 8vh;
}
</style>
