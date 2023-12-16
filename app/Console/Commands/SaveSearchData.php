<?php

namespace App\Console\Commands;

use App\Models\Search_data;
use App\Models\Cpr_ad_category;
use App\Models\webUser;
use App\Models\Api_cat;
use App\Models\Cpr_Add_post;
use App\Models\Cpr_ad_mapped_category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Console\Command;

class SaveSearchData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Save:SearchData';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Save Search Data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $new = Search_data::where('status',0)->where('query','!=',null)->latest()->first();
        if(isset($new))
        {
                $catname = Cpr_ad_category::find($new->query);
                $cat = $catname?$catname->category_name:"";
                $location = $new->address;
                $res = Http::get('http://profilebabascraper-env.eba-dbyrek3q.ap-south-1.elasticbeanstalk.com/google/search?query='.$cat.'&location='.$location.'&size=50')->collect();
               
               foreach ($res as $key => $value) {
                    
                    $use =  webUser::where('phone',(int)$value['phone'])->first();
                        if(isset($value['category']))
                        {
                            $oldcat = Cpr_ad_category::where('category_name',$value['category'])->first();
                            if(isset($oldcat))
                            {
                                
                                if($oldcat->parent_id == 0)
                                {
                                   $newc = $oldcat->id;
                                }
                                else
                                {
                                    $newc = $oldcat->parent_id; 
                                }
                                
                            }
                            else
                            {
                                $newc = null;
                            }
                        }
                        else
                        {
                            $newc = null;
                        }
                    
                    if(!isset($use))
                    {
                        $data = new webUser();
                        $data->firstName = $value['name'];
                        $data->phone = (int)$value['phone'];
                        $data->latitude = $value['latitude'];
                        $data->longitude = $value['longitude'];
                        $data->location = $value['address'];
                        $data->companyAddress = $value['address'];
                        $data->email = $value['email'];
                        $data->company_category = $newc;
                        $data->account_type = 'v';
                        $data->source = 'api';
                        $data->plan_date = Carbon::today();
                        $data->password = Hash::make((int)$value['phone']);
                        $data->save();
                        $uid = $data->id;
                    }
                    else
                    {
                        $uid = $use->id;
                    }
                    $ad = new Cpr_Add_post();
                    $ad->user_id = $uid;
                    $ad->title = $value['category'];
                    $ad->api_cat = $value['category'];
                    $ad->location = $value['address'];
                    $ad->plan = 'free';
                    $ad->plan_date = Carbon::now();
                    $ad->ExDate = Carbon::now()->addDays(3);
                    $ad->source = 'api';
                    $ad->save();
                    
                    if($newc != null)
                    {
                        $category = new Cpr_ad_mapped_category();
                        $category->ad_id = $ad->id;
                        $category->category_id = $new->query;
                        $category->save();
                    }
                    else
                    {
                      $oldapi = Api_cat::where('api_cat',$value['category'])->first();
                      if(!isset($oldapi))
                      {
                          $newcat =  new Api_cat();
                          $newcat->parent_cat = $new->query;
                          $newcat->api_cat = $value['category'];
                          $newcat->ad_id = $ad->id;
                          $newcat->save();
                      
                      }
                      
                      
                    }
                    
                }
            Search_data::whereId($new->id)->update(['status'=>1]);
        }
    }
}
