<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proposal;
use App\Models\Fund;

class FundController extends Controller
{
    public function index($id){
        $proposal = Proposal::findOrFail($id);
        $funds = Fund::where('proposal_id', $proposal->id)->get();
        return view('rincian', [
            'funds' => $funds,
            'total' => $funds->sum('nominal'),
            'title' => 'Rincian Penggunaan Dana'
        ]);
    }
}
