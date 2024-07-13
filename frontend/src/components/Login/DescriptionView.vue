<template>
  <div class="descricao">
    <h1>{{title}}</h1>
    <p>{{description}}</p>
  </div>
</template>
<style>
.descricao {
  text-align: center;
}
.descricao h1 {
  font-size: 2.59vw;
  color: #373753;
}
.descricao p {
  color: #788B9E;
  font-size: 0.96vw;
}
</style>
<script>
export default {
  name: 'Description',
  props: {
    title: {
      type: String
    },
    description: {
      type: String
    }
  }
}
</script>