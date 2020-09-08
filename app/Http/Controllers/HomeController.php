<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Widget;
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $shops = Auth::user();
      $url = env('APP_URL');
      $widgets = Widget::where('user_id', $shops->id)->get();
      $url = 'https://netzilatechnologies.com/artplacer/public';
      return response()->json(['widgets'=>$widgets, 'url'=>$url]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $shop = Auth::user(); 
        $widget = new Widget();
        $widget->user_id = $shop->id;
        $widget->room = $request->get('room');
       // $widget->txt_color = $request->get('txt_color');
       // $widget->bg_color = $request->get('bg_color');
       // $widget->layout = $request->get('layout');
       // $widget->border_color = $request->get('border_color');
        $widget->position = $request->get('position');
        $widget->text = $request->get('text');
        $widget->html_code =$request->get('html_code');
        $widget->save();
        $this->AddCode($request->get('html_code'),$widget);
    
        $url = env('APP_URL');
        logger($url);
        $url = 'https://netzilatechnologies.com/artplacer/public';
        //return redirect()->route('home');
        return response()->json($url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $shop = Auth::user();
        $widget = Widget::where('id', $id)->first();
        //$url = env('APP_URL');
        $url = 'https://netzilatechnologies.com/artplacer/public';
        return response()->json(['widget'=>$widget, 'url' =>$url]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
      return view('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $shop = Auth::user();
        $widget = Widget::where('id', $request->get('id'))->first();
        //Delete Code 
        $this->deleteCode($shop,$widget);
        //Update Code
        $widget->room = $request->get('room');
       // $widget->txt_color = $request->get('txt_color');
       // $widget->bg_color = $request->get('bg_color');
      //  $widget->border_color = $request->get('border_color');
       // $widget->layout = $request->get('layout');
        $widget->position = $request->get('position');
        $widget->text = $request->get('text');
        $widget->html_code =$request->get('html_code');
        $widget->save();
        sleep(3);
        $this->AddCode($request->get('html_code'),$widget);
        return response()->json('Done');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shop = Auth::user();
        $widget = Widget::where('id', $id)->first();
        $this->deleteCode($shop,$widget);
        $widget->delete(); 
        return response()->json('Done');
    }
    public function AddCode($script,$widget){
      $shop = Auth::user();
      $artwork_url = 'artwork_url="{{ product.featured_image | img_url: \'x400\' }}"';
      $forsize ='{% for option in product.options_with_values %} {% if option.name == "size" or option.name == "Size" %}{% if option.position == 1 %}{% assign size_position'.$widget->id.' = product.selected_or_first_available_variant.option1 %}{% assign height_var'.$widget->id.' = product.selected_or_first_available_variant.option1 | split: \'x\' | last | to_integer %} {% elsif option.position == 2 %} {% assign size_position'.$widget->id.' = product.selected_or_first_available_variant.option2 %} {% assign height_var'.$widget->id.' = product.selected_or_first_available_variant.option2 | split: \'x\' | last | to_integer %} {% else %} {% assign size_position'.$widget->id.' = product.selected_or_first_available_variant.option3 %}{% assign height_var'.$widget->id.' = product.selected_or_first_available_variant.option3 | split: \'x\' | last | to_integer %} {% endif %}{% endif %}{% endfor %}';
      $ThemeData = $shop->api()->rest('GET', '/admin/themes.json',[])['body']['themes'];
        foreach ($ThemeData as $key => $theme) {
            if($theme->role == 'main'){
              if($widget->room =='dynamic'){
                //Remove size
                $get_size = $this->delete_all_between('size="' , '"', $script);
                $script =  str_replace('size="'.$get_size.'"', 'size=""',$script);
                //Remove Price
                $get_price = $this->delete_all_between('price="' , '"', $script);
                $script =  str_replace('price="'.$get_price.'"', 'price=""',$script);
                //Remove Title
                $get_title = $this->delete_all_between('title="' , '"', $script);
                $script =  str_replace('title="'.$get_title.'"', 'title=""',$script);
                //Remove Artwork 
                $get_remove1 = $this->delete_all_between('artwork="' , '"', $script);
                $script =  str_replace('artwork="'.$get_remove1.'"', '',$script);

                //Add Heigth
                $get_height = $this->delete_all_between('height="' , '"', $script);
                $script =  str_replace('height="'.$get_height.'"', 'height="{{ height_var'.$widget->id.' }}"',$script);
                if(strpos($script, 'height') == false){
                  $script =  str_replace('<artplacer','<artplacer height="{{ height_var'.$widget->id.' }}"',$script);
                }
                //Create Artplacer url
                if(strpos($script, 'artwork_url="') == false){
                  $script =  str_replace('<artplacer','<artplacer '.$artwork_url,$script);
                }else{
                  $get_remove = $this->delete_all_between('artwork_url="' , '"', $script);
                  $script =  str_replace('artwork_url="'.$get_remove.'"', $artwork_url,$script);
                }
                
                if(strpos($script, 'type="1"') != false ){
                  //Remove Space when type 1
                  $get_space = $this->delete_all_between('space="' , '"', $script);
                  $script =  str_replace('space="'.$get_space.'"', '',$script);
                  //Add Update Title
                  $get_title = $this->delete_all_between('title="' , '"', $script);
                  $script =  str_replace('title="'.$get_title.'"', 'title="{{ product.title }}"',$script);
                  if(strpos($script, 'title') == false){
                    $script =  str_replace('<artplacer','<artplacer title="{{ product.title }}"',$script);
                  }
                  //Add Update Price
                  $get_price = $this->delete_all_between('price="' , '"', $script);
                  $script =  str_replace('price="'.$get_price.'"', 'price="{{ product.selected_or_first_available_variant.price | money }}"',$script);
                  if(strpos($script, 'price') == false){
                    $script =  str_replace('<artplacer','<artplacer price="{{ product.selected_or_first_available_variant.price | money }}"',$script);
                  }
                  //Add Update Size 
                $get_size = $this->delete_all_between('size="' , '"', $script);
                $script =  str_replace('size="'.$get_size.'"', 'size="{{ size_position'.$widget->id.' }}"',$script);
                  if(strpos($script, 'size') == false){
                    $script =  str_replace('<artplacer','<artplacer size="{{ size_position'.$widget->id.' }}"',$script);
                  }
                }
            }else{
              $get_size = $this->delete_all_between('size="' , '"', $script);
              $script =  str_replace('size="'.$get_size.'"', '',$script);
              $get_price = $this->delete_all_between('price="' , '"', $script);
              $script =  str_replace('price="'.$get_price.'"', '',$script);
              $get_title = $this->delete_all_between('title="' , '"', $script);
              $script =  str_replace('title="'.$get_title.'"', '',$script);
              $get_url = $this->delete_all_between('artwork_url="' , '"', $script);
              $script =  str_replace('artwork_url="'.$get_url.'"', '',$script);
              $get_height = $this->delete_all_between('height="' , '"', $script);
              $script =  str_replace('height="'.$get_height.'"', '',$script);
            }
            //Remove placement
              $get_placement = $this->delete_all_between('placement="' , '"', $script);
              $script =  str_replace('placement="'.$get_placement.'"', '',$script);
            // Add className 
              if(strpos($script, 'classname=') != false){
                if(strpos($script, 'artplacer_clm-'.$widget->id) == false){
                  $script =  str_replace('classname="','classname="artplacer_clm-'.$widget->id.' ',$script);
                }
              }else{
                 $script =  str_replace('<artplacer','<artplacer classname="artplacer_clm-'.$widget->id.'"',$script);
              }
              $script = preg_replace('/\s+/', ' ', $script);
          $liquid_data = $shop->api()->rest('GET', '/admin/themes/'.$theme->id.'/assets.json',['asset[key]'=> 'sections/product-template.liquid'])['body']['asset'];
              if(strpos($liquid_data->value, "{{ product.description }}") !== false){
                if($widget->position == 'Above Description'){
                    $change_liquid =  str_replace('{{ product.description }}','<!--start size_position-'.$widget->id.' -->'.$forsize.$script.'<!--end size_position-'.$widget->id.' -->
              {{ product.description }}',$liquid_data->value); 
                $put_data = array('asset' => array( 'key' => 'sections/product-template.liquid', 'value' =>$change_liquid));
                        
                $ThemePutData = $shop->api()->rest('PUT', '/admin/themes/'.$theme->id.'/assets.json',$put_data); 
                }else if($widget->position == 'Below Description'){
                    $change_liquid =  str_replace("{{ product.description }}",'{{ product.description }}
           <!--start size_position-'.$widget->id.' -->'.$forsize.$script.'<!--end size_position-'.$widget->id.' -->',$liquid_data->value);
                    $put_data = array('asset' => array( 'key' => 'sections/product-template.liquid', 'value' =>$change_liquid));
                        
                    $ThemePutData = $shop->api()->rest('PUT', '/admin/themes/'.$theme->id.'/assets.json',$put_data);
            }else{
              if(strpos($script, 'placement="floating"') == false){
                $script =  str_replace('></artplacer>', ' placement="floating"></artplacer>',$script);
                $script = preg_replace('/\s+/', ' ', $script);
              }
              $theme_data = $shop->api()->rest('GET', '/admin/themes/'.$theme->id.'/assets.json',['asset[key]'=> 'layout/theme.liquid'])['body']['asset'];
               $change_liquid =  str_replace("<div class='artplacer_cstm'>",
              "<div class='artplacer_cstm'>
              <!--start artplacer_cstm-".$widget->id." -->
              {%- if template == 'product' -%}"
                .$forsize.$script.
              "{%- endif -%}
              <!--end artplacer_cstm-".$widget->id." -->",$theme_data->value);
              $put_data = array('asset' => array( 'key' => 'layout/theme.liquid', 'value' =>$change_liquid));           
            $ThemePutData = $shop->api()->rest('PUT', '/admin/themes/'.$theme->id.'/assets.json',$put_data);  
            }
            $widget->html_code =$script;
            $widget->save();
          }
        }
      }
    }
    public function delete_all_between($start, $end, $string) {
          $string = ' ' . $string;
            $ini = strpos($string, $start);
            if ($ini == 0) return '';
            $ini += strlen($start);
            $len = strpos($string, $end, $ini) - $ini;
            return substr($string, $ini, $len);
    }

    public function deleteCode($shop,$widget){
      $ThemeData = $shop->api()->rest('GET', '/admin/themes.json',[])['body']['themes'];
        foreach ($ThemeData as $key => $theme) {
            if($theme->role == 'main'){
              sleep(2);
                if($widget->position == 'Floating Sidebar'){
                    $theme_data = $shop->api()->rest('GET', '/admin/themes/'.$theme->id.'/assets.json',['asset[key]'=> 'layout/theme.liquid'])['body']['asset'];
                    if(strpos($theme_data->value, '<!--start artplacer_cstm-'.$widget->id.' -->') != false){
                        $get_remove = $this->delete_all_between('<!--start artplacer_cstm-'.$widget->id.' -->' , '<!--end artplacer_cstm-'.$widget->id.' -->', $theme_data->value);
                       //logger($get_remove);
                        $remove = '<!--start artplacer_cstm-'.$widget->id.' -->'.$get_remove.'<!--end artplacer_cstm-'.$widget->id.' -->';
                       // logger($remove);
                        $change_liquid =  str_replace($remove,' ',$theme_data->value);
                        sleep(1);
            $put_data = array('asset' => array( 'key' => 'layout/theme.liquid', 'value' =>$change_liquid));
                    
            $ThemePutData = $shop->api()->rest('PUT', '/admin/themes/'.$theme->id.'/assets.json',$put_data);
                
                }
            }
                else{
                  $liquid_data = $shop->api()->rest('GET', '/admin/themes/'.$theme->id.'/assets.json',['asset[key]'=> 'sections/product-template.liquid'])['body']['asset'];  
                  
                  if(strpos($liquid_data->value, '<!--start size_position-'.$widget->id.' -->') != false){
                        $get_remove = $this->delete_all_between('<!--start size_position-'.$widget->id.' -->', '<!--end size_position-'.$widget->id.' -->', $liquid_data->value);
                        //if($widget->position == 'Above Description'){
                          $remove = '<!--start size_position-'.$widget->id.' -->' .$get_remove.'<!--end size_position-'.$widget->id.' -->';
                       // }else{
                        //  $remove = '</br></br><artplacer id="artplacer_cstm-'.$widget->id.'"'.$get_remove.'</artplacer>';
                       // }
                        sleep(1);
                      // logger($remove);
                        $change_liquid =  str_replace($remove,' ',$liquid_data->value);
                        $put_data = array('asset' => array( 'key' => 'sections/product-template.liquid', 'value' =>$change_liquid));
                      //  logger($put_data);      
                       $ThemePutData = $shop->api()->rest('PUT', '/admin/themes/'.$theme->id.'/assets.json',$put_data);
                      // logger(json_encode( $ThemePutData));
                    }
                }
            }
        }
    }
}
