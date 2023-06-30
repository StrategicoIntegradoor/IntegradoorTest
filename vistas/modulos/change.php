<body> 



    <div class="login-box">
        
            <div class="login-logo">
                <img src="vistas/img/plantilla/Logo_Integradoor_Cotizador_1.png" class="img-responsive" style="padding:30px 30px 0px 30px">
            </div>

            <div class="login-box-body">
                        
                    <p class="login-box-msg" style="font-weight: bold;">Formulario cambio de contraseña</p>
 
                        <form method="post">
                        <div class="form-group">
                            <label for="cedula">Identificación</label>
                            <input type="text" class="form-control" id="cedula" placeholder="Número de cédula" name="cedula" required>
                        </div>
                        <div class="form-group">
                            <label for="token">Token enviado al correo</label>
                            <input type="text" class="form-control" id="token" placeholder="Token de seguridad" name="token" required>
                        </div>
                        <div class="form-group">
                            <label for="newPassword">Nueva contraseña</label>
                            <input type="password" class="form-control" id="newPassword" placeholder="Nueva contraseña" name="newPassword" required>
                        </div>
                        <div class="form-group">
                            <label for="autPassword">Repita su nueva contraseña</label>
                            <input type="password" class="form-control" id="autPassword" placeholder="Verificación contraseña nueva" name="autPassword" required>
                        </div>
                            <br>
                        <div class="text-center">
                            <button type="button" class="btn btn-primary btn-block btn-flat" onclick="authInfo()">Enviar</button>
                        </div>
                    </form>
                
            </div>
    </div>

</body>

<script src="vistas/js/change.js"></script>

<script>
  document.addEventListener("keydown", function(event) {
    if (event.keyCode === 13) {
      event.preventDefault();
            authInfo();
    }
  });
</script>