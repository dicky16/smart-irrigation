<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deskripsi;
use App\Models\ContactUs;

class PesanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        return view('admin.pesan.pesan',[
           
            'title'=>'contact',
            'contact_us' =>  ContactUs::paginate(2)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ContactUs  $contactus
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contactus = ContactUs::find($id)->first();
        return view('admin.pesan.show',compact('contactus'));
        //  return view('admin.pesan.show', [
        //      "title" => "contact",
        //       "contact_us" => $contactus
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ContactUs  $contactus
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactUs $contactus)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ContactUs  $contactus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ContactUs $contactus)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ContacUs  $contactus
     * @return \Illuminate\Http\Response
     */
    public function destroy(ContactUs $contactus)
    {
        ContactUs::destroy($contactus->id);
        return redirect('/admin/pesan/pesan')->with('success','Pesan sekarang sudah dihapus');
    }
}