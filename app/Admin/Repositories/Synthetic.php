<?php

namespace App\Admin\Repositories;

use App\Models\Synthetic as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Synthetic extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
