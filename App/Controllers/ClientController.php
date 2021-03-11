<?php

use App\Entities\Client;

class ClientController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $categories = Client::get();
        view('admin.clients.index', ['categories' => $categories]);
    }

    public function create()
    {
        $categories = Client::get();

        view('admin.clients.create');
    }

    public function store($request)
    {
    }

    public function detail($id)
    {
        view('admin.clients.detail');
    }

    public function edit($id)
    {
        $clients = Client::find($id)->get();
        view('admin.clients.edit', [
            'clients' => $clients
        ]);
    }

    public function update($request, $id)
    {
        redirect('clients/index');
    }
    public function delete($id)
    {
        redirect('clients/index');
    }
}
