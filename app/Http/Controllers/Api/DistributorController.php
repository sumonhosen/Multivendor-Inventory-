<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Library\CommonFunction;
use App\Models\Post;
use App\Models\Product;
use App\Models\PostExtra;
use App\Models\RoleUser;
use App\Models\Points;
use App\Models\UsersDetail;

use App\Models\User;
use Carbon\Carbon;


class DistributorController extends Controller
{
  public $classCommonFunction;
 
  public function __construct(){ 
    $this->classCommonFunction  =  new CommonFunction();
  }
  public function allDistributors(){
      $distributors = RoleUser::with('distributors')->where('role_id',3)->get();
     //dd($distributors);
      return response()->json($distributors);
  }
  
    public function showOrders(){

        $distributors = RoleUser::where('role_id',3)->get()->pluck('user_id')->toArray();            
        $post_id = Post::with('products','distributor')->whereIn('post_author_id',$distributors)
        ->where(['post_status' => 1, 'post_type' => 'shop_order'])
        ->orderBy('id', 'DESC')->get();
        //dd($post_id);

          // $get_postmeta_by_order_id = PostExtra::with(['order_item',
          // 'order_products'=>function($q){$q->with('product'); },
          // ])->whereIn('post_id', $post_id)->where(['key_name' => '_order_process_key'])->get();

      // dd($get_postmeta_by_order_id);
        return response()->json($post_id);

    }
    public function showDistributors(){
      $role_id = RoleUser::where('role_id',3)->get()->pluck('user_id')->toArray();            
 
      $distributors = User::with('details')->whereIn('id',$role_id)->get();
      // $address = [];
      // foreach($distributors as $details){
      //   $address[]= json_decode($details->details->details);
      // }
      // dd($address['address_details']);
      return response()->json($distributors);
    }
    public function saveData(){
      $role_id = RoleUser::where('role_id',3)->get()->pluck('user_id')->toArray();            
      $distributors = User::with('details')->whereIn('id',$role_id)->get();
       
        $wish_list = [];
          foreach($distributors as $key=>$details){
            $wish_list[$key]['wish'] = json_decode($details->details->details);
            $wish_list[$key]['id'] = $details->id;
         
          }
          $wish = [];
          foreach($wish_list as $key=>$items){
         
             if(isset($items['wish']->wishlists_details)){
              if(count(array_values((array)$items['wish']->wishlists_details))>0){
                $wish[$key]['user'] = User::find($items['id']);
                $wish[$key]['products'] =Product::whereIn('id',array_values((array)$items['wish']->wishlists_details))->get();
              }
             }
          }
           return response()->json($wish);
      }
      public function couponData(){
        $coupon_data = array();
        $get_post_meta = PostExtra::where(['key_name' => '_coupon_allow_role_name', 'key_value' => 'vendor'])->get()->toArray();
        if(!empty($get_post_meta) && count($get_post_meta) > 0){
          foreach($get_post_meta as $row){
            $get_post = Post::where(['id' => $row['post_id']])->first();
            $get_post_meta_all = PostExtra::where(['post_id' => $row['post_id']])->get()->toArray();
  
            if(!empty($get_post)){
              $data['coupon_code']        = $get_post->post_title;
              $data['coupon_status']      = $get_post->post_status;
              $data['coupon_description'] = $get_post->post_content;
            }
  
            if(!empty($get_post_meta_all) && count($get_post_meta_all) > 0){
              foreach($get_post_meta_all as $post_meta_row){
                if($post_meta_row['key_name'] == '_coupon_condition_type'){
                  if($post_meta_row['key_value'] == 'discount_from_product'){
                    $data['coupon_condition_type'] = 'Coupon Condition Discount product';
                  }
                  elseif($post_meta_row['key_value'] == 'percentage_discount_from_product'){
                    $data['coupon_condition_type'] = "Coupon Condition percentage Discount product";
                  }
                  elseif($post_meta_row['key_value'] == 'discount_from_total_cart'){
                    $data['coupon_condition_type'] = "Coupon Condition Discount product";
                  }
                  elseif($post_meta_row['key_value'] == 'percentage_discount_from_total_cart'){
                    $data['coupon_condition_type'] = "Coupon Condition percentage discount Total Cart";
                  }
  
                }
                elseif($post_meta_row['key_name'] == '_coupon_amount'){
                  $data['coupon_amount'] = $post_meta_row['key_value'];
                }
                elseif($post_meta_row['key_name'] == '_coupon_min_restriction_amount'){
                  $data['coupon_min_restriction_amount'] = $post_meta_row['key_value'];
                }
                elseif($post_meta_row['key_name'] == '_coupon_max_restriction_amount'){
                  $data['coupon_max_restriction_amount'] = $post_meta_row['key_value'];
                }
                elseif($post_meta_row['key_name'] == '_coupon_allow_role_name'){
                  $data['coupon_allow_role_name'] = $post_meta_row['key_value'];
                }
                elseif($post_meta_row['key_name'] == '_usage_limit_per_coupon'){
                  $data['usage_limit_per_coupon'] = $post_meta_row['key_value'];
                }
                elseif($post_meta_row['key_name'] == '_usage_range_end_date'){
                  $data['usage_range_end_date'] = $post_meta_row['key_value'];
                }
              }
            }
            array_push($coupon_data, $data);
          }
          return response()->json($coupon_data);
        }  
      }
      public function bvPoints(){
        $order_data = array();
        $role_id = RoleUser::where('role_id',3)->get()->pluck('user_id')->toArray(); 
        // dd($role_id);
        if(!empty($role_id)){
          $get_data = Points::with('distributor')->whereIn('purchased_by', $role_id)->get()->toArray();

          if(count($get_data) > 0){
            $order_data = $get_data;
          }
        }
        
        return response()->json($order_data);
      }
    }
