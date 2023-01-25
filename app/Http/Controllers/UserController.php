<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Proposal;
use App\Models\AccFund;

class UserController extends Controller
{
    public function index() {
        $user = \Auth::user();
        $proposals = Proposal::where('user_id', $user->id)->get();
        $accfunds = AccFund::with('proposal')->where('user_id', $user->id)->get();

        $investments = $accfunds->where('status', 'investasi');
        $donations = $accfunds->where('status', 'donasi');

        // Combine investments with same proposal_id
        $new_investments = $investments->reduce(function ($result, $item) {
            if (!isset($result[$item['proposal_id']])) {
                $result[$item['proposal_id']] = $item;
            } else {
                $result[$item['proposal_id']]['nominal'] += $item['nominal'];
            }

            return $result;
        }, []);
        
        // Combine donations with same proposal_id
        $new_donations = $donations->reduce(function ($result, $item) {
            if (!isset($result[$item['proposal_id']])) {
                $result[$item['proposal_id']] = $item;
            } else {
                $result[$item['proposal_id']]['nominal'] += $item['nominal'];
            }

            return $result;
        }, []);

        return view('akun', [
            'user' => $user,
            'proposals' => $proposals,
            'proposal_count' => $proposals->count(),
            'investments' => $new_investments,
            'investment_count' => count($new_investments),
            'donations' => $new_donations,
            'donation_count' => count($new_donations),
            'title' => 'Akun'
        ]);
    }
}
