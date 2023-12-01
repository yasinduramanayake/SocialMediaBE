<?php

namespace Modules\CategoryManagement\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\CategoryManagement\Entities\Category;
use Modules\CategoryManagement\Repositaries\CategoryServicesInterfaces;
use Modules\CategoryManagement\Http\Requests\AddCategoryRequest;
use Modules\CategoryManagement\Http\Requests\UpdateCategoryRequest;


class CategoryManagementController extends Controller
{
    protected $repositoryinterface;

    public function __construct(CategoryServicesInterfaces $repositoryinterface)
    {
        $this->repositoryinterface = $repositoryinterface;
    }
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        try {
            $responseData  =  $this->repositoryinterface->index();
            return response()->json(['data' => $responseData], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showMainCategoryServices()
    {
        try {
            $responseData  =  $this->repositoryinterface->showMainCategoryServices();
            return response()->json(['data' => $responseData], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(AddCategoryRequest $request)
    {
        try {
            $response =  $this->repositoryinterface->create($request->validated());
            return response()->json(['data' => $response]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Category $id, UpdateCategoryRequest $request)
    {
        try {
            $response =  $this->repositoryinterface->update($id, $request->validated());
            return response()->json(['data' => $response]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Category $id)
    {
        try {
            $response =  $this->repositoryinterface->delete($id);
            return response()->json(['data' => $response]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
