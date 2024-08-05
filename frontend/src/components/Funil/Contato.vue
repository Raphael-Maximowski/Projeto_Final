<template>
  <div style=" cursor: pointer;" v-if="this.dadoscontact.name != 'card vazio'" class="maincard" @click="ActiveContact">
    <div class="whatsapp"><img @click="ActiveWhats" src="../Funil/whatsapp.png"></div>
    <div  class="contentcard" >
      <div class="imagewhastapp">
        <div class="name" >{{this.dadoscontact.name}}</div>
      </div>
      <div class="value">R$ {{this.dadoscontact.value}}</div>
    </div>
  </div>
  <div style="border: 1px solid lightgray; height: 130px" v-if="this.dadoscontact.name === 'card vazio' && size == 1" class="maincard2">
    <div class="contentcard2" @click="OpenCreate">
      <div>
        <div style="color: lightgray; font-size: 13px;  font-weight: lighter; margin-top: 5px; font-style: italic; text-align: center">Etapa vazia</div>
        <div>
          <img src="../../assets/images/Funil/skeleton.png">
        </div>
       <div style="color: lightgray; font-size: 13px;  font-weight: lighter; margin-top: 10px; font-style: italic; text-align: center">Crie um novo Contato</div>

      </div>


    </div>
  </div>
</template>
<script>
import {mapGetters} from "vuex";

export default {
  name: 'ContatoCard',
  props: {
    dadoscontact: {type:Object},
    size: {type:Number}
  },
  data(){
    return {
      link : "",
      info : true
    }
  },
  created(){
    this.Whatsapp()
  },
  methods: {
    ActiveContact(){
      if (this.info)
      this.$emit('ActiveContactEtapa',this.dadoscontact);
    },
    OpenCreate(){
      this.$emit('OpenCreate');
    },
    Whatsapp() {
      const phoneNumber = String(this.dadoscontact.phone)
      const user = this.user_name;
      const email = this.user_email;
      const message = "Meu nome é " + user + " e sou um representante da 3C+, uma empresa inovadora no mercado de consultoria e soluções empresariais. \n" +
          "\n" +
          "Na 3C+, oferecemos uma gama de serviços personalizados para ajudar sua empresa a alcançar seus objetivos de crescimento e eficiência. Nossos principais serviços incluem:\n" +
          "\n" +
          "- Consultoria em Gestão\n" +
          "- Estratégias de Marketing Digital\n" +
          "- Desenvolvimento de Software Sob Medida\n" +
          "- Implementação de Soluções Tecnológicas Avançadas\n" +
          "\n" +
          "Estamos comprometidos em entregar resultados de alta qualidade e construir parcerias duradouras com nossos clientes.\n" +
          "\n" +
          "Gostaríamos de agendar uma reunião para discutir como podemos colaborar e contribuir para o sucesso de sua empresa. Por favor, entre em contato para mais detalhes.\n" +
          "\n" +
          "Aguardo seu retorno.\n" +
          "\n" +
          "Atenciosamente,\n" +
          user + "\n" +
          email;
      const text = encodeURIComponent(message);
      this.link = 'https://wa.me/' + phoneNumber + '?text=' + text;
    },
    ActiveWhats(){
      this.info = false
      window.open(this.link, '_blank');
      setTimeout(() => {
        this.info =  true
        console.log('Info Setado')
      }, 2000);
    }
  },    computed: {
    ...mapGetters(['user_name', 'user_email', 'admin'])
  },
}
</script>
<style scoped>
* {
  font-family: Arial, Helvetica, sans-serif;
}
.whatsapp {

  z-index: 10000110;

  position: absolute;
  width: 11.2vw;
  display: flex;
  justify-content: end;
  padding-right: 20px;
  padding-top: 12px;
}

.whatsapp img{
  width: 20px;

}

.imagewhastapp {
  display: flex;

  justify-content: space-between;
}
.name {
  padding-top: 10px;
  font-weight: normal;
  font-size: 14px;
}

.value {
  padding-top: 18px;
  font-weight: normal;
  font-size: 13px;
  color: grey;
}

.contentcard{
  margin-left: 10px;
  z-index: 1;
}

.contentcard2 {
  display: flex;
  justify-content: center;
  padding-top: 10px;
  height: 150px;
}


.contentcard2 img {
  width: 130px;
  height: 50px;
  margin-left: 10px;
}

.maincard {
  margin-top: 10px;
  height: 80px;
  border-radius: 10px;
  width: 218px;
  border: 1px solid rgba(211, 211, 211, 0.51);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05), 0 6px 20px rgba(0, 0, 0, 0.05);
}

.maincard2 {
  margin-top: 10px;
  height: 80px;
  border-radius: 10px;
  width: 218px;
  border: 1px solid rgba(211, 211, 211, 0.51);
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05), 0 6px 20px rgba(0, 0, 0, 0.05);
  opacity: 0;
}

.maincard2:hover {
  opacity: 100;
  transition: 0.8s;
  cursor: pointer;

}

.drag{
  transform: rotate(10deg);
}

.ghost {
  background-color: lightgray;
  border-radius: 6px;
  z-index: 1000;
}
</style>