<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Node;

class NodeController extends Controller
{
    public function index()
    {
        return response()->json(Node::orderBy('id', 'desc')->get());
    }
}
