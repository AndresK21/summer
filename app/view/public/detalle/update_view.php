<div class="white-text">.</div>

<div class="center-align"><h4>Editar cantidad</h4></div>

<!--Formulario para insertar las categorias-->
<div class="container">
    <div class="row">
        <form class="col s12" method="post">
            <div class="row">
                <div class="input-field col s10">
                    <input id="disabled" disabled type="text" class="validate" value='<?php print($producto->getId_producto())?>' required />
                    <label for="disabbled" class="black-text">Producto</label>
                </div>
                <div class="input-field col s2">
                    <input id="cantida" name="cantidad" type="text" class="validate" autocomplete="off" value='<?php print($producto->getCantidad())?>' required />
                    <label for="cantida" class="black-text">Cantidad</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12 right-align">
                    <a class='btn waves-effect red darken-3' href="index.php"><i class='material-icons'></i>Cancelar</a>
                    <button type='submit' name='actualizar' class='btn waves-effect blue-grey darken-4'><i class='material-icons'>save</i>Guardar cambios</button>
                </div>
            </div>
        </form>
    </div>
</div>