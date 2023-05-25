<?php

namespace App\Http\Controllers;

use App\Http\Livewire\UserFiles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class UtilitiesController extends Controller
{
    public function softwares()
    {
        //abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('utilities.softwares');
    }

    public function userdocuments()
    {
        //abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('utilities.userdocuments');
    }
}
