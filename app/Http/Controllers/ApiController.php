<?php

namespace App\Http\Controllers;

use App\Models\Tables;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function __invoke(Request $request)
    {
        $tables = Tables::all();
        $tables->transform(fn(Tables $table) => ['value' => strtolower($table->code) . ":" . ($table->is_used ? "ON": "OFF") . ($table->is_used ? "." . $table->duration: "")]);
        return $tables->implode("value", "/");
    }
}
