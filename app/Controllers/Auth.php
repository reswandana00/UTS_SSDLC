<?php // app/Controllers/Auth.php
namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
public function login()
{
    helper(['form']);
    $user = null; 

if ($this->request->getPost('username') === 'demo' && 
    $this->request->getPost('password') === 'demo') {
    session()->set([
        'username' => 'user',
        'role'     => 'demo',
        'access_expires' => date('Y-m-d H:i:s', strtotime('+10 minutes'))
    ]);
    return redirect()->to('/dashboard');
}
    

    return view('login');
}
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}

// Versi menggunakan database tapi untuk demo
// Password: demo
// Username: demo

// <?php // app/Controllers/Auth.php
// namespace App\Controllers;

// class Auth extends BaseController
// {
//     public function login()
//     {
//         helper(['form']);

//         // Handle POST (login attempt)
//         if ($this->request->getMethod() === 'post') {
//             $username = $this->request->getPost('username');
//             $password = $this->request->getPost('password');

//             // Hardcoded credentials for demo
//             if ($username === 'demo' && $password === 'demo') {
//                 session()->set([
//                     'username'       => 'demo',
//                     'role'           => 'demo',
//                     'access_expires' => date('Y-m-d H:i:s', strtotime('+10 minutes')),
//                 ]);

//                 return redirect()->to('/dashboard');
//             }

//             // Authentication failed
//             session()->setFlashdata('error', 'Invalid username or password.');
//             return redirect()->to('/login');
//         }

//         // GET – show login form
//         return view('login');
//     }

//     public function logout()
//     {
//         session()->destroy();
//         return redirect()->to('/login');
//     }
// }
