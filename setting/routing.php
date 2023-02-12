<?php

use App\Http\Controller\BlogController;
use Takemo101\Egg\Routing\RouteBuilder;

return function (RouteBuilder $r) {
    $r->get('/', [BlogController::class, 'index'])
        ->name('index');
    $r->get('/create', [BlogController::class, 'create'])
        ->name('create');
    $r->get('/[i:id]', [BlogController::class, 'show'])
        ->name('show');
    $r->post('/', [BlogController::class, 'store'])
        ->name('store');
    $r->delete('/[i:id]', [BlogController::class, 'remove'])
        ->name('remove');
};
