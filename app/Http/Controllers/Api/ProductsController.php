<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Http\Request;
use Laravel\Passport\HasApiTokens;

class ProductsController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepositoryInterface)
    {
        $this->productRepository = $productRepositoryInterface;
    }

    public function getProducts()
    {
        $products = $this->productRepository->getAll();
        
        return view('product.products', [
            'products' => $products
        ]);
    }
}
