<?php

namespace Modules\ServiceManagement\Http\Controllers;

use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ServiceManagement\Http\Requests\AddServiceRequest;
use App\Http\Requests\ScrapingRequest;
use Modules\ServiceManagement\Repositaries\ServicesManagementInterfaces;

class ServiceManagementController extends Controller
{
    protected $repositoryinterface;

    public function __construct(
        ServicesManagementInterfaces $repositoryinterface
    ) {
        $this->repositoryinterface = $repositoryinterface;
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'subcategory_id' => 'required',
        ]);
        try {
            $responseData = $this->repositoryinterface->index(
                $validatedData
            );
            return response()->json(['data' => $responseData], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

   

    public function scraper(ScrapingRequest $request) {

        try {
            $responseData = $this->repositoryinterface->scraper(
                $request->validated()
            );
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
    public function store(AddServiceRequest $request)
    {
        try {
            $responseData = $this->repositoryinterface->create(
                $request->validated()
            );
            return response()->json(['data' => $responseData], 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('servicemanagement::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('servicemanagement::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
