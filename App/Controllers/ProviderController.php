<?php

use App\Entities\Provider;

class ProviderController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $providers = Provider::get();
        view('admin.providers.index', ['providers' => $providers], 'Proveedores', 'admin');
    }

    public function create()
    {
        $providers = Provider::get();
        view('admin.providers.create', [], 'Crear Proveeddor', 'admin');
    }

    public function store($request)
    {
        //comprobamos si existe una categoria en la base de datos
        $provider = new Provider();
        $provider_name = $provider->exists($request->name);
        $provider_email = $provider->exists($request->email);
        $provider_rfc = $provider->exists($request->rfc);

        //validamo el request
        $is_valid = GUMP::is_valid(array_merge((array)$request), [
            'name' => 'required',
            'email' => 'required',
            'rfc' => 'required',
        ]);

        if ($is_valid == 1 && $provider_name == false && $provider_email == false && $provider_rfc == false) {
            Provider::create((array)$request);
            redirect('provider');
        } else {
            if ($is_valid == 1) {
                $is_valid = [];
                if ($provider_name) {
                    array_push($is_valid, "Ya existe un proveedor registrado en la base de datos");
                } else if ($provider_email) {
                    array_push($is_valid, "Ya existe una email registrado en la base de datos");
                } else if ($provider_rfc) {
                    array_push($is_valid, "Ya existe un RFC registrado en la base de datos");
                }
            }
            view('admin.providers.create', [
                "errors" => $is_valid,
                "provider" => $request
            ], 'Registrar categoria', 'admin');
        }
    }

    public function detail($id)
    {
        view('admin.providers.detail');
    }

    public function edit($id)
    {
        $providers = Provider::find($id);
        view('admin.providers.edit', [
            'providers' => $providers
        ], 'Editar Proveedor', 'admin');
    }

    public function update($request, $id)
    {
        redirect('providers/index');
    }
    public function delete($id)
    {
        redirect('providers/index');
    }
}
