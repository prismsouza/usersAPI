<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\HTTP\Request;
use App\Services\UserService;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getAll() 
    {
        return $this->userService->getAll();
    }

    public function get($id) 
    {
        return $this->userService->get($id);
    }

    public function getById($id) 
    {
        return $this->userService->getById($id);
    }

    public function getByNumber($number) 
    {
        return $this->userService->getByNumber($number);
    }

    public function post(Request $request) 
    {
        return $this->userService->post($request);
    }

    public function update($id, Request $request)
    {
        return $this->userService->update($id, $request);
    }

    public function destroy($id)
    {
        return $this->userService->destroy($id);
    }

    public function showForm(Request $request)
    {
        return view('upload');
    }

    public function store(Request $request)
    {
        $upload = $request->file('upload-file');
        $filePath = $upload->getRealPath();

        $file = fopen($filePath, 'r');
        $header = fgetcsv($file);

        while ($lines=fgetcsv($file))
        {
            if ($lines[0]=="") { // if the line is empty
                continue;
            }

            $data = array_combine($header, $lines);
         
            foreach ($data as $key => $d) {
                echo $key . ": ";
                echo $d . " ";
                echo "<br>";
            }
            echo "<br>";
            $data['number'] = preg_replace('/\D/','', $data['number']);
            
            //Table update
            $user = new User();
            $user->create($data);

            
        }
    }
}