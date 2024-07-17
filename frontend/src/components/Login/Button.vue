<template>
  <div class="button"><p>{{text}}</p></div>
</template>
<style>
.button {
  width: 30vw;
  background-color: #3053F2;
  text-align: center;
  border-radius: 7px;
  color: white;
  cursor: pointer;
}

.button p {
  font-family: Arial, Helvetica, sans-serif;
  padding: 7px 0px;
  font-weight: bold;
  margin-top: 20px;
}
</style>
<script>
export default {
  name: 'Button',
  props: {
    text: {
      type: String,
      required: true
    }
  }
}
</script>