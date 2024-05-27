<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyCollection;
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
        //
    }

    /**
     * Display the specified company.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id)
    {
        //
    }
}
