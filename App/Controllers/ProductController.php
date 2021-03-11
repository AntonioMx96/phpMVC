<?php

use App\Entities\Category;
use App\Entities\Product;
use App\Entities\Provider;

class ProductController extends Controller 
{
    public function __construct() {
    }

    public function index()
    {
        $products = Product::get();
        view('admin.products.index', ['products'=>$products], "Productos", "admin");
    }

    public function create(){
        $categories = Category::get();
        $providers = Provider::get();
        view('admin.products.create',  [
            'categories'=>$categories,
            'providers'=>$providers
        ], "Crear Producto", "admin");
    }

    public function store($request)
    {
    }

    public function detail($id){
        view('admin.products.detail');
    }

    public function edit($id){
        $products = Product::find($id)->get();
        $categories = Category::get();
        $providers = Provider::get();
        view('admin.products.edit', [
            'products'=>$products,
            'categories'=>$categories,
            'providers'=>$providers
        ]);
    }

    public function update($request, $id)
    {
        redirect('products/index');
    }
    public function delete($id){
        redirect('products/index');
    }
}
