<?php

namespace App\Http\Controllers\Admin\Api;


use App\Models\User;
use App\Transformers\UserTransformer;

class UsersController extends ApiController
{
    public function lists()
    {
        $users = User::withSort()->withSimpleSearch()->paginate($this->perPage());
        return $this->response->paginator($users, new UserTransformer())
            ->setMeta(User::getAllowSortFieldsMeta() + User::getAllowSearchFieldsMeta());
    }
}