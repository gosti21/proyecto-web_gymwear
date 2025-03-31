<?php

namespace App\Http\Controllers\Admin;

use App\Models\Family;
use App\Repositories\Admin\BaseRepository;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class FamilyController extends BaseAdminController implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            new Middleware('can:manage families'),
        ];
    }

    public function __construct()
    {
        $model = new Family();
        $viewName = 'families';

        $repository = new BaseRepository($model, $viewName);

        $repository->setRelationChecker(function ($family) {
            return $family->categories()->count() > 0;
        });

        parent::__construct($repository);

    }
}
