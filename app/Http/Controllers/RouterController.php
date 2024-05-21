<?php

namespace App\Http\Controllers;

use App\Helpers\RouterOS;
use App\Http\Resources\Router\RouterCollection;
use App\Http\Resources\Router\RouterResource;
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
        try {
            // Connect To Router
            $routerAPI = new RouterOS();
            $connection = $routerAPI->connect($request->ipAddress, $request->username, $request->password);
            if (!$connection) return response()->json(["success" => false, "message" => "Failed to connect to router"], 400);
            // Store Router Details
            $router = Router::query()->create([
                "name" => $request->name ,
                "ip_address" => $request->ipAddress,
                "username" => $request->username,
                "password" => $request->password,
                "connect" => $connection,
                "port" => $request->port,
            ]);
            if ($router) return response()->json(["success" => true, "message" => "Router created successfully"], 201);
            return response()->json(["success" => false, "message" => "Failed to create router"], 400);
        }catch (\Exception $e) {
            return response()->json(["success" => false, "message" => $e->getMessage()], 400);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Router $router)
    {
        return new RouterResource($router);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Router $router)
    {
        $request->validate([
            "name" => "required",
            "ipAddress" => "required",
            "username" => "required",
            "password" => "required",
            "port" => "required",
        ]);
        $update = $router->update([
            "name" => $request->name,
            "ip_address" => $request->ipAddress,
            "username" => $request->username,
            "password" => $request->password,
            "connect" => true,
            "port" => $request->port,
        ]);
        if ($update) return response()->json(["success" => true, "message" => "Router updated successfully"], 200);
        return response()->json(["success" => false, "message" => "Failed to update router"], 400);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Router $router)
    {
        if ($router->delete()) return $this->success("Router deleted successfully");
        return $this->error("Failed to delete router");
    }
}
