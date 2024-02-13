<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Noauth implements FilterInterface
{
    public function before(RequestInterface $request)
    {
        // Do something here
        if (session()->get('isLoggedIn')) {
            // return redirect()->to(base_url() . '/RebornHome/HomeReborn');
            return redirect()->to(base_url() . '/SimrsHome/HomeSimrs');
        }
    }

    //--------------------------------------------------------------------

    public function after(RequestInterface $request, ResponseInterface $response)
    {
        // Do something here
    }
}
