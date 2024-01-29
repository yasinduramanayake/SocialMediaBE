<?php

namespace Modules\ReviewManagement\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ReviewManagement\Repositaries\ReviewServicesInterfaces;
use Modules\ReviewManagement\Http\Requests\AddReviewRequest;
use Exception;
use Modules\ReviewManagement\Entities\Reviews;
use Modules\ReviewManagement\Http\Requests\AddContactRequest;

class ReviewManagementController extends Controller
{
    protected $repositoryinterface;

    public function __construct(ReviewServicesInterfaces $repositoryinterface)
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

    /**
     * Store a newly created resource in storage.
     * @param AddReviewRequest $request
     * @return Renderable
     */
    public function store(AddReviewRequest $request)
    {
        try {
            $response =  $this->repositoryinterface->create($request->validated());
            return response()->json(['data' => $response]);
        } catch (\ErrorException $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    // add contact us
    public function addcontact(AddContactRequest $request)
    {
        try {
            $response =  $this->repositoryinterface->addcontact($request->validated());
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Reviews $id)
    {
        try {
            $response =  $this->repositoryinterface->delete($id);
            return response()->json(['data' => $response]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
