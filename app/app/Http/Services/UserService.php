<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use App\Repositories\UserRepositoryInterface;
use Symfony\Component\HttpFoundation\Response;

class UserService
{
    private $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getAll()  // get "/api/users"
    {
       //return "get all UserService Class";
        $users = $this->userRepository->getAll();

        try {
            if (count($users) > 0) {
                //return "tem usuarios";
                return response()->json($users, Response::HTTP_OK);
            } else {
                //return "nao tem usuarios";
                return response()->json([], Response::HTTP_OK);
            }
        }
        catch (QueryException $exception) {
            return response()->json(['error' => 'Erro de conexao com BD'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function get($id)  // get "/{id}"
    {
        $user = $this->userRepository->get($id);
        if ($user) {
            //return "Existe o usuario " . $id;
            return response()->json($user, Response::HTTP_OK);
        } else {
            //return "Nao existe usuario " . $id;
            return response()->json(null, Response::HTTP_OK);
        }
    }

    public function getById($id)  // get "/{id}"
    {
        $user = $this->userRepository->getById($id);
        if ($user) {
            return response()->json($user, Response::HTTP_OK);
        }
        return response()->json(null, Response::HTTP_OK);
    }

    public function getByNumber($number) // get "/{id}"
    { 
        $user = $this->userRepository->getByNumber($number);
        $user = DB::table('users')->where('number',$number)->get();
        
        if ($user) {
            return response()->json($user, Response::HTTP_OK);
        } 
        return response()->json(null, Response::HTTP_OK);
    }

    public function post(Request $request) // post "/"
    { 
        $user = $this->userRepository->post($request);
        return response()->json($user, Response::HTTP_CREATED);
    }

    public function update($id, Request $request) // put "/{id}"
    { 
        $user = $this->userRepository->update($id, $request);
        return response()->json($user, Response::HTTP_OK);
    }

    public function destroy($id) // delete "/{id}"
    { 
        $this->userRepository->destroy($id)
            ->delete();
        return response()->json(null, Response::HTTP_OK);       
    }
}