<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testDB()
{
    try {
        \DB::connection()->getPdo();
        return "¡Conexión exitosa a la base de datos: " . \DB::connection()->getDatabaseName();
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
}
}
