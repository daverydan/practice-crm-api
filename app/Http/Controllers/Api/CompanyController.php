<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyCollection;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the companies.
     */
    public function index()
    {
        return new CompanyCollection(Company::paginate());
    }

    /**
     * Store a newly created company in storage.
     */
    public function store(Request $request)
    {
        return new CompanyResource(Company::create($request->all()));
    }

    /**
     * Display the specified company.
     */
    public function show(Company $company)
    {
        return new CompanyResource($company);
    }

    /**
     * Update the specified company in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified company from storage.
     */
    public function destroy(Company $company)
    {
        return response()->json(['success' => $company->delete()]);
    }
}
