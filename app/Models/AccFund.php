<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Proposal;

class AccFund extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }
}
