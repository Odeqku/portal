<?php

namespace App\Http\Controllers;

use App\Models\AdminToken;
use Illuminate\Http\Request;

class TokenController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');

        
    // }

    

    
    public function __construct()
    {
        
            $this->middleware(function ($request, $next){
                if (auth()->user() && auth()->user()->profile->profileable_type === 'Admin') {
                    return $next($request);
                }

                return redirect('/home'); 
            });
        
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
            return view('adminToken.token');

        
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'admin_token' => 'required',
        ]);

        AdminToken::firstOrcreate([
            'admin_token' => $request['admin_token'],
        ]);

        return redirect('/home')->with('success', 'Token Created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
