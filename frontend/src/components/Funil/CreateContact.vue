<template>
  <div class="modalcontato">
    <div class="content">
      <div class="header">
        <div class="button">
          <div class="back"><p><</p></div>
          <div class="text">Voltar</div>
        </div>
        <div class="create"><p>Criar Contato</p></div>
      </div>
      <div class="name">
        <div class="contentname">
          <div class="insertname"><p>Nome do Contato</p></div>
          <hr>
          <div class="funil">
            <p>Nome do Funil</p>
            <div class="etapas">
              <div class="etapa" id="border1">Sem Etapa</div>
              <div class="etapa">Prospecção</div>
              <div class="etapa">Contato</div>
              <div class="etapa" id="border2">Proposta</div>
            </div>
          </div>
        </div>
      </div>
      <div class="contato">
        <div class="contentcontato">
          <div class="insertname">
            <div class="rotate"><</div>
              <p>Contatos</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style scoped>

.rotate {
  color: #3D3D58;
  font-weight: bold;
  margin-top: 6px;
  font-size: 30px;
  margin-left: 20px;
  transform: rotate(270deg); /* Rotaciona a div em 45 graus */
  cursor: pointer;
}

.contentcontato{
    background-color: white;
    border: 1px solid lightgray;
    width: 37vw;
    border-radius: 10px;
}
.contato {
  margin-top: 20px;
  width: 40vw;
  display: flex;
  justify-content: center;
}
#border1 {
  border-radius: 20px 10px 10px 20px;
}

#border2 {
  border-radius: 10px 20px 20px 10px;
}

.etapa {
  width: 8.3vw;
  color: #a4a4aa;
  padding: 3px 0px;
  text-align: center;
  background-color: #f3f6fb;
}
.etapas {
  display: flex;
  justify-content: space-between;
  width: 34.5vw;
  border-radius: 20px;
}
.funil {
  margin-left: 1vw;
  margin-top: 10px;
}

.funil p {
  color: #1b1b2b;
  margin-bottom: 20px;
}

hr {
  width: 34.5vw;
  margin: 0vw 1vw;
}


.insertname {
  height: 10vh;
  display: flex;
  align-items: center;
}

.insertname p {
  margin-top: 20px;
  margin-left: 20px;
  font-weight: bold;
  font-size: 22px;
  color: #373753;
}

.name {
  width: 40vw;
  display: flex;
  justify-content: center;
}

.contentname {
  background-color: white;
  border: 1px solid lightgray;
  width: 37vw;
  height: 180px;
  border-radius: 10px;
}

.create p {
  margin-left: 4.5vw;
  margin-top: 18px;
  background-color: blue;
  padding: 5px 40px;
  font-size: 18px;
  color: white;
  border-radius: 10px;
}
.back p {
  margin-bottom: 5px;
  margin-right: 3px;
  color: #3d3d58;
  font-weight: bold;
}
.text {
  color: #3d3d58;
  font-size: 20px;
  font-weight: bold;
}
.back{
  background-color: white;
  width: 40px;
  height: 40px;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 30px;
  border-radius: 50%;
  border: 1px solid lightgray;
  margin-right: 20px;
  margin-left: 20px;
}

.create {

  width: 20vw;
  display: flex;
  justify-content: center;

}
.button {
  width: 20vw;
  display: flex;
  align-items: center;

}
.header {
  height: 80px;
  display: flex;
  align-items: center;
;
}

.content {
  background-color: #f9fafc;
  width: 40vw;
  border-radius: 20px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.1);
}

.modalcontato {
  position: absolute;
  z-index: 2000;
  width: 100vw;
  height: 100vh;
  background: rgba(0, 0, 0, 0.384);
  display: flex;
  justify-content: end;
}

</style>
<script>
export default {
  name: 'ModalContato'
}
</script>