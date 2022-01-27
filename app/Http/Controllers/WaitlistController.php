<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Waitlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WaitlistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => ['required', 'string'],
            'email_address' => 'required|unique:waitlists',
            'waitlister_type' => ['required', 'string', Rule::in(['Investor', 'Asset listers'])],
            'description' => ['nullable', 'string', Rule::requiredIf($request->waitlister_type == 'Assets lister')]
        ], $messages = [
            'in' => 'The :attribute must be one of the following types: :values',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => "Input validation error",
                'errors' => $validator->errors()->all()
            ], 400);
        }

        $waitlister = Waitlist::create([
            'fullname' => $request->fullname,
            'email_address' => $request->email_address,
            'waitlister_type' => $request->waitlister_type,
            'description' => $request->description,
        ]);

        return response()->json($waitlister, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
