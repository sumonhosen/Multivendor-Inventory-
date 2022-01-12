<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Request;
use Session;
use Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Lang;
use App\Models\Offer;
use App\Models\PostExtra;
use App\Models\Product;
use App\Models\ProductExtra;
use App\Models\ObjectRelationship;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\VendorsController;
use App\Http\Controllers\OptionController;
use App\Library\CommonFunction;
use Carbon\Carbon;
use App\Models\SaveCustomDesign;


class OfferController extends Controller
{
	public $option;
  public $carbonObject;
  public $classCommonFunction;
  public $cat_list_arr = array();
  public $parent_id = 0;
  public $vendors;


  public function __construct(){
		$this->option               =   new OptionController();
    $this->carbonObject         =   new Carbon();
    $this->classCommonFunction  =   new CommonFunction();
    $this->vendors              =   new VendorsController();
	}	
  
  /**
   * 
   * add content
   *
   * @param null
   * @return response view
   */
  public function AddContent(){
    $data = array();
    $data = $this->classCommonFunction->commonDataForAllPages();
    
    $data['product_all_data']  = DB::table('products')
                                   ->orderBy('products.id', 'desc')->get();

    $is_vendor = is_vendor_login(); 
    $sidebar['is_vendor_login'] = $is_vendor;
    $data['sidebar_data'] = $sidebar;      

    

    return view('pages.admin.offer.add-content', $data);
  }
  
 

    /**
   * 
   * Save/Update page data
   *
   * @param page slug for update
   * @return response
   */
  public function saveOffer($params = null){
    if( Request::isMethod('post') && Session::token() == Request::Input('_token') ){
      $data = Request::all();

      $rules =  [
                  'from_price'  => 'required',
                  'to_price'  => 'required',
                  'product'  => 'required',
                  'discounted_price'  => 'required',
                ];

      $validator = Validator:: make($data, $rules);
      
      if($validator->fails()){
        return redirect()-> back()
        ->withInput()
        ->withErrors( $validator );
      } 
      else if(Request::Input('to_price') < Request::Input('from_price') ){
        Session::flash('error-message', Lang::get('To Price should be greater than from price') );
        return redirect()->back()->withInput();
      }
      else{
        $post = new Offer;
        
        if(Request::Input('hf_post_type') == 'add'){

          $st=0;
          $check_prices= DB::table('offer')->get();


          foreach ($check_prices as $key => $row) {
 
             if(Request::Input('from_price') >= $row->from_price && Request::Input('from_price') <= $row->to_price ){
              $st=1;
              break;
             }
          }


          $post->created_by             =   Session::get('shopist_admin_user_id');
          $post->offer_title            =   Request::Input('offer_title');
          $post->from_price             =   Request::Input('from_price');
          $post->to_price               =   Request::Input('to_price');
          $post->product                =   Request::Input('product');
          $post->discounted_price       =   Request::Input('discounted_price');
          $post->status                 =   Request::Input('pages_visibility');
          $post->expiry_date            =   Request::Input('expiry_date');
          
        if($st == 0 ){
            if($post->save()){
              Session::flash('success-message', Lang::get('admin.successfully_saved_msg') );
              return redirect()->route('admin.add_offer');
            }
        } else {
          Session::flash('error-message', Lang::get('Prices value is matching in records') );
          return redirect()->back()->withInput();
        }
          


        }
        elseif(!empty($params) && Request::Input('hf_post_type') == 'update'){
          $data = array(
                      'post_author_id'         =>  Session::get('shopist_admin_user_id'),
          );

          if(Post::where('post_slug', $params)->update($data)){
            Session::flash('success-message', Lang::get('admin.successfully_updated_msg'));
            return redirect()->route('admin.update_page', $params);
          }
        }
      }
    }
  }


  /**
   * 
   * Product list content
   *
   * @param null
   * @return response view
   */
  public function ListContent(){
    $data = array();

    


      $common_obj  = new CommonFunction();
      $data = $common_obj->commonDataForAllPages();
      $is_vendor = is_vendor_login(); 
      $sidebar['is_vendor_login'] = $is_vendor;
      $data['sidebar_data'] = $sidebar;
      $data['pages_list']= DB::table('offer')
                        ->join('products as m1','m1.id', '=', 'offer.product')
                        ->select('offer.offer_title','offer.from_price','offer.to_price','offer.discounted_price','offer.expiry_date','offer.oid','offer.status as ostatus', 'm1.title as ptitle')
                        ->get();

    
    return view('pages.admin.offer.list-content', $data);
  }


  /**

  **status change **
  * **/

  public function change_status(){

    $data= DB::table('offer')
                        ->where('offer.status', '=', 1)->get();

    $current_date=strtotime(date("Y-m-d"));

     $array = array(
            'status'              =>  0,
          );

    foreach ($data as $key => $value) {
      // echo strtotime($value->expiry_date);
      // echo "<br>";
      if(strtotime($value->expiry_date) < $current_date ){

        Offer::where('oid', $value->oid)->update($array);

      }

    }

  }


  

  }