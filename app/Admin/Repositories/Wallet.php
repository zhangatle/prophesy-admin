<?php

namespace App\Admin\Repositories;

use App\Models\Wallet as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class Wallet extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
