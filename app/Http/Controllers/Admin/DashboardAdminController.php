<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class DashboardAdminController extends Controller
{
    protected $User;

    public function __construct(User $User)
    {
        $this->User = $User;
    }

    public function index()
    {
        return view('admin.dashboard_admin', [
            'countAllUsers' => $this->User->countAllUsers(),
            'countUserAdmin' => $this->User->countUserAdmin(),
            'countUserCustomerService' => $this->User->countUserCustomerService(),
            'countUserKadivOffset' => $this->User->countUserKadivOffset(),
            'countUserKadivProduction' => $this->User->countUserKadivProduction(),
            'countUserKadivFinishing' => $this->User->countUserKadivFinishing()
        ]);
    }
}