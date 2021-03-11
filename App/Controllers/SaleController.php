<?php
class SaleController extends Controller{
    public function __construct() {
    }

    public function index()
    {
        view('admin.sales.index', [], "Ventas", "admin");
    }
}