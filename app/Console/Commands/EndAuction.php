<?php

namespace App\Console\Commands;

use App\Models\Cpr_ad_enquiry;
use App\Models\Cpr_auction;
use App\Models\Cpr_auction_bid;
use App\Models\Cpr_auction_enquiry;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EndAuction extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'End:Auction';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'End Auction At Specific Time';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $auctuons  = Cpr_auction::where('status',1)->where('auction_time', '=',date('Y-m-d H:i:00'))->get();
        foreach ($auctuons as $key => $auctuon) {

        $win = Cpr_auction_bid::where('cpr_auction_id',$auctuon->id)->orderByDesc('bid_amount')->first();
        if(isset($win))
        {
            Cpr_auction_bid::where('id',$win->id)->update(['status'=>1]);
            Cpr_auction::where('id',$win->cpr_auction_id)->update(['status'=>0]);
            $ids = Cpr_auction_enquiry::where('cpr_auction_id',$win->cpr_auction_id)->pluck('cpr_ad_enquiry_id')->toArray();
            Cpr_ad_enquiry::whereIn('id',$ids)->update(['reciever_id' => $win->web_user_id]);
        }
        
    }
    }
}
