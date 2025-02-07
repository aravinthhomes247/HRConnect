<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AdminOrHrexecutive implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Check if user is logged in
        if(!session()->get('loggedIn')){
            return redirect()->to('/login'); 
        }else if (session()->get('user_level') != 1 && session()->get('user_level') != 18) {
            return redirect()->to('/permission-denied');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // No action needed after request
    }
}