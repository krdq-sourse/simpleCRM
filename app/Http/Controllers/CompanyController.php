<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CompanyRepositoryInterfaces;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private CompanyRepositoryInterfaces $companyRepository;

    public function __construct(CompanyRepositoryInterfaces $companyRepository)
    {
        $this->middleware('auth');
        $this->companyRepository = $companyRepository;
    }

    public function index()
    {
        $companies = $this->companyRepository->all();
        return view('company', ['companies' => $companies]);
    }

    public function getClientCompanies()
    {
        //
    }
}
