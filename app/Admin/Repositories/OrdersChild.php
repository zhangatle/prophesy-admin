<?php

namespace App\Admin\Repositories;

use App\Models\OrdersChild as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class OrdersChild extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
