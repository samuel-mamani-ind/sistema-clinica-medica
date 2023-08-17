<?php
$contra='admin';
$nuevacontra=password_hash($contra,PASSWORD_DEFAULT,['cost'=>10]);
echo $nuevacontra;

?>