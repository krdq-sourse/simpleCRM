<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use App\Repositories\Interfaces\CompanyRepositoryInterfaces;
use App\Models\User;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private CompanyRepositoryInterfaces $companyRepository;

    /**
     * @param CompanyRepositoryInterfaces $companyRepository
     *
     * @return void
     */
    public function __construct(CompanyRepositoryInterfaces $companyRepository)
    {
        $this->middleware('auth');
        $this->companyRepository = $companyRepository;
    }

    public function index(Request $request)
    {
        $rowsPerPage = ($request->get('rowsPerPage') > 0)
            ? $request->get('rowsPerPage')
            : 0;

        $companies = $rowsPerPage
            ? $this->companyRepository->paginate($rowsPerPage)
            : $this->companyRepository->all();

        return response($companies->toJson(), 200);
    }

    public function getClientCompanies($id)
    {
        $user      = User::find($id);
        $companies = $this->companyRepository->getByUser($user);
        return response($companies->toJson(), 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCompanyRequest $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreCompanyRequest $request)
    {
        $validated = $request->validated();
        $this->companyRepository->create($validated);

        return $this->respondSuccess(
            __('messages.saved_successfully')
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
