<?php

$views_linux = __DIR__."/../App/Views";
$views_windows = __DIR__."\\..\\App\\Views";

if(PHP_OS === "WINNT")
{
    define("DIR_VIEWS", $views_windows);
    define("UPLOAD_PATH", __DIR__ . "\\..\\Public\\upload\\img\\");
    define("IMGS", "Public\\upload\\img\\");
}
else if(PHP_OS === "Linux")
{
    define("DIR_VIEWS",__DIR__."/../App/Views");
    define("UPLOAD_PATH", __DIR__ . "/../Public/upload/img/");
    define("IMGS", "Public/upload/img/");
}

