<?php

namespace App\Admin\Repositories;

use App\Models\ActivityDetail as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class ActivityDetail extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
