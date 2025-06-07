<?php

namespace App\Http\Controllers;

use App\Models\employer;
use App\Http\Requests\StoreemployerRequest;
use App\Http\Requests\UpdateemployerRequest;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreemployerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(employer $employer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(employer $employer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateemployerRequest $request, employer $employer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(employer $employer)
    {
        //
    }
}
