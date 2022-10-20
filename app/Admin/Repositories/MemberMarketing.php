<?php

namespace App\Admin\Repositories;

use App\Models\MemberMarketing as Model;
use Dcat\Admin\Repositories\EloquentRepository;

class MemberMarketing extends EloquentRepository
{
    /**
     * Model.
     *
     * @var string
     */
    protected $eloquentClass = Model::class;
}
