<?php

use App\Entities\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
        $categories = Category::get();
        view('admin.categories.index', ['categories' => $categories], 'Categorias', 'admin');
    }

    public function create()
    {
        view('admin.categories.create', [], 'Registrar categoria', 'admin');
    }

    public function store($request)
    {
        //comprobamos si existe una categoria en la base de datos
        $category = new Category();
        $category = $category->exists($request->name);

        //validamo el request
        $is_valid = GUMP::is_valid(array_merge((array)$request), [
            'name' => 'required',
        ]);

        if ($is_valid == 1 && $category == false) {
            Category::create((array)$request);
            redirect('category');
        } else {
            if ($is_valid == 1) {
                $is_valid = [];
                array_push($is_valid, "Ya existe una categoria registrada en la base de datos");
            } 
            view('admin.categories.create', [
                "errors" => $is_valid,
                "category" => $request
            ], 'Registrar categoria', 'admin');
        }
    }

    public function detail($id)
    {
        $category = Category::find($id);
        view(
            'admin.categories.detail',
            [
                "category" => $category
            ],
            $category->name,
            'admin'
        );
    }

    public function edit($id)
    {
        $category = Category::find($id);
        view('admin.categories.edit', [
            'category' => $category
        ], "Editar Categoria", "admin");
    }

    public function update($request, $id)
    {
        
        $category = Category::find($id);
        $category2 = new Category();
        $exists = $category2->exists($request->name, $category);
        $is_valid = GUMP::is_valid(array_merge((array)$request), [
            'name' => 'required',
        ]);

        if ($is_valid == 1 && $exists==false) {
            $category->update((array)$request);
            redirect('category');
        } else {
            if ($is_valid == 1) {
                $is_valid = [];
                array_push($is_valid, "Ya existe una categoria registrada en la base de datos");
            }
            view(
                'admin.categories.edit',
                [
                    "errors" => $is_valid,
                    "category" => $request
                ],
                'Editar Categoria',
                'admin'
            );
        }
    }
    public function delete($id)
    {
        Category::destroy($id);
        response("se ha eliminado correctamente " . $id);
    }
}
