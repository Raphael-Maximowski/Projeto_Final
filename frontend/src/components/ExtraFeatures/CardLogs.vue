<template>
  <div class="basecardlog">
    <img src="../../assets/images/ExtraFeatures/intercambio.png">
    <div class="contentlog">LOG ID: {{data.log.id}}</div>
    <div class="contentlog"> {{data.log.contact.name}}</div>
    <div class="contentlog">{{data.log.contact.email}}</div>
    <div class="contentlog">Posição {{position}} </div>
    <div class="contentlog"> {{data.Step.name}} </div>
    <div class="contentlog"> {{date}} </div>
  </div>
</template>
<script>
export default {
  name: 'CardLogs',
  props: {
    data: {type:Object}
  },
  data() {
    return {
      position: null,
      etapa : null,
      date: null
    }
  },
  created(){

    if (this.data.log.new_position == null){
      this.position = this.data.log.old_position
    } else { this.position = this.data.log.new_position}
    this.formatTimestamp()
  },
  methods: {
    formatTimestamp() {
      const date = new Date(this.data.log.created_at)

      const day = String(date.getUTCDate()).padStart(2, '0');
      const month = String(date.getUTCMonth() + 1).padStart(2, '0'); // Month is 0-based
      const year = date.getUTCFullYear();

      let hours = date.getUTCHours() - 3;
      if (hours < 0) {
        hours += 24; // Ajuste se as horas forem negativas
        date.setUTCDate(date.getUTCDate() - 1); // Ajuste o dia se necessário
      }
      hours = String(hours).padStart(2, '0');

      const minutes = String(date.getUTCMinutes()).padStart(2, '0');
      const seconds = String(date.getUTCSeconds()).padStart(2, '0');

      this.date = `${String(date.getUTCDate()).padStart(2, '0')}/${month}/${year} ${hours}:${minutes}:${seconds}`;
    }
  }
}
</script>
<style>

.contentlog{
  padding-left: 15px;
  width: 13.8vw;
  height: 40px;
  display: flex;
  align-items: center;
  border-right: 1px solid lightgray;
  border-left: 1px solid lightgray;
  font-size: 13px;

}
.basecardlog {
  width: 83.7vw;
  height: 40px;
  display: flex;
  align-items: center;
  border: 1px solid lightgray;
}

.basecardlog img {
  width: 20px;
  height: 20px;
  margin: 0px 12px
}

</style>