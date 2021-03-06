<div class="white-text">.</div>

<div class="center-align"><h4>Detalle de la compra</h4></div>

<div class="container">
    <!--Parte de clasificacion de la tabla-->
    <table class="bordered highlight responsive-table espacio_inf">
        <thead class="teal lighten-1 black-text">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <!--Producto de ejemplo 1-->
            <?php
                foreach($data as $row){
                    print("
                    <tr>
                        <td>$row[nombre]</td>
                        <td>$row[cantidad]</td>
                        <td>$row[subtotal]</td>
                        <td><a class='waves-effect waves-light modal-trigger espacio tooltipped' data-position='right' data-delay='50' data-tooltip='A&ntilde;adir Comentario' href='comentarios.php?id=$row[id_producto]'><i class='material-icons blue-grey-text text-darken-4 prefix'>comment</i></a></td>
                    </tr>
                    ");
                }
            ?>
        </tbody>
    </table>
    <div class="row right-align">
        <a class='btn waves-effect green darken-3' href="../cuenta/compras.php"><i class='material-icons'></i>Volver</a>
        <a class='btn waves-effect green darken-3' href="../index/index.php"><i class='material-icons'></i>Entendido</a>
    </div>

</div>