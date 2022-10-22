<?php

namespace App\Admin\Repositories;

use App\Models\MemberAccount as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class MemberAccount extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
