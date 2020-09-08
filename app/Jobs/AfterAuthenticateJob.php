<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Auth;
use App\User;
class AfterAuthenticateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $shop;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $shop)
    {
        $this->shop = $shop;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        logger('After authenticate');
        $shop = $this->shop;
        $ThemeData = $shop->api()->rest('GET', '/admin/themes.json',[])['body']['themes'];
        $script='<script src="//widget.artplacer.com/js/script.js"></script>';
        foreach ($ThemeData as $key => $theme) {
            if($theme->role == 'main'){
                $liquid_data = $shop->api()->rest('GET', '/admin/themes/'.$theme->id.'/assets.json',['asset[key]'=> 'layout/theme.liquid'])['body']['asset'];
                if(strpos($liquid_data->value, $script) == false){
                    if(strpos($liquid_data->value, "</body>") !== false){
                        $change_liquid =  str_replace("</body>",$script.
                            "<div class='artplacer_cstm'></div><style>.artplacer-button{ display: none;} .artplacer_cstm { position: fixed; right: 0; bottom: 20%; }</style> </body>",$liquid_data->value);
                        $put_data = array('asset' => array( 'key' => 'layout/theme.liquid', 'value' =>$change_liquid));
                       // logger($put_data);
                        $ThemePutData = $shop->api()->rest('PUT', '/admin/themes/'.$theme->id.'/assets.json',$put_data);
                       // logger(json_encode($ThemePutData));
                    }
                }
            }
        } 
    }
}
