<template>
<div @click="CRM" class="base-funil">
  <div class="info-funil">
    <div class="funil-img"><img src="../../assets/images/DashBoard/funil.png"></div>
    <div class="name-funil">{{funil.name}}</div>
    <div @click="OpenInfoFunnel" id="open-info-funnel" class="funil-img"><img src="../../assets/images/DashBoard/pontos.png"></div>
  </div>
</div>
</template>
<script>
import {mapGetters, mapMutations} from "vuex";

export default {
  name: 'Funil',
  props: {
    id_collection: {
      type: String,
    },
    funil: {
      type: Object
    }
  },
  computed: {
    ...mapGetters(['funnel_id']),
  },
  data ()
  {
    return {
    }
  },
  methods: {
    OpenInfoFunnel(){
      this.$emit('OpenInformations', this.funil);
    },
    CRM(){
      this.updateFunnelId(this.funil.id)
      console.log(this.funil.id)
      this.$router.push('/Funil');
    },
    ...mapMutations(['updateFunnelId'])
  },
}
</script>
<style scoped>

.base-funil {
    background-color: #FEBC28;
    width: 12vw;
    padding: 5px 0px;
    margin: 10px 20px;
    border-radius: 10px;
}

.info-funil {
  display: flex;
  background-color: #FEBC28;
  height: 25px;
}
.funil-img {
  width: 2.5vw;
  height: 25px;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 10000;

}
.funil-img img {
  width: 15px;
  height: 15px;
  z-index: 2;
}

#open-info-funnel {
  cursor: pointer;
}

.name-funil {
  width: 7vw;
  text-align: center;
}
</style>
