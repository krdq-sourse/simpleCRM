<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Repositories\Interfaces\CompanyRepositoryInterfaces;
use App\Repositories\Interfaces\UserRepositoryInterfaces;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    private CompanyRepositoryInterfaces $companyRepository;
    private UserRepositoryInterfaces $userRepository;

    /**
     * @param CompanyRepositoryInterfaces $companyRepository
     * @param UserRepositoryInterfaces    $userRepository
     *
     * @return void
     */
    public function __construct(
        CompanyRepositoryInterfaces $companyRepository,
        UserRepositoryInterfaces $userRepository
    ) {
        $this->middleware('auth');
        $this->companyRepository = $companyRepository;
        $this->userRepository    = $userRepository;
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
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

    /**
     * @param Request $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function viewIndexAction(Request $request)
    {
        $companies = $this->companyRepository->paginate(self::DEFAULT_PAGINATION_VALUE);
        return view('company.index', ['companies' => $companies]);
    }

    /**
     * @param $id
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function getClientCompanies(Request $request)
    {
        try {
            $id = $request->get('client_id');
            $user      = $this->userRepository->getById($id);
            $companies = $this->companyRepository->getByUser($user);
            $response = $this->respondSuccess(
                __('company.get-client-companies_successfully'),
                [
                    'data' => $companies->toJson(JSON_UNESCAPED_UNICODE),
                ]
            );
        } catch (\Throwable $throwable) {
            $response = $this->respondWentWrong($throwable);
        }

        return $response;
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
        try {
            $company  = $this->companyRepository->getById($id);
            $response = $this->respondSuccess(
                __('company.show_successfully'),
                [
                    'data' => $company->toJson(JSON_UNESCAPED_UNICODE),
                ]
            );
        } catch (\Throwable $throwable) {
            $response = $this->respondWentWrong($throwable);
        }

        return $response;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function edit($id)
    {
        $company = $this->companyRepository->getById($id);
        if (!$company) {
            abort(404);
        }

        return view('company.edit')->with(['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, $id)
    {
        try {
            $validated = $request->validated();

            $company = $this->companyRepository->getById($id);
            $company->update($validated);
            $response = $this->respondSuccess(__('messages.updated_successfully'));
        } catch (\Throwable $throwable) {
            $response = $this->respondWentWrong($throwable);
        }

        return $response;
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
        try {
            $this->companyRepository->delete($id);
            $response = $this->respondSuccess(__('messages.deleted_successfully'));
        } catch (\Throwable $throwable) {
            $response = $this->respondWentWrong($throwable);
        }

        return $response;
    }
}
