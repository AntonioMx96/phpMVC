<?php


function template($path, $data = []): void
{
    $path = str_replace(".", "/", $path);
    $view = new Template('resources/templates/' . $path . '.html', [$data]);
    echo $view;
}

function layout($child = null,  $title,  $templateLayout, $errors): void
{
    
    if (is_null($templateLayout)) {
        $view = new Template('resources/app.html', [
            'title' => $title,
            'child' => $child,
            'errors' => $errors
        ]);
    } else {
        $view = new Template('resources/Views/layouts/' . $templateLayout . '.html', [
            'title' => $title,
            'child' => $child,
            'errors' => $errors
        ]);
    }
    echo $view;
}

function view(string $path,  array $data = [], string $title = null, string $templateLayout = null): void
{
    $path = str_replace(".", "/", $path);
    $view = new Template('resources/Views/' . $path . '.html', [$data, $title]);
    layout($view, $title, $templateLayout, $data["errors"]);
}
