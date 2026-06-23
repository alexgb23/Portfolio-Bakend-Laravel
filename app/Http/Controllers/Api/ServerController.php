<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Server;

class ServerController extends Controller
{
    public function index()
    {
        return response()->json(Server::orderBy('id', 'desc')->get());
    }
}
