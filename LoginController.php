<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class LoginController extends Controller
{
    public function index()
    {
        // Load the login form view
        return view('auth/login');
    }

    public function authenticate()
    {
        // Get posted data from the login form
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        // Validate input (simplified)
        if (empty($username) || empty($password)) {
            $data['error'] = 'Username and password are required.';
            return view('auth/login', $data);
        }

        // Check credentials (replace with your actual logic)
        // For demonstration, using hardcoded credentials
        if ($username === '1811795' && $password === 'dhuncho14') {
            // Set session data (replace with your actual logic)
            $session = session();
            $userData = [
                'username' => $username,
                'logged_in' => true
            ];
            $session->set($userData);

            // Redirect to home page or any other page after successful login
            return redirect()->to('/');
        } else {
            $data['error'] = 'Invalid username or password.';
            return view('auth/login', $data);
        }
    }

    public function logout()
    {
        // Destroy session and log out user
        $session = session();
        $session->destroy();

        // Redirect to login page after logout
        return redirect()->to('/login');
    }
}
