<?php

use App\Entities\Product;
use App\Entities\Provider;
use App\Entities\Purchase;

class PurchaseController extends Controller{


    public function index()
    {
        $purchases = Purchase::get();
        view('admin.purchases.index',['purchases' => $purchases], 'Compras', 'admin');
    }

    public function create()
    {
        $providers = Provider::get();
        $products = Product::get();

        view('admin.purchases.create', [
            'providers'=>$providers,
            'products' =>$products
            ]);
    }

    public function store($request)
    {
    }

    public function detail($id)
    {
        view('admin.purchases.detail');
    }
}