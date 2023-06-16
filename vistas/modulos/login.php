<div id="back"></div>

<div class="login-box">

  <div class="login-logo">

    <img src="vistas/img/plantilla/Logo_Integradoor_Cotizador_1.png" class="img-responsive" style="padding:30px 30px 0px 30px">

  </div>

  <div class="login-box-body">

    <p class="login-box-msg">Ingresar al sistema</p>

    <form method="post">

      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

      </div>
      

      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
      </div>
    </form>

    <!-- VUE INSTANCE
    <div id="app" >
        <transition name="fade">
          <div class="modal-olvido-contrasenia" v-if="mostrarModal">
            <div class="modal-olvido-contrasenia-container">
              <p class="titulo-modal-olvido-contrasenia">Le hemos enviado un correo</p>
              <button class="boton-modal-olvido-contrasenia btn" @click="cerrarModal">Entendido!</button>
            </div>
          </div>
        </transition>
        
        <div class="olvido-contrasenia-container">
          <div class="row">
            <p style="color: #88d600;" id="olvido-contrasenia" @click="pressedShowFormSet"><b>{{ messageButton }}</b></p>
          </div>

          <transition name="fade">
            <div class="row form-olvido-contrasenia" v-if="mostrarFormulario">
              <form>
                <div class="form-group">
                  <label>Correo eléctronico</label>
                  <input type="email" class="form-control" placeholder="Correo" required v-model="correo">
                </div>

                <div class="row">
                  <div class="col-xs-4">
                    <button type="button" class="btn btn-primary btn-block btn-flat" @click="enviarCorreo">Enviar</button>
                  </div>
                </div>

                <p class="error-feedback" v-if="correoError"><b>{{ MessageErrorCorreo }}</b></p>
              </form>
            </div>
          </transition>
        </div> 
    </div> -->
    <!-- END VUE INSTANCE -->
    <br>
    <p><a href="#" onclick="mostrarFormulario()">¿Has olvidado tu contraseña?</a></p>

    <div id="formulario" style="display: none;">
      <form method="POST" class="form-group has-feedback">
        <label for="email">Ingresa tu correo electrónico:</label>
        <div class="form-group has-feedback">
          <input type="text" class="form-control" id="email" name="email" required>
        </div>
        <div id="loader" class="loader" style="display:none"></div>
      <style>
        .loader {
        border: 4px solid #f3f3f3; /* Estilo del borde del cargador */
        border-top: 4px solid #88d600; /* Estilo del borde superior del cargador */
        border-radius: 50%; /* Forma redondeada */
        width: 50px; /* Ancho del cargador */
        height: 50px; /* Alto del cargador */
        animation: spin 1s linear infinite; /* Animación de rotación */
        margin: 0 auto; /* Centrar horizontalmente */
        
      }

     @keyframes spin {
      0% { transform: rotate(0deg); }
     100% { transform: rotate(360deg); }
      }
      </style>

        <div class="row">
          <div class="col-xs-4">
            <button type="button" class="btn btn-primary btn-block btn-flat" onclick="authEmail()">Enviar</button>
          </div>
        </div>
      </form>
    </div>


  </div>
<div>

<?php

  $login = new ControladorUsuarios();
  $login->ctrIngresoUsuario();

  ?>
</div>
  

</div>

</div>



<script src="vistas/js/authChange.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>

<script>

  function mostrarFormulario() {
  document.getElementById("formulario").style.display = "block";}

</script>

<script>
  var app = new Vue({
    el: '#app',
    data: {
      correo: '',
      messageButton: 'Se te olvido la contraseña?',
      pressedShowForm: false,
      mostrarFormulario: false,
      MessageErrorCorreo: 'Correo electrónico incorrecto',
      correoError: false,
      mostrarModal: false
    },
    methods: {
      pressedShowFormSet: function() {
        this.mostrarFormulario = true
      },
      showFormSwitch: function() {
        if (this.pressedShowForm) return true
        return false
      },
      async enviarCorreo () {
        if (!this.validarCorreo()) return
        this.mostrarModal = true
        
        const requestOptions = {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({ enviarcorreo: true,
                                 correo: this.correo })
        };

        await fetch('/app/ajax/olvido_contrasenia.ajax.php', requestOptions)
              .then(response  => response.json())
              .then(data => {
                console.log(data);
              })
      },
      validarCorreo: function() {
        const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        const result = re.test(this.correo)
        this.correoError = result === false ? true : false

        return result
      },
      cerrarModal: function() {
        this.mostrarModal = false
      }
    }
  })
</script>

<style>
  .olvido-contrasenia-container {
    margin-top: 5px;
    padding: 13px;
  }

  #olvido-contrasenia {
    cursor: pointer;
  }

  .fade-enter-active,
  .fade-leave-active {
    transition: opacity .5s
  }

  .fade-enter,
  .fade-leave-to

  /* .fade-leave-active below version 2.1.8 */
    {
    opacity: 0
  }

  .error-feedback {
    color: #FF0000;
    margin-top: 1rem;
  }

  .modal-olvido-contrasenia {
    background: #F6F6F6;
    border-radius: 10px;
    height: 12rem;
    width: 38rem;
    position: fixed;
    top: 2rem;
    right: 2rem;
    margin-right: auto;
    margin-left: auto;
    margin-top: auto;
    margin-bottom: auto;
    box-shadow: 0 7px 30px -10px rgba(150, 170, 180, 0.5);
    padding: 2rem;
  }

  .titulo-modal-olvido-contrasenia {
    text-align: center;
    font-size: 2rem;
  }

  .boton-modal-olvido-contrasenia {
    text-align: center;
    font-size: 1.5rem;
    background: #88d600;
    color: #FFFFFF;
  }

  .boton-modal-olvido-contrasenia:hover {
    text-align: center;
    font-size: 1.5rem;
    background: #69a500;
    color: #FFFFFF;
  }

  .modal-olvido-contrasenia-container {
    display: flex;
    flex-direction: column;
    align-items: center;
  }
</style>