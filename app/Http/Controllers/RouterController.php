<?php

namespace App\Http\Controllers;

use App\Http\Resources\Router\RouterCollection;
use App\Models\Router;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RouterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render("Router/Index", [
            "routers" => new RouterCollection(Router::all())
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "ipAddress" => "required",
            "username" => "required",
            "password" => "required",
            "port" => "required",
        ]);
        $router = Router::query()->create([
            "name" => $request->name,
            "ip_address" => $request->ipAddress,
            "username" => $request->username,
            "password" => $request->password,
            "connect" => true,
            "port" => $request->port,
        ]);
        if ($router) return response()->json(["success" => true, "message" => "Router created successfully"], 201);
        return response()->json(["success" => false, "message" => "Failed to create router"], 400);
    }

    /**
     * Display the specified resource.
     */
    public function show(Router $router)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Router $router)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Router $router)
    {
        //
    }
}
