<?php

namespace App\Http\Controllers\Admin\Api;


use App\Models\User;
use App\Services\Admin\UserService;
use App\Transformers\UserTransformer;

class UsersController extends ApiController
{
    /**
     * 返回学生列表
     * @return \Dingo\Api\Http\Response
     */
    public function lists()
    {
        $users = User::withSort()->withSimpleSearch()->paginate($this->perPage());
        return $this->response->paginator($users, new UserTransformer())
            ->setMeta(User::getAllowSortFieldsMeta() + User::getAllowSearchFieldsMeta());
    }

    /**
     * 返回$userId信息和提交的答案的正确率
     * @param UserService $user
     * @return \Dingo\Api\Http\Response
     */
    public function getUser(UserService $user)
    {
        $userId = 2;
        $getUsers = $user ->getUsers($userId);
        return $this->response->item($getUsers ,new UserTransformer())
            ->addMeta('correctRate' , $user->getCorrectRate($userId));
    }
}