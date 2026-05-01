<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Start session explicitly (CI4 lazy-loads it)
        $session = session();

        if (!$session->get('user_id')) {

            // Store the originally requested URL so we can redirect back after login
            $session->setFlashdata('redirect_url', current_url());
            $session->setFlashdata('error', 'Please log in to continue.');

            return redirect()->to(base_url('auth/login'));
        }
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // nothing needed after
    }
}