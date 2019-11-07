<?php

function render(string $path, array $variables = []){
    extract($variables);
    //extract — Va me permettre de sortir les données de mon tableau sous forme de variable
    ob_start();
    require('templates/'.$path.'.html.php');
    $pageContent = ob_get_clean();

    require('templates/layout.html.php');
}

function redirect(string $url): void{
    header("Location: $url");
    exit();
}