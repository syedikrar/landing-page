<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Landing;
use App\Models\Campaign;

class ReportsController extends Controller
{
    public function index(){
        
        return Inertia::render('Report/Index',[
            'landings'=>auth()->user()->landings()->latest()->paginate(15)->through(fn ($landing) => [
                'id' => $landing->id,
                'name' => ucfirst($landing->name) ?? '',
                'campaign' => $landing->campaign->name ?? '',
                'domain' => $landing->domain,
                'links' => $landing->links,
                'views'=> count($landing->views),
                'entries'=> count($landing->form->entries),
                'valid_leads'=> count($landing->form->entries()->where('valid',1)->get()),
                'invalid_leads'=> count($landing->form->entries()->where('valid',0)->get()),
                'api_errors'=> count($landing->form->entries()->where('api_response_error',1)->get()),
                'form_id'=>$landing->form->id ?? null,
            ]),
            'campaigns'=>Campaign::where(['user_id'=> auth()->user()->id,'status'=>'active'])->latest()->get(),
        ]);
    }
}
