<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Http\Resources\CompanyCollection;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Support\Facades\Gate;

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
    public function store(CompanyRequest $request)
    {
        return new CompanyResource(Company::create($request->validated()));
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
    public function update(CompanyRequest $request, Company $company)
    {
        Gate::authorize('update', $company);
        $company->update($request->validated());
        return new CompanyResource($company);
    }

    /**
     * Remove the specified company from storage.
     */
    public function destroy(Company $company)
    {
        Gate::authorize('delete', $company);
        return response()->json(['success' => $company->delete()]);
    }
}
