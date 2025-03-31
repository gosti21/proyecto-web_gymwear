<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Family;
use App\Repositories\Admin\BaseRepository;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class CategoryController extends BaseAdminController implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:manage categories'),
        ];
    }

    public function __construct()
    {
        $model = new Category();
        $viewName = 'categories';
        $relationships = [
            'family'
        ];
        $extraData = ['families' => Family::class];

        $repository = new BaseRepository($model, $viewName, $relationships, $extraData);
        
        $repository->setRelationChecker(function ($category) {
            return $category->subCategories()->count() > 0;
        });

        parent::__construct($repository);
    }
}
