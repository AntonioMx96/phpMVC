<?php


function template($path, $data = [])
{
    $view = new Template('resources/templates/' . $path . '.html', [$data]);
    echo $view;
}

function layout($child = null,  $title = null)
{
    $view = new Template('resources/app.html', [
        'title' => $title,
        'child' => $child
    ]);
    echo $view;
}

function view($path, $title = null, $data = [])
{
    $path = str_replace(".", "/", $path);
    $view = new Template('resources/Views/' . $path . '.html', [$data]);
    layout($view, $title);
}
