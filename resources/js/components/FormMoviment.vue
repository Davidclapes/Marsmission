<template>
  <div class="container">
    <form @submit.prevent="enviarFormulario">
      <p>Introdueix la seqüència desitjada:<br><br></p>
      <input v-model="moviment" class="buttoninici" type="text" style="text-transform: uppercase;">
      <br><br>
      <button type="submit" class="buttoninici">Moure Rover</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      moviment: ''
    };
  },
  methods: {
    enviarFormulario() {
      console.log("📌 Se ha activado el evento submit.");
      console.log("📦 Enviando datos:", { moviment: this.moviment });
      console.log("Formulario enviado con movimiento:", this.moviment);
      axios.post('/calculamoviment', { moviment: this.moviment })
        .then(response => {  

                          alert('Moviment enviat amb èxit!')})
        .catch(error => console.error('Error al enviar:', error));
    }
  }
};
</script>s