<?php

namespace App\Admin\Repositories;

use App\Models\MemberActivityResult as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class MemberActivityResult extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
