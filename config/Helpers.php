<?php
function route($route = null)
{
    echo URL . $route;
}

function response(String $message, int $status = 200)
{
    echo json_encode(['status' => $status, 'message' => $message]);
    die();
}

function redirect(String $route = null): void
{
    header("Location:" . URL . $route);
}

function deb($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}

function showOne($data, $code = 200)
{
    echo json_encode(["data" => $data, "code" => $code]);
    die();
}

function validateResponse($data, $code = 200)
{
    echo json_encode(["validation" => $data, "code" => $code]);
    die();
}