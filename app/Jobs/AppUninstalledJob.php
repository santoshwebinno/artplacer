<?php 
namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Osiset\ShopifyApp\Contracts\Objects\Values\ShopDomain;
use stdClass;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Widget;
class AppUninstalledJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Shop's myshopify domain
     *
     * @var ShopDomain
     */
    public $shopDomain;

    /**
     * The webhook data
     *
     * @var object
     */
    public $data;

    /**
     * Create a new job instance.
     *
     * @param string   $shopDomain The shop's myshopify domain
     * @param stdClass $data    The webhook data (JSON decoded)
     *
     * @return void
     */
    public function __construct($shopDomain, $data)
    {
        $this->shopDomain = $shopDomain;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        logger(json_encode($this->shopDomain));
        $shop_data = User::where('name',$this->data->domain)->first();
        
        // $shop = $this->data;
        // $widgets = Widget::where('user_id', $shop_data->id)->get();
        // $ThemeData = $shop->api()->rest('GET', '/admin/themes.json',[])['body'];
        // logger(json_encode($ThemeData));
        // $ThemeData = $ThemeData->themes;
        // foreach ($ThemeData as $key => $theme) {
        //     $theme_data = $shop->api()->rest('GET', '/admin/themes/'.$theme->id.'/assets.json',['asset[key]'=> 'layout/theme.liquid'])['body']['asset'];
        //     sleep(1);
        //     $liquid_data = $shop->api()->rest('GET', '/admin/themes/'.$theme->id.'/assets.json',['asset[key]'=> 'sections/product-template.liquid'])['body']['asset'];
        //     foreach ($widgets as $keys => $widget) {
        //         if(strpos($theme_data->value, 'id="artplacer_cstm-'.$widget->id.'"') != false){
        //             $get_remove = $this->delete_all_between('<!--start artplacer_cstm-'.$widget->id.' -->' , '<!--end artplacer_cstm-'.$widget->id.' -->', $theme_data->value);
        //                logger($get_remove);
        //             $remove = '<!--start artplacer_cstm-'.$widget->id.' -->'.$get_remove.'<!--end artplacer_cstm-'.$widget->id.' -->';
        //                 logger($remove);
        //             $change_liquid =  str_replace($remove,' ',$theme_data->value);
        //             $put_data = array('asset' => array( 'key' => 'layout/theme.liquid', 'value' =>$change_liquid));
                    
        //                 $ThemePutData = $shop->api()->rest('PUT', '/admin/themes/'.$theme->id.'/assets.json',$put_data);
        //             }  
        //         sleep(1);
        //         if(strpos($liquid_data->value, 'id="artplacer_cstm-'.$widget->id.'"') != false){
        //             $get_remove = $this->delete_all_between('<artplacer id="artplacer_cstm-'.$widget->id.'"', '</artplacer>', $liquid_data->value);
        //             logger($get_remove);
        //             $remove = '<artplacer id="artplacer_cstm-'.$widget->id.'"'.$get_remove.'</artplacer>';
        //             logger($remove);
        //             $change_liquid =  str_replace($remove,' ',$liquid_data->value);
        //             $put_data = array('asset' => array( 'key' => 'sections/product-template.liquid', 'value' =>$change_liquid));
        //             logger($put_data);      
        //            $ThemePutData = $shop->api()->rest('PUT', '/admin/themes/'.$theme->id.'/assets.json',$put_data);
        //         }
        //         $widget->delete(); 
        //     }
        // }
       // $shop->password = '';
      //  $shop->save();
    }

    public function delete_all_between($start, $end, $string) {
          $string = ' ' . $string;
            $ini = strpos($string, $start);
            if ($ini == 0) return '';
            $ini += strlen($start);
            $len = strpos($string, $end, $ini) - $ini;
            return substr($string, $ini, $len);
    }
}
