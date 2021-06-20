<?php

session_unset(); // Remove todas as váriáveis de sessão
session_destroy(); // Remove todas as variáveis de sessão
header('location: ../../index.html');

?>
