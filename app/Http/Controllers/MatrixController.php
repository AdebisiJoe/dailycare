<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MatrixController extends Controller
{
    //
  public function __construct()
  {
    $this->middleware('auth');
  }
}