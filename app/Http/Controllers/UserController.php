<?php

namespace App\Http\Controllers;

use App\Http\Libraries\BaseApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // view index
    public function index()
    {
        $users = (new BaseApi)->index('/user');

          // return intval(request('page')) + 1;
          if (request('page')) {
            $users = (new BaseApi)->index('/user', [
                'page' => intval(request('page')) - 1
            ]);
        }
        
        return view('user.index')->with(['users' => $users]);
    }

    public function create()
    {
        $users = (new BaseApi)->index('/user');
        return view('user.create')->with('users' , $users);
    }

    public function store(Request $request)
    {
        // buat variable baru untuk menset parameter agar sesuai dengan documentasi
        $payload = [
            'firstName' => $request->input('nama_depan'),
            'lastName' => $request->input('nama_belakang'),
            'email' => $request->input('email'),
        ];

        $baseApi = new BaseApi;
        $response = $baseApi->create('/user/create', $payload);

				// handle jika request API nya gagal
        // diblade nanti bisa ditambahkan toast alert
        if ($response->failed()) {
            // $response->json agar response dari API bisa di akses sebagai array
            $errors = $response->json('data');
            return to_route('users.create')->withErrors($errors)->withInput();
        }

        return to_route('users.index')->with('message', 'Data Masuk');
    }

    public function edit($id)
    {
        //kalian bisa coba untuk dd($response) untuk test apakah api nya sudah benar atau belum
        //sesuai documentasi api detail user akan menshow data detail seperti `email` yg tidak dimunculkan di api list index
        $response = (new BaseApi)->detail('/user', $id);
        return view('user.edit')->with([
            'user' => $response->json()
        ]);
    }

    public function update(Request $request, $id)
    {
     //column yg bisa di update sesuai dengan documentasi dummyapi.io hanyalah
        // `fisrtName`, `lastName`
        $payload = [
            'firstName' => $request->input('nama_depan'),
            'lastName' => $request->input('nama_belakang'),
        ];

        $response = (new BaseApi)->update('/user', $id, $payload);

        if ($response->failed()) {
            $errors = $response->json('data');

            return to_route('users.edit', $id)->withErrors($errors)->withInput();
        }

        return to_route('users.index')->with('message', 'Update Successfull !');
    }

    public function destroy($id)
    {
        $users = (new BaseApi)->delete('/user', $id);

        if($users->failed()) {
            return to_route('users')->with('message-e', 'Delete Error');
        }

        return to_route('users.index')->with('message', 'Delete Success');
        
    }
}
