<div class="white-text">.</div>

<div class="center-align"><h4>Crear presentaci&oacute;n</h4></div>

<div class="row">
    <form class="col s12" method="post">
        <div class="row">
            <div class="input-field col s12">
                <input id="presenta" type="text" name="presentacion" class="validate" autocomplete="off" value='<?php print($presentaciones->getPresentacion())?>' required />
                <label for="presenta" class="black-text">Presentaci&oacute;n</label>
            </div>
        </div>
        <div class="row">
            <div class="col s12 right-align">
                <a class='btn waves-effect red darken-3' href="index.php"><i class='material-icons'></i>Cancelar</a>
                <button type='submit' name='crear' class='btn waves-effect blue-grey darken-4'><i class='material-icons'>save</i>Guardar cambios</button>
            </div>
        </div>
    </form>
</div>