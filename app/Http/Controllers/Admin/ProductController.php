<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Repositories\Admin\BaseRepository;
use Illuminate\Http\Request;

class ProductController extends BaseAdminController
{
    public function __construct()
    {
        $model = new Product();
        $viewName = 'products';
        $relationships = [
            'images'
        ];

        $repository = new BaseRepository($model, $viewName, $relationships);

        parent::__construct($repository);
    }
}
