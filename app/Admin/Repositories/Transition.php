<?php

namespace App\Admin\Repositories;

use App\Models\Transition as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Transition extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
