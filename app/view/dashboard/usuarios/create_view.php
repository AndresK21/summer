<div class="white-text">.</div>

<div class="center-align"><h4>Crear empleado</h4></div>

<div class="container">
    <!--Formulario para insertar los productos-->
    <div class="row">
        <form class="col s12" method="post" enctype='multipart/form-data'>
        <!--Formulario para ingresar nuevo usuario-->
        <div class="row">
            <form>
                <div class="row">
                    <div class="input-field ">
                        <i class="material-icons prefix">person</i>
                        <input name="nombre_completo" id="nombre" type="text" class="validate" autocomplete="off" value='<?php print($empleado->getNombre())?>' required>
                        <label for="nombre" class="black-text">Nombre completo</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field ">
                        <i class="material-icons prefix">email</i> 
                        <input name="correo_electronico" id="email" type="email" class="validate" autocomplete="off" value='<?php print($empleado->getCorreo()) ?>' required />
                        <label for="email" class="black-text">Correo</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field ">
                        <i class="material-icons prefix">account_circle</i>
                        <input name="nombre_usuario" id="usuario" type="text" class="validate" autocomplete="off" value='<?php print($empleado->getUsuario())?>' required>
                        <label for="usuario" class="black-text">Usuario</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col l6 m6 s12">
                        <i class="material-icons prefix">security</i>
                        <input name="contrasena1" id="contrasen" type="password" class="validate" autocomplete="off" value='<?php print($empleado->getContrasena()) ?>' required />
                        <label for="contrasen" class="black-text">Contrase&ntilde;a</label>
                    </div>
                    <div class="input-field col l6 m6 s12">
                        <i class="material-icons prefix">security</i>
                        <input name="contrasena2" id="contrase" type="password" class="validate" autocomplete="off" value='<?php print($empleado->getContrasena()) ?>' required />
                        <label for="contrase" class="black-text">Confirme la contrase&ntilde;a</label>
                    </div>
                </div>
                <div class="row">
                    <div class='file-field input-field col s12 m6 l6'>
                        <div class='waves-effect waves-light btn blue-grey darken-4'>
                            <span><i class='material-icons blue-gray-text text-darken-4'>image</i></span>
                            <input type='file' name='archivo' required/>
                        </div>
                        <div class='file-path-wrapper'>
                            <input type='text' class='file-path validate' placeholder='Seleccione una imagen'/>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col s12 right-align">
                    <a class='btn waves-effect red darken-3' href="index.php"><i class='material-icons'></i>Cancelar</a>
                    <button type='submit' name='crear' class='btn waves-effect blue-grey darken-4'><i class='material-icons'>save</i>Guardar cambios</button>
                </div>
            </div>
        </div>
        </form>
    </div>
</div>