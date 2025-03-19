<?php
require 'src/session.php';
sessionStart();
$id = (int)$_GET['id'];
if(!empty($_SESSION['panier'])){
    deleteItemSessionById($id );
}
redirect("/");
