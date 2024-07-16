<template>
  <div class="modal3" >
    <div class="base-modal3">
      <div class="return">
        <div class="return-img"><img src="../assets/images/DashBoard/return.png"></div>
        <div class="header-info">Informações da Coleção</div>
      </div>
      <div class="main-info">
        <div>
          <div class="title_edit_collection">
            Nome Associado a Coleção
          </div>
          <div class="info_edit_collection">
            aaaaa
          </div>
          <div class="title_edit_collection">Descrição Associada a Coleção</div>
          <div class="info_edit_collection">
            <p>aaaaaa</p>
            <div style="margin-top: 15px; display: flex" class="title_edit_collection">
              Cor Associada a Coleção
              <div class="box-color"></div>
            </div>
            <div class="edit_collection" @click="edit_collectionfn">Editar</div>
            <div class="delete"  @click="DeleteCollection"><p>Excluir Coleção</p></div>
          </div>

        </div>
        <form v-if="edit_collection == true">
          <div>
            <label>Nome Associado a Coleção</label>
            <br><input type="text" v-model="update_name_collection">
          </div>
          <div>
            <label>Descrição Associada a Coleção<br></label>
            <div class="textarea-container">
              <textarea id="message" name="message" placeholder="Digite sua mensagem aqui..." v-model="update_desc_collection">{{ update_desc_collection }}</textarea>
            </div>
          </div>
          <div class="color-colection">
            <div><label>Cor Associada a Coleção</label></div>
            <div class="box-color"></div>
          </div>
          <div class="edit_collection" @click="UpdateCollection">Atualizar</div>
          <div class="delete" @click="DeleteCollection"><p>Excluir Coleção</p></div>
        </form>
      </div>
    </div>
  </div>
</template>
<script>
</script>
<style>
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

.box-color {
  width: 2vw;
  height: 2vw;
  border: 3px solid lightgray;
  border-radius: 50%;
  background-color: #FEBC28;
  margin-left:20px;
}

.edit_collection {
  background-color: #FEBC28;
  width: 7vw;
  padding: 3px 5px;
  border-radius: 10px;
  text-align: center;
  font-weight: bold;
}

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
</style>