<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use QrCode;
use App\Models\App;
use App\Models\BasePayQrCode;
use App\Models\Template;
use Validator;

class HomeController extends Controller
{
    private $appModel = null;

    public function __construct()
    {
        $this->appModel = new App;
    }

    public function index()
    {

    }

}