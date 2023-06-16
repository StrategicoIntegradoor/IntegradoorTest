<div>
    <div class="login-box">
        <div class="login-logo">
            <img src="vistas/img/plantilla/Logo_Integradoor_Cotizador_1.png" class="img-responsive" style="padding:30px 30px 0px 30px">
        </div>

        <div class="login-box-body">
            <p class="login-box-msg">Restablecer contraseña</p>
        </div>
        <div id="app">
            <transition name="fade">
                <div class="modal-cambio-contrasenia" v-if="mostrarModal">
                    <div class="modal-cambio-contrasenia-container">
                        <p class="titulo-modal-cambio-contrasenia">Contraseña actulizada con exito</p>
                        <button class="boton-modal-cambio-contrasenia btn" @click="cerrarModal">Login!</button>
                    </div>
                </div>
            </transition>

            <input type="hidden" ref="codigo" value="<?php echo $_SESSION["codigo"]; ?>">
            <div class="row form-olvido-contrasenia">
                <form>
                    <div class="form-group">
                        <label>Contraseña</label>
                        <input type="password" placeholder="Contraseña" required="required" class="form-control" v-model="password">
                    </div>
                    <div class="form-gruop">
                        <label>Repeite la contraseña</label>
                        <input type="password" placeholder="Confirmación de contraseña" required="required" class="form-control" v-model="passwordRepeat">
                    </div>
                    <div class="row restablecer-button">
                        <div class="col-xs-4">
                            <button type="button" class="btn btn-primary btn-block btn-flat" @click="restablecerContrasenia">Restablecer</button>
                        </div>
                    </div>
                    <p class="error-feedback" v-if="passwordError"><b>{{ MessageErrorPassword }}</b></p>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>
<script>
    const app = new Vue({
        el: '#app',
        data: {
            codigo: '',
            password: '',
            passwordRepeat: '',
            passwordError: false,
            MessageErrorPassword: 'Las contraseñas no coinciden',
            mostrarModal: false
        },
        methods: {
            async restablecerContrasenia() {
                if (this.validarContrasenia()) return
                const requestOptions = {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        codigo: this.codigo,
                        password: this.password
                    })
                }
                await fetch('/app/ajax/cambio_contrasenia.ajax.php', requestOptions)
                    .then(response => response.json())
                    .then(data => {
                        console.log(data)
                        if (data) {
                            this.mostrarModal = true
                            setTimeout(() => {
                                window.location.href = "/app";
                            }, 3000)
                        }
                    })
            },
            validarContrasenia() {
                this.passwordError = this.password !== this.passwordRepeat
            },
            cerrarModal() {
                this.mostrarModal = false
                window.location.href = "http://localhost/integradoorjulian/";
            }
        },
        mounted() {
            this.codigo = this.$refs['codigo'].value
        }
    })
</script>

<style>
    * {
        margin: 0;
        padding: 0;
    }

    .restablecer-button {
        margin-top: 2rem;
    }

    .error-feedback {
        color: #FF0000;
        margin-top: 1rem;
    }

    .modal-cambio-contrasenia {
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

    .titulo-modal-cambio-contrasenia {
        text-align: center;
        font-size: 2rem;
    }

    .boton-modal-cambio-contrasenia {
        text-align: center;
        font-size: 1.5rem;
        background: #88d600;
        color: #FFFFFF;
    }

    .boton-modal-cambio-contrasenia:hover {
        text-align: center;
        font-size: 1.5rem;
        background: #69a500;
        color: #FFFFFF;
    }

    .modal-cambio-contrasenia-container {
        display: flex;
        flex-direction: column;
        align-items: center;
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
</style>