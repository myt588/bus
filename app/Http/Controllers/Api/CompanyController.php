<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Company;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CompanyController extends ApiController
{
    protected $companies;

    function __construct(Company $companies)
    {
        $this->companies = $companies;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data = $this->companies->paginate(5);
        return $this->paginate();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = [
            'name'              => $request->input('name'),
            'year_founded'      => $request->input('year_founded'),
            'rating'            => $request->input('rating'),
            'verified'          => $request->input('verified'),
        ];
        $company = $this->companies->fill($data);
        $company->save();
        return $this->push(200, 20000, 'Company Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $company= $this->companies->findOrFail($id);
        $this->data = $company;
        return $this->push();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = $this->companies->findOrFail($id)->update($request->all());
        return $this->push(200, 20000, 'Company Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = $this->companies->findOrFail($id)->delete();
        return $this->push(200, 20000, 'Company Deleted');
    }
}
