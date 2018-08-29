<div class="white-text">.</div>

<div class="center-align"><h4>Detalle de la compra</h4></div>

<div class="container">
    <!--Parte de clasificacion de la tabla-->
    <table class="bordered highlight responsive-table espacio_inf">
        <thead class="blue-grey darken-4 white-text">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
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
                    </tr>
                    ");
                }
            ?>
        </tbody>
    </table>
    <div class="row right-align">
        <a class='btn waves-effect green darken-3' href="../clientes/index.php"><i class='material-icons'></i>Volver</a>
        <a class='btn waves-effect green darken-3' href="../clientes/index.php"><i class='material-icons'></i>Entendido</a>
    </div>

</div>