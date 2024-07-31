<template>
  <div class="basecardlog">
    <img src="../../assets/images/ExtraFeatures/history.png">
    <div class="infolog">
      <p>Moveu Contato - Raphael Maximokws</p>
      <p>Etapa Antiga -  Teste</p>
      <p>Antiga Posição - 1</p>
      <p>Nova Etapa -  Finalizado</p>
      <p>Nova Posição - 1</p>
      <p>Data -  2024/12/01 12:45HR</p>
    </div>
  </div>
</template>
<script>
export default {
  name: 'CardLogs'
}
</script>
<style>
.basecardlog {
  display: flex;
  padding: 6px;
  border-bottom: 2px solid lightgray;
}

.basecardlog img {
  width: 23px;
  height: 23px;
  margin: 0px 10px
}

.infolog {
  font-size: 14px;
  height: 28px;
  width: 80vw;
  display: flex;
  justify-content: space-around;
;
}
</style>