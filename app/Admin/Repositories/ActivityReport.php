<?php

namespace App\Admin\Repositories;

use App\Models\ActivityReport as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class ActivityReport extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
