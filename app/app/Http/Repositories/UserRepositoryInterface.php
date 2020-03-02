<?php
namespace App\Repositories;
use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function getAll();
    public function get($id);
    public function getByNumber($number);
    public function getById($id);
    public function post(Request $request);
    public function update($id, Request $request);
    public function destroy($id);
}