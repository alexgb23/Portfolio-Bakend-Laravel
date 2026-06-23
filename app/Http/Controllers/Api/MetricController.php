<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Metric;

class MetricController extends Controller
{
    public function index()
    {
        return response()->json(Metric::orderBy('id', 'desc')->get());
    }
}
