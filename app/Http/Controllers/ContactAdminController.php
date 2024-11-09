<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactAdminController extends Controller
{

    public function contact()
    {

        return view('admin.contact');
    }

    public function contactEdit()
    {

        return view('admin.contactEdit');
    }

    public function contactMail()
    {

        return view('admin.contactMail');
    }
}
