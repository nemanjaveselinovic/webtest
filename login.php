<?php

require_once("database/MasterDBProvider.php");

$provider = MasterDBProvider::getDBProvider();
print_r($provider);