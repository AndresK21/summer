<?php
require_once("../../app/view/dashboard/templates/page.class.php");
Page::templateHeader("Detalle");
require_once("../../app/controllers/dashboard/clientes/detalle_controller.php");
Page::templateFooter();
?>