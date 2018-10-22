<div class="white-text">.</div>

<div class="center-align"><h4>Compras realizadas</h4></div>

<div class="container">

<?php
    print($producto->getTota());
?>
    <!--Parte de clasificacion de la tabla-->
    <table class="bordered highlight responsive-table espacio_inf">
        <thead class="teal lighten-1 black-text">
            <tr>
                <th>Id del pedido</th>
                <th>Fecha</th>
                <th>Total</th>
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
                        <td>$row[id_pedido]</td>
                        <td>$row[fecha]</td>
                        <td>$row[total]</td>
                        <td>
                            <a class='waves-effect waves-light modal-trigger espacio tooltipped' data-position='right' data-delay='50' data-tooltip='Ver detalle de compra' href='detalle.php?id=$row[id_pedido]'><i class='material-icons blue-grey-text text-darken-4 prefix'>assignment</i></a>
                            <a class='waves-effect waves-light modal-trigger espacio tooltipped' data-position='right' data-delay='50' data-tooltip='Generar ticket' href='../../app/view/public/detalle/reporte2.php?id=$row[id_pedido]'><i class='material-icons blue-grey-text text-darken-4 prefix'>event_note</i></a>
                        </td>
                    </tr>
                    ");
                }
            ?>
        </tbody>
    </table>
    <div class="row right-align">
        <a class='btn waves-effect teal lighten-1' href="../index/index.php"><i class='material-icons'></i>Entendido</a>
    </div>

</div>