<?php

function generateNginxConfiguration($apps)
{
    $loader = new Twig_Loader_Filesystem("./templates");
    $twig   = new Twig_Environment($loader);

    $twig->addFilter(new Twig_SimpleFilter('upstream_name', function ($string) {
        return str_replace([".", "-"], ["_", "_"], $string);
    }));

    return $twig->render("nginx.conf", ["apps" => $apps]);
}
