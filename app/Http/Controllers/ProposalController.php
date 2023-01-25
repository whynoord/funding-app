<?php

namespace App\Http\Controllers;

use App\Models\Proposal;
use App\Models\Fund;
use Illuminate\Http\Request;
use App\Http\Requests\ProposalRequest;
use App\Models\AccFund;
use Carbon\Carbon;

class ProposalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::check()) {
            $user_id = \Auth::user()->id;
            $proposals = Proposal::with('accfunds')->where('user_id', '!=', $user_id)->latest()->get();
        } else {
            $proposals = Proposal::with('accfunds')->get();
        }

        return view('home', [
            'proposals' => $proposals,
            'title' => 'Home'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('buat-proposal', ['title' => 'Buat Proposal']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prop = new Proposal;
        $prop['user_id'] = \Auth::user()->id;
        $prop['name'] = $request->name;
        $prop['description'] = $request->description;
        $prop['capital'] = $request->capital;
        $prop['share'] = $request->share;
        $prop['detail'] = $request->detail;
        $prop->save();
        
        $nominal =  $request->input('nominal', []);
        $usage =  $request->input('usage', []);
        $results = [];
        foreach ($nominal as $index => $unit) {
            $results[] = [
                'proposal_id' => $prop->id,
                'nominal' => $nominal[$index],
                'usage' => $usage[$index],
                'created_at' => Carbon::now()
            ];
        }
        Fund::insert($results);

        return redirect()->route('akun');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proposal = Proposal::with('accfunds')->findOrFail($id);
        $accfund = $proposal->accfunds->pluck('nominal')->sum();
        $persen = ($accfund)/($proposal->capital)*100;
        $investasi = $proposal->accfunds->where('status', 'investasi')->count();
        $donasi = $proposal->accfunds->where('status', 'donasi')->count();

        return view('detail', [
            'proposal' => $proposal,
            'accfund' => $accfund,
            'persen' => $persen,
            'investasi' => $investasi,
            'donasi' => $donasi,
            'title' => 'Detail Proposal'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function edit(Proposal $proposal, $id)
    {
        $proposal = Proposal::findOrFail($id);
        return view('edit-proposal',[
            'proposal' => $proposal
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function update(ProposalRequest $request, $id)
    {
        $data = $request->all();
        Proposal::findOrFail($id)->update($data);
        return redirect()->route('akun');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proposal  $proposal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proposal $proposal)
    {
        //
    }

    public function kirim_dana($id)
    {
        $proposal = Proposal::with('accfunds')->findOrFail($id);
        $collected = $proposal->accfunds->pluck('nominal')->sum();
        $capital = $proposal->capital;
        $maksimal = $capital - $collected;
        return view('kirim-dana', [
            'proposal_id' => Proposal::findOrFail($id)->id,
            'maksimal' => $maksimal,
            'capital' => $capital,
            'title' => 'Kirim Dana'
        ]);
    }

    public function update_collected(Request $request, $id)
    {
        $proposal = Proposal::with('accfunds')->findOrFail($id);
        $collected = $proposal->accfunds->pluck('nominal')->sum();
        $maksimal = $proposal->capital - $collected;

        $validated_data = $request->validate([
            'nominal' => 'required|numeric|lte:' . $maksimal
        ]);
        AccFund::create([
            'user_id' => \Auth::user()->id,
            'proposal_id' => $proposal->id,
            'status' => $request->status,
            'nominal' => $request->nominal
        ]);

        return redirect()->route('akun');
    }
}

