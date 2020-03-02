<?php

namespace App\Repositories;
use App\Models\User;
use Illuminate\Http\Request;
use App\Repositories\UserRepositoryInterface;

class UserRepositoryEloquent implements UserRepositoryInterface
{
    private $model;

    public function __construct(User $users)
    {
        $this->model = $users;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function get($id)
    {
        return $this->model->find($id);
    }    

    public function getById($id)
    {
        return $this->model->find($id);
    }

    public function getByNumber($number)
    {
        return $this->model->find($number);
    }

    public function post(Request $request)
    {
        return $this->model->create($request->all());
    }

    public function update($id, Request $request)
    {
        return $this->model->find($id)
            ->update($request->all());
    }

    public function destroy($id)
    {
        return $this->model->find($id);
    }
}