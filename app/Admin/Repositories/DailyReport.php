<?php

namespace App\Admin\Repositories;

use App\Models\DailyReport as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class DailyReport extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
