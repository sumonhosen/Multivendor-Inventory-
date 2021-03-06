<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Request;
use Session;
use Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use App\Models\Post;
use App\Models\PostExtra;
use App\Models\ObjectRelationship;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProductsController;
use App\Models\Term;
use App\Library\CommonFunction;
use App\Models\TermExtra;
use App\Models\Option;
use App\Models\UsersDetail;
use App\Models\Banner;

class CMSController extends Controller
{

  /**
   * 
   * Banner add content
   *
   * @param null
   * @return response view
   */
  public function bannerAddContent(){
    $data = array();
   
    $common_obj  = new CommonFunction();
    $data = $common_obj->commonDataForAllPages();

    $is_vendor = is_vendor_login(); 
    $sidebar['is_vendor_login'] = $is_vendor;
    $data['sidebar_data'] = $sidebar; 
    
    return view('pages.admin.cms.add-banner', $data);
  }



    /**
   * 
   * Save/Update Banner data
   *
   * @param page slug for update
   * @return response
   */
  public function saveBannerData($params = null){
    if( Request::isMethod('post') && Session::token() == Request::Input('_token') ){
      $data = Request::all();

    if(!empty($params) && Request::Input('hf_post_type') == 'add'){
      $rules =  [
                  'title'  => 'required',
                  'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

                ];
      } else {
        $rules =  [
                  'title'  => 'required',

                ];
      }

      $validator = Validator:: make($data, $rules);
      
      if($validator->fails()){
        return redirect()-> back()
        ->withInput()
        ->withErrors( $validator );
      }
      else{
        $Banner = new Banner;
        
        if(Request::Input('hf_post_type') == 'add'){

          $imageName = time().'.'.Request::file('image')->extension();  
     
           Request::file('image')->move(public_path('uploads'), $imageName);


          $Banner->title            =   Request::Input('title');
          $Banner->image            =   $imageName;
          $Banner->button_title     =   Request::Input('button_title');
          $Banner->button_link      =   Request::Input('button_link');
          $Banner->status           =   Request::Input('status');
          $Banner->created_at       =   date("Y-m-d H:i:s");
          
          if($Banner->save()){
            Session::flash('success-message', Lang::get('admin.successfully_saved_msg') );
            return redirect()->route('admin.banner_add');
          }
        }
        elseif(!empty($params) && Request::Input('hf_post_type') == 'update'){

          if(!empty(Request::file('image'))){
            $imageName = time().'.'.Request::file('image')->extension();
            Request::file('image')->move(public_path('uploads'), $imageName);
          } else {
            $imageName=Request::Input('image_url');
          }
          $data = array(

                      'title'              =>  Request::Input('title'),
                      'image'              =>  $imageName,
                      'button_title'       =>  Request::Input('button_title'),
                      'button_link'        =>  Request::Input('button_link'),
                      'status'             =>  Request::Input('status'),
          );

          if(Banner::where('id', $params)->update($data)){
            Session::flash('success-message', Lang::get('admin.successfully_updated_msg'));
            return redirect()->route('admin.banner_list_content', $params);
          }
        }
      }
    }
  }
  

   /**
   * 
   * Banner update content
   *
   * @param blog_slug
   * @return response view
   */
  public function bannerUpdateContent($parm){
    $data = array();

      $Banner =  new Banner();

      $common_obj  = new CommonFunction();
      $data = $common_obj->commonDataForAllPages();

      $data['banner'] = Banner::find($parm);


      $is_vendor = is_vendor_login(); 
      $sidebar['is_vendor_login'] = $is_vendor;
      $data['sidebar_data'] = $sidebar;
      
      return view('pages.admin.cms.update-banner-content', $data);
  }


   /**
   * 
   * Banner List content
   *
   * @param 
   * @return response view
   */
  public function bannerListContent(){
    $data = array();

      $Banner =  new Banner();
      $common_obj  = new CommonFunction();
      $data = $common_obj->commonDataForAllPages();

      $data['banner'] = Banner::latest()->get();


      $is_vendor = is_vendor_login(); 
      $sidebar['is_vendor_login'] = $is_vendor;
      $data['sidebar_data'] = $sidebar;
      
      return view('pages.admin.cms.banner-list-content', $data);
  }




  /**
   * 
   * Page add content
   *
   * @param null
   * @return response view
   */
  public function pageAddContent(){
    $data = array();
   
    $common_obj  = new CommonFunction();
    $data = $common_obj->commonDataForAllPages();

    $is_vendor = is_vendor_login(); 
    $sidebar['is_vendor_login'] = $is_vendor;
    $data['sidebar_data'] = $sidebar; 
    
    return view('pages.admin.cms.add-page-content', $data);
  }
  
  /**
   * 
   * Page update content
   *
   * @param page_slug
   * @return response view
   */
  public function pageUpdateContent($parm){
    $data = array();
    $get_page_data_by_slug = $this->get_page_by_slug( $parm );
      
    if(!empty($get_page_data_by_slug)){
      $common_obj  = new CommonFunction();
      $data = $common_obj->commonDataForAllPages();
      $data['page_data_by_slug']  =  $get_page_data_by_slug;

      $is_vendor = is_vendor_login(); 
      $sidebar['is_vendor_login'] = $is_vendor;
      $data['sidebar_data'] = $sidebar; 
      
      return view('pages.admin.cms.update-page-content', $data);
    }
    else{
      return view('errors.no_data');
    }
  }
  
  /**
   * 
   * Page list content
   *
   * @param null
   * @return response view
   */
  public function pageListContent(){
    $data = array();
    $search_value = '';
    
    if(isset($_GET['term_page']) && $_GET['term_page'] != ''){
      $search_value = $_GET['term_page'];
    }
    
    $common_obj  = new CommonFunction();
    $data = $common_obj->commonDataForAllPages();  
    
    $data['pages_list']   = $this->get_pages( true, $search_value, -1 );
    $data['search_value'] = $search_value;

    $is_vendor = is_vendor_login(); 
    $sidebar['is_vendor_login'] = $is_vendor;
    $data['sidebar_data'] = $sidebar;
     
    return view('pages.admin.cms.pages-list-content', $data);
  }
  
  /**
   * 
   * Blog add content
   *
   * @param null
   * @return response view
   */
  public function blogAddContent(){
    $data = array();
    $common_obj  =  new CommonFunction();
    $product_obj =  new ProductsController();
    
    $data = $common_obj->commonDataForAllPages();
    $data['blog_categories_lists'] = $product_obj->get_categories( 0, 'blog_cat');

    $is_vendor = is_vendor_login(); 
    $sidebar['is_vendor_login'] = $is_vendor;
    $data['sidebar_data'] = $sidebar;
    
    return view('pages.admin.cms.add-blog-content', $data);
  }
  
  /**
   * 
   * Blog update content
   *
   * @param blog_slug
   * @return response view
   */
  public function blogUpdateContent($parm){
    $data = array();
    $get_blog_details_by_slug = $this->get_blog_by_slug( $parm );
    
    if(is_array($get_blog_details_by_slug) && count($get_blog_details_by_slug) > 0){
      $common_obj  = new CommonFunction();
      $product_obj =  new ProductsController();
      
      $data = $common_obj->commonDataForAllPages();
      $get_object_id = $get_blog_details_by_slug['id'];
      
      $data['blog_categories_lists'] = $product_obj->get_categories( 0, 'blog_cat');
      $data['blog_details_by_slug']  = $get_blog_details_by_slug;
      $data['selected_cat']    =   $this->create_blog_cat_id_array( $get_object_id );

      $is_vendor = is_vendor_login(); 
      $sidebar['is_vendor_login'] = $is_vendor;
      $data['sidebar_data'] = $sidebar;
      
      return view('pages.admin.cms.update-blog-content', $data);
    }
    else{
      return view('errors.no_data');
    }
  }
  
  /**
   * 
   * Blog list content
   *
   * @param null
   * @return response view
   */
  public function blogListContent(){
    $data = array();
    $search_value = '';
    
    if(isset($_GET['term_blog']) && $_GET['term_blog'] != ''){
      $search_value = $_GET['term_blog'];
    }
    
    $common_obj  = new CommonFunction();
    $data = $common_obj->commonDataForAllPages();  
    
    $data['blogs_list_data']   = $this->get_blogs( true, $search_value, -1 );
    $data['search_value']      = $search_value;

    $is_vendor = is_vendor_login(); 
    $sidebar['is_vendor_login'] = $is_vendor;
    $data['sidebar_data'] = $sidebar;
     
    return view('pages.admin.cms.blogs-list-content', $data);
  }
  
  /**
   * 
   * Blog categories list content
   *
   * @param null
   * @return response view
   */
  public function blogCategoriesListContent(){
    $data = array();
    $search_value = '';
    
    if(isset($_GET['term_cat']) && $_GET['term_cat'] != ''){
      $search_value = $_GET['term_cat'];
    }
    
    $common_obj  = new CommonFunction();
    $product_obj = new ProductsController();
    
    $data = $common_obj->commonDataForAllPages();  
    $data['cat_list_data'] =   $product_obj->getTermData( 'blog_cat', true, $search_value, -1 );
    $data['only_cat_name'] =   $product_obj->get_categories_name('blog_cat');
    $data['search_value']  =   $search_value;
    $data['action']        =   route('admin.blog_categories_list');

    $is_vendor = is_vendor_login(); 
    $sidebar['is_vendor_login'] = $is_vendor;
    $data['sidebar_data'] = $sidebar;
    
    return view('pages.admin.categories-list', $data);
  }
  
  /**
   * 
   * Blog comments list content
   *
   * @param null
   * @return response view
   */
  public function blogCommentsListContent(){
    $data = array();
    $common_obj  = new CommonFunction();
    
    $data = $common_obj->commonDataForAllPages();  
    $data['blog_comments']  =  $this->getBlogCommentsList();

    $is_vendor = is_vendor_login(); 
    $sidebar['is_vendor_login'] = $is_vendor;
    $data['sidebar_data'] = $sidebar;
    
    return view('pages.admin.cms.blog-comments-list', $data);
  }
  
  /**
   * 
   * Testimonial add content
   *
   * @param null
   * @return response view
   */
  public function testimonialAddContent(){
    $data = array();
    $common_obj  =  new CommonFunction();
    
    $data = $common_obj->commonDataForAllPages();

    $is_vendor = is_vendor_login(); 
    $sidebar['is_vendor_login'] = $is_vendor;
    $data['sidebar_data'] = $sidebar;
    
    return view('pages.admin.cms.add-testimonial-content', $data);
  }
  
  /**
   * 
   * Testimonial update content
   *
   * @param testimonial_slug
   * @return response view
   */
  public function testimonialUpdateContent( $params ){
    $get_post_details = get_testimonial_data_by_slug( $params );
    
    if(count($get_post_details) > 0){
      $data = array();
      $common_obj  =  new CommonFunction();
      
      $data = $common_obj->commonDataForAllPages();
      $data['testimonial_update_data'] = $get_post_details;

      $is_vendor = is_vendor_login(); 
      $sidebar['is_vendor_login'] = $is_vendor;
      $data['sidebar_data'] = $sidebar;
      
      return view('pages.admin.cms.update-testimonial-content', $data);
    }
    else{
      return view('errors.no_data');
    }
  }
  
  /**
   * 
   * Testimonial list content
   *
   * @param null
   * @return response view
   */
  public function testimonialListContent(){
    $data = array();
    $search_value = '';
    
    if(isset($_GET['term_testimonial']) && $_GET['term_testimonial'] != ''){
      $search_value = $_GET['term_testimonial'];
    }
    
    $common_obj  = new CommonFunction();
    $data = $common_obj->commonDataForAllPages();  
    
    $data['testimonial_list_data']   =   $this->get_testimonials( true, $search_value, -1 );
    $data['search_value']            =   $search_value;

    $is_vendor = is_vendor_login(); 
    $sidebar['is_vendor_login'] = $is_vendor;
    $data['sidebar_data'] = $sidebar;
     
    return view('pages.admin.cms.testimonial-list-content', $data);
  }
  
  /**
   * 
   * Manufacturers add content
   *
   * @param null
   * @return response view
   */
  public function manufacturersAddContent(){
    $data = array();
    $common_obj  =  new CommonFunction();
    
    $data = $common_obj->commonDataForAllPages();

    $is_vendor = is_vendor_login(); 
    $sidebar['is_vendor_login'] = $is_vendor;
    $data['sidebar_data'] = $sidebar;
    
    return view('pages.admin.cms.add-manufacturers-content', $data);
  }
  
  /**
   * 
   * Manufacturers update content
   *
   * @param manufacturer_slug
   * @return response view
   */
  public function manufacturersUpdateContent($parm){
    $getBrandsData = Term :: where('slug', $parm)->first();
      
    if(!empty($getBrandsData)){
      $data = array();
      $common_obj  =  new CommonFunction();
      $product_obj =  new ProductsController();
      $get_details_by_id =  $product_obj->getTermDataById( $getBrandsData->term_id );
      
      $data = $common_obj->commonDataForAllPages();
      $data['manufacturers_update_data']  =  array_shift($get_details_by_id);

      if($data['manufacturers_update_data']['brand_logo_img_url']){
        $data['manufacturers_logo_control'] =  array('sample_img' => 'style="display:none;"', 'manufacturers_logo' =>'style="display:block;"');
      }
      else {
        $data['manufacturers_logo_control'] =  array('sample_img' => 'style="display:block;"', 'manufacturers_logo' =>'style="display:none;"');
      }

      $is_vendor = is_vendor_login(); 
      $sidebar['is_vendor_login'] = $is_vendor;
      $data['sidebar_data'] = $sidebar;
      
      return view('pages.admin.cms.update-manufacturers-content', $data);
    }
    else{
      return view('errors.no_data');
    }
  }
  
  /**
   * 
   * Manufacturers list content
   *
   * @param null
   * @return response view
   */
  public function manufacturersListContent(){
    $data = array();
    $search_value = '';
    
    if(isset($_GET['term_brand']) && $_GET['term_brand'] != ''){
      $search_value = $_GET['term_brand'];
    }
    
    $common_obj  = new CommonFunction();
    $product_obj =  new ProductsController();
    
    $data = $common_obj->commonDataForAllPages();  
    $data['manufacturerslist']   =  $product_obj->getTermData( 'product_brands', true, $search_value, -1 );
    $data['search_value']        =  $search_value;

    $is_vendor = is_vendor_login(); 
    $sidebar['is_vendor_login'] = $is_vendor;
    $data['sidebar_data'] = $sidebar;
     
    return view('pages.admin.cms.manufacturers-list-content', $data);
  }
  
  /**
   * 
   * SEO content
   *
   * @param null
   * @return response view
   */
  public function seoContent(){
    $data = array();
    $common_obj  =  new CommonFunction();
    $get_user_store_data = get_user_account_details_by_user_id( Session::get('shopist_admin_user_id'));
    $login_user_details = json_decode(array_shift($get_user_store_data)['details']);
    
    $data = $common_obj->commonDataForAllPages();
    
    if(is_vendor_login()){
      $data['seo_data'] = $login_user_details->seo;

      $is_vendor = is_vendor_login(); 
      $sidebar['is_vendor_login'] = $is_vendor;
      $data['sidebar_data'] = $sidebar;

      return view('pages.admin.seo.vendor-seo-content', $data);
    }
    else{
      $data['seo_data'] = get_seo_data();

      $is_vendor = is_vendor_login(); 
      $sidebar['is_vendor_login'] = $is_vendor;
      $data['sidebar_data'] = $sidebar;

      return view('pages.admin.seo.seo-content', $data);
    }
  }

    /**
   * 
   * Save/Update page data
   *
   * @param page slug for update
   * @return response
   */
  public function savePagesData($params = null){
    if( Request::isMethod('post') && Session::token() == Request::Input('_token') ){
      $data = Request::all();

      $rules =  [
                  'page_title'  => 'required',
                ];

      $validator = Validator:: make($data, $rules);
      
      if($validator->fails()){
        return redirect()-> back()
        ->withInput()
        ->withErrors( $validator );
      }
      else{
        $post = new Post;
        $post_slug = create_unique_slug('post', Request::Input('page_title'));
        
        if(Request::Input('hf_post_type') == 'add'){
          $post->post_author_id         =   Session::get('shopist_admin_user_id');
          $post->seo_title              =   Request::Input('seo_title');
          $post->seo_description        =   Request::Input('seo_description');
          $post->seo_keywords           =   Request::Input('seo_keywords');
          $post->post_content           =   string_encode(Request::Input('page_description_editor'));
          $post->post_title             =   strip_tags(Request::Input('page_title'));
          $post->post_slug              =   $post_slug;
          $post->parent_id              =   0;
          $post->post_status            =   Request::Input('pages_visibility');
          $post->post_type              =   'page';
          
          if($post->save()){
            Session::flash('success-message', Lang::get('admin.successfully_saved_msg') );
            return redirect()->route('admin.update_page', $post->post_slug);
          }
        }
        elseif(!empty($params) && Request::Input('hf_post_type') == 'update'){
          $data = array(
                      'post_author_id'         =>  Session::get('shopist_admin_user_id'),
                      'seo_title'              =>  Request::Input('seo_title'),
                      'seo_description'        =>  Request::Input('seo_description'),
                      'seo_keywords'           =>  Request::Input('seo_keywords'),
                      'post_content'           =>  string_encode(Request::Input('page_description_editor')),
                      'post_title'             =>  strip_tags(Request::Input('page_title')),
                      'post_status'            =>  Request::Input('pages_visibility')
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
   * Get page data
   *
   * @param page slug
   * @return object
   */
  public function get_page_by_slug($page_slug){
    $page_data = null;
    
    if(!empty($page_slug)){
      $get_page_data_by_slug = Post :: where(['post_slug' => $page_slug, 'post_type' => 'page'])->first();
      
      if(!empty($get_page_data_by_slug)){
        $page_data = $get_page_data_by_slug;
      }
    }
    
    return $page_data;
  }
  
  /**
   * 
   * Get pages list data
   *
   * @param pagination required. Boolean type TRUE or FALSE, by default false
   * @param search value optional
	 * @param status flag by default -1. -1 for all data, 1 for status enable and 0 for disable status
   * @return array
   */
  public function get_pages( $pagination = false, $search_val = null, $status_flag = -1 ){
    $pages = array();
    
    if($status_flag == -1){
        $where = ['post_type' => 'page'];
    }
    else{
        $where = ['post_type' => 'page', 'post_status' => $status_flag];
    }
    
    if($search_val && $search_val != ''){
      $pages = Post:: where($where)
               ->where('post_title', 'LIKE', '%'. $search_val.'%')
               ->orderBy('id', 'desc')
               ->get()
               ->toArray();
    }
    else{
      $pages = Post:: where($where)
               ->orderBy('id', 'desc')
               ->get()
               ->toArray();
    }
    
    if($pagination){
      $currentPage = LengthAwarePaginator::resolveCurrentPage();
      $col = new Collection( $pages );
      $perPage = 10;
      $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
      $pages_object = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);
      
      $pages_object->setPath( route('admin.all_pages') );
    }
    
    if($pagination){
      return $pages_object;
    }
    else{
      return $pages;
    }
  }
  
  /**
   * 
   * Save/Update blog data
   *
   * @param blog slug
   * @return response
   */
  public function blogPostSave($params = null){
    if( Request::isMethod('post') && Session::token() == Request::Input('_token') ){
      $data = Request::all();
      
      $rules = [
                  'blog_post_title'   => 'required'
               ];
        
      $validator = Validator:: make($data, $rules);
      
      if($validator->fails()){
        return redirect()-> back()
        ->withInput()
        ->withErrors( $validator );
      }
      else{
        $allow_for_comments     =   'yes';
        $max_number_characters  =   '';
        $allow_checkbox         =   (Request::has('allow_comments_at_frontend')) ? true : false;
        $page_title             =   '';
        $url_slug               =   '';
        $post                   =   new Post;
        $post_slug              =   '';
        
        if($allow_checkbox){
          $allow_for_comments = 'yes';
        }
        else{
          $allow_for_comments = 'no';
        }
        
        if(Request::has('allow_max_number_characters_at_frontend') && Request::Input('allow_max_number_characters_at_frontend')){
          $max_number_characters = Request::Input('allow_max_number_characters_at_frontend');
        }
        
        //seo content
        if(Request::has('seo_title') && !empty(Request::Input('seo_title'))){
          $page_title = strip_tags(Request::Input('seo_title'));
        }

        if(Request::has('seo_url_format') && !empty(Request::Input('seo_url_format'))){
          $url_slug = string_slug_format(Request::Input('seo_url_format'));
        }
        
        
        //create slug
        $post_slug = create_unique_slug('post', Request::Input('blog_post_title'));
        
        if(!empty($params)){
          $get_post   =  Post :: where('post_slug', $params)->first()->toArray();
        }
        
        if(Request::Input('hf_post_type') == 'add'){
          $post->post_author_id         =   Session::get('shopist_admin_user_id');
          $post->post_content           =   string_encode(Request::Input('blog_description_editor'));
          $post->post_title             =   strip_tags(Request::Input('blog_post_title'));
          $post->post_slug              =   $post_slug;
          $post->parent_id              =   0;
          $post->post_status            =   Request::Input('blog_post_visibility');
          $post->post_type              =   'post-blog';

          if($post->save()){  
            if(PostExtra::insert(
                                array(
                                      array(
                                            'post_id'       =>  $post->id,
                                            'key_name'      =>  '_featured_image',
                                            'key_value'     =>  Request::Input('image_url'),
                                            'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                            'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                      ),
                                      array(
                                            'post_id'       =>  $post->id,
                                            'key_name'      =>  '_allow_max_number_characters_at_frontend',
                                            'key_value'     =>  $max_number_characters,
                                            'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                            'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                      ),
                                      array(
                                            'post_id'       =>  $post->id,
                                            'key_name'      =>  '_allow_comments_at_frontend',
                                            'key_value'     =>  $allow_for_comments,
                                            'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                            'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                      ),
                                      array(
                                            'post_id'       =>  $post->id,
                                            'key_name'      =>  '_blog_seo_title',
                                            'key_value'     =>  $page_title,
                                            'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                            'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                      ),
                                      array(
                                            'post_id'       =>  $post->id,
                                            'key_name'      =>  '_blog_seo_url',
                                            'key_value'     =>  $url_slug,
                                            'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                            'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                      ),
                                      array(
                                            'post_id'       =>  $post->id,
                                            'key_name'      =>  '_blog_seo_description',
                                            'key_value'     =>  strip_tags(Request::Input('seo_description')),
                                            'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                            'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                      ),
                                      array(
                                            'post_id'       =>  $post->id,
                                            'key_name'      =>  '_blog_seo_keywords',
                                            'key_value'     =>  (Request::Input('seo_keywords')),
                                            'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                            'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                      )
                                )
            )){
              if(Request::has('inputCategoriesName') && count(Request::Input('inputCategoriesName'))>0){
                foreach(Request::Input('inputCategoriesName') as $cat_id){
                  ObjectRelationship::insert(array(
                                                  array(
                                                      'term_id'      =>  $cat_id,
                                                      'object_id'    =>  $post->id,
                                                      'created_at'   =>  date("y-m-d H:i:s", strtotime('now')),
                                                      'updated_at'   =>  date("y-m-d H:i:s", strtotime('now'))
                                                  )
                  ));    
                }
              }

              Session::flash('success-message', Lang::get('admin.successfully_saved_msg') );
              return redirect()->route('admin.update_blog', $post->post_slug);
            }
          }
        }
        elseif($params && Request::Input('hf_post_type') == 'update'){
          $data = array(
                      'post_author_id'         =>  Session::get('shopist_admin_user_id'),
                      'post_content'           =>  string_encode(Request::Input('blog_description_editor')),
                      'post_title'             =>  strip_tags(Request::Input('blog_post_title')),
                      'post_status'            =>  Request::Input('blog_post_visibility')
          );

          if(Post::where('post_slug', $params)->update($data)){
            
            $featured_image               = array(
                                                  'key_value'    =>  Request::Input('image_url')
            );
            
            $allow_max_number_characters  = array(
                                                  'key_value'    =>  $max_number_characters
            );
            
            $allow_comments               = array(
                                                  'key_value'    =>  $allow_for_comments
            );
            
            $data_seo_title               = array(
                                                  'key_value'    =>  $page_title
            );
            
            $data_seo_url                 = array(
                                                  'key_value'    =>  $url_slug
            );

            $data_seo_description         = array(
                                                  'key_value'    =>  strip_tags(Request::Input('seo_description'))
            );

            $data_seo_keywords            = array(
                                                  'key_value'    =>  strip_tags(Request::Input('seo_keywords'))
            );

            
            PostExtra::where(['post_id' => $get_post['id'], 'key_name' => '_featured_image'])->update($featured_image);
            PostExtra::where(['post_id' => $get_post['id'], 'key_name' => '_allow_max_number_characters_at_frontend'])->update($allow_max_number_characters);
            PostExtra::where(['post_id' => $get_post['id'], 'key_name' => '_allow_comments_at_frontend'])->update($allow_comments);
            PostExtra::where(['post_id' => $get_post['id'], 'key_name' => '_blog_seo_title'])->update($data_seo_title);
            PostExtra::where(['post_id' => $get_post['id'], 'key_name' => '_blog_seo_url'])->update($data_seo_url);
            PostExtra::where(['post_id' => $get_post['id'], 'key_name' => '_blog_seo_description'])->update($data_seo_description);
            PostExtra::where(['post_id' => $get_post['id'], 'key_name' => '_blog_seo_keywords'])->update($data_seo_keywords);
              
            $is_cat_exist = ObjectRelationship::where('object_id', $get_post['id'])->get();
              
            if(Request::has('inputCategoriesName') && count(Request::Input('inputCategoriesName'))>0){
              if(count($is_cat_exist)>0){
                ObjectRelationship::where('object_id', $get_post['id'])->delete();
              }

              foreach(Request::Input('inputCategoriesName') as $cat_id){
                ObjectRelationship::insert(array(
                                                array(
                                                    'term_id'      =>  $cat_id,
                                                    'object_id'    =>  $get_post['id'],
                                                    'created_at'   =>  date("y-m-d H:i:s", strtotime('now')),
                                                    'updated_at'   =>  date("y-m-d H:i:s", strtotime('now'))
                                                )
                ));    
              }
            }
            else{
              if(count($is_cat_exist)>0){
                ObjectRelationship::where('object_id', $get_post['id'])->delete();
              }
            }
            
            Session::flash('success-message', Lang::get('admin.successfully_updated_msg'));
            return redirect()->route('admin.update_blog', $params);
          }
        }
      }
    }
  }
  
  /**
   * 
   * Get blog data
   *
   * @param blog slug
   * @return array
   */
  public function get_blog_by_slug($blog_slug){
    $get_blog_data_by_slug = array();
    
    if(!empty($blog_slug)){
      $get_blog  = DB::table('posts')
                      ->where(['post_slug' => $blog_slug, 'post_type' => 'post-blog'])
                      ->join('post_extras', 'posts.id', '=', 'post_extras.post_id')
                      ->select( 'posts.*', DB::raw("max(CASE WHEN post_extras.key_name = '_featured_image' THEN post_extras.key_value END) as featured_image"), DB::raw("max(CASE WHEN post_extras.key_name = '_allow_max_number_characters_at_frontend' THEN post_extras.key_value END) as allow_max_number_characters_at_frontend"), DB::raw("max(CASE WHEN post_extras.key_name = '_allow_comments_at_frontend' THEN post_extras.key_value END) as allow_comments_at_frontend"), DB::raw("max(CASE WHEN post_extras.key_name = '_blog_seo_title' THEN post_extras.key_value END) as blog_seo_title"), DB::raw("max(CASE WHEN post_extras.key_name = '_blog_seo_url' THEN post_extras.key_value END) as blog_seo_url"), DB::raw("max(CASE WHEN post_extras.key_name = '_blog_seo_description' THEN post_extras.key_value END) as blog_seo_description"), DB::raw("max(CASE WHEN post_extras.key_name = '_blog_seo_keywords' THEN post_extras.key_value END) as blog_seo_keywords") )
                      ->groupBy('post_extras.post_id')
                      ->first();
                                    
      if(!empty($get_blog)){
        $get_blog_data_by_slug = (array) $get_blog;  
      }
    }

    return $get_blog_data_by_slug;                            
  }
  
  /**
   * Get function for blog selected categories by object id
   *
   * @param object id
   * @return array
   */
  public function get_blog_cat_list_by_object_id($object_id){
    $cat_array = array();
    $get_cat_data = DB::table('terms')
                    ->where(['terms.type' => 'blog_cat', 'object_relationships.object_id' => $object_id])
                    ->join('object_relationships', 'object_relationships.term_id', '=', 'terms.term_id')
                    ->select('object_relationships.term_id')        
                    ->get()
                    ->toArray();
    
    if(count($get_cat_data) > 0){
      $cat_array = $get_cat_data;
    }
    
    return $cat_array;
  }

  /**
   * Get function for blog selected categories data by object id
   *
   * @param object id
   * @return array
   */
  public function get_blog_cat_data_by_object_id( $object_id ){
    $cat_array = array();
    $get_cat_data = DB::table('terms')
                        ->where(['terms.type' => 'blog_cat', 'object_relationships.object_id' => $object_id])
                        ->join('object_relationships', 'object_relationships.term_id', '=', 'terms.term_id')
                        ->join('term_extras', 'terms.term_id', '=', 'term_extras.term_id')
                        ->select('terms.term_id', 'terms.name', 'terms.slug', 'terms.type', 'terms.parent', 'terms.status', 'terms.created_at', 'terms.updated_at', DB::raw("max(CASE WHEN term_extras.key_name = '_category_description' THEN term_extras.key_value END) as category_description"),  DB::raw("max(CASE WHEN term_extras.key_name = '_category_img_url' THEN term_extras.key_value END) as category_img_url"))   
                        ->groupBy('term_extras.term_id') 
                        ->get()
                        ->toArray();

    $get_cat_data = collect($get_cat_data)->map(function($x){ return (array) $x; })->toArray();   
                  
    if(is_array($get_cat_data) && count($get_cat_data) > 0){
      $cat_array = $get_cat_data;
    }
    
    
    return $cat_array;
  }
  
  /**
   * Create blog cat id array
   *
   * @param object id
   * @return array
   */
  public function create_blog_cat_id_array($object_id){
    $product =  new ProductsController();
    $arr = array('term_id' => array(), 'term_details' => array());
    
    $get_cat = $this->get_blog_cat_list_by_object_id( $object_id );
   
    if(is_array($get_cat) && count($get_cat) > 0){
      foreach($get_cat as $id){
        array_push($arr['term_id'], $id->term_id);
      }
    }

    $get_cat_data = $this->get_blog_cat_data_by_object_id( $object_id );

    $arr['term_details'] = $get_cat_data; 
    
    return $arr;
  }
  
  /**
   * 
   * Get blogs list data
   *
   * @param pagination required. Boolean type TRUE or FALSE, by default false
   * @param search value optional
	 * @param status flag by default -1. -1 for all data, 1 for status enable and 0 for disable status
   * @return array
   */
  public function get_blogs( $pagination = false, $search_val = null, $status_flag = -1 ){
    $blogs_data;
    
    if($status_flag == -1){
        $where = ['post_type' => 'post-blog'];
    }
    else{
        $where = ['post_type' => 'post-blog', 'post_status' => $status_flag];
    }
    
    if($search_val && $search_val != ''){
      $get_blogs = DB::table('posts') 
                       ->where($where)
                       ->where('posts.post_title', 'LIKE', '%'. $search_val .'%')
                       ->orderBy('posts.id', 'desc');
    }
    else{
      $get_blogs = DB::table('posts') 
                       ->where($where)
                       ->where('posts.post_title', 'LIKE', '%'. $search_val .'%')
                       ->orderBy('posts.id', 'desc');
    }

    $get_blogs = $get_blogs->join('post_extras', 'posts.id', '=', 'post_extras.post_id')
                           ->select('posts.*', DB::raw("max(CASE WHEN post_extras.key_name = '_featured_image' THEN post_extras.key_value END) as featured_image"), DB::raw("max(CASE WHEN post_extras.key_name = '_allow_max_number_characters_at_frontend' THEN post_extras.key_value END) as allow_max_number_characters_at_frontend"), DB::raw("max(CASE WHEN post_extras.key_name = '_allow_comments_at_frontend' THEN post_extras.key_value END) as allow_comments_at_frontend"), DB::raw("max(CASE WHEN post_extras.key_name = '_blog_seo_title' THEN post_extras.key_value END) as blog_seo_title"), DB::raw("max(CASE WHEN post_extras.key_name = '_blog_seo_url' THEN post_extras.key_value END) as blog_seo_url"), DB::raw("max(CASE WHEN post_extras.key_name = '_blog_seo_description' THEN post_extras.key_value END) as blog_seo_description"), DB::raw("max(CASE WHEN post_extras.key_name = '_blog_seo_keywords' THEN post_extras.key_value END) as blog_seo_keywords") );
        
    if($pagination){
      $blogs_data = $get_blogs->groupBy('post_extras.post_id')
                              ->paginate(10); 
    }
    else{
      $blogs_data = $get_blogs->groupBy('post_extras.post_id')
                              ->get()
                              ->toArray(); 
    }

    return $blogs_data;
  }
  
  /**
   * Get blog comments list
   *
   * @param null
   * @return array
   */
  public function getBlogCommentsList(){
    $comments_data = null;
    
    $get_comments = DB::table('comments')->where(['comments.target' => 'blog'])
                    ->join('posts', 'comments.object_id', '=', 'posts.id')
                    ->join('users', 'comments.user_id', '=', 'users.id')
                    ->select('comments.*', 'posts.post_title', 'posts.post_slug', 'users.display_name', 'users.user_photo_url')
                    ->paginate(10);
      
    if(count($get_comments) > 0){
      $comments_data = $get_comments;
    }
    
    return $comments_data;
  }
  
  /**
   * Get latest blogs
   *
   * @param null
   * @return array
   */
  public function get_latest_blogs($post_id = null){
    $blog_posts_array = array();


    $posts = DB::table('posts'); 

    if($post_id && $post_id > 0){
      $posts = $posts->where(['posts.post_type' => 'post-blog', 'posts.post_status' => 1])->where('posts.id', '!=', $post_id);
    }else{
      $posts = $posts->where(['posts.post_type' => 'post-blog', 'posts.post_status' => 1]);
    }

    $posts = $posts->join('post_extras', 'posts.id', '=', 'post_extras.post_id')
                   ->select('posts.*', DB::raw("max(CASE WHEN post_extras.key_name = '_featured_image' THEN post_extras.key_value END) as blog_image"), DB::raw("max(CASE WHEN post_extras.key_name = '_allow_max_number_characters_at_frontend' THEN post_extras.key_value END) as max_number_allow"), DB::raw("max(CASE WHEN post_extras.key_name = '_allow_comments_at_frontend' THEN post_extras.key_value END) as allow_comments"))
                   ->orderBy('posts.id', 'desc')
                   ->groupBy('post_extras.post_id')
                   ->take(3)
                   ->get()
                   ->toArray();

    if(is_array($posts) && count($posts) > 0){
      foreach($posts as $post){
        $get_post = (array) $post;

        $get_comments_details = get_comments_rating_details( $post->id, 'blog' );

        if(is_array($get_comments_details) && count($get_comments_details) > 0){
          $get_post['comments_details'] = $get_comments_details;
        }
        else{
          $get_post['comments_details'] = array();
        }

        array_push($blog_posts_array, $get_post);
      }
    }               

    return $blog_posts_array;
  }
  
  /**
   * Get blogs advanced data
   *
   * @param null
   * @return array
   */
  public function get_blog_advanced_data($post_id = null){
    $latest_data    =   array();
    $best_data      =   array();
    $advanced_data  =   array();
   
    if(count($this->get_latest_blogs($post_id)) > 0){
      $advanced_data['latest_items'] = $this->get_latest_blogs($post_id);
    }
    else{
      $advanced_data['latest_items'] = array();
    }
    
    $get_best_sales  =  DB::table('post_extras')
                        ->select('post_id', DB::raw('max(cast(key_value as SIGNED INTEGER)) as max_number'))
                        ->where('key_name', '_count_visit')
                        ->groupBy('post_id')
                        ->orderBy('max_number', 'desc')
                        ->limit(3)
                        ->get()
                        ->toArray();
    
    if(count($get_best_sales) > 0){
      foreach($get_best_sales as $row){
        if($row->post_id != $post_id){
          $post = Post::where(['id' =>$row->post_id, 'post_type' => 'post-blog', 'post_status' => 1])->get()->toArray();

          if(count($post) > 0){
            $posts = array_shift($post);

            $get_image          =   PostExtra::where(['post_id' => $row->post_id, 'key_name' => '_featured_image'])->first();
            $allow_max_number   =   PostExtra::where(['post_id' => $row->post_id, 'key_name' => '_allow_max_number_characters_at_frontend'])->first();
            $allow_comments     =   PostExtra::where(['post_id' => $row->post_id, 'key_name' => '_allow_comments_at_frontend'])->first();

            if(!empty($get_image) && isset($get_image->key_value)){
              $posts['blog_image'] = $get_image->key_value;
            }

            if(!empty($allow_max_number) && isset($allow_max_number->key_value)){
              $posts['max_number_allow'] = $allow_max_number->key_value;
            }

            if(!empty($allow_comments) && isset($allow_comments->key_value)){
              $posts['allow_comments'] = $allow_comments->key_value;
            }

            $get_comments_details = get_comments_rating_details( $row->post_id, 'blog' );

            if(count($get_comments_details) > 0){
              $posts['comments_details'] = $get_comments_details;
            }
            else{
              $posts['comments_details'] = array();
            }

            array_push($best_data, $posts);
          }
        }
      }
    }
    
    if(count($best_data) > 0){
      $advanced_data['best_items'] = $best_data;
    }
    else{
      $advanced_data['best_items'] = array(); 
    }
    
    return $advanced_data;
  }
  
  /**
   * Get function for blog post by cat slug
   *
   * @param cat slug
   * @return array
   */
  public function getBlogPostByCatSlug($cat_slug){
    $data_array = array();
    $post_array = array();
    $product =  new ProductsController();
    $selected_cat = array();
    
    $get_term = Term::where(['slug' => $cat_slug, 'type' => 'blog_cat'])->first();
    if(!empty($get_term)){
      $get_term_data = $product->getTermDataById( $get_term->term_id );
      $get_child_cat = $product->get_categories($get_term->term_id, 'blog_cat');
      $parent_id = $product->getTopParentId( $get_term->term_id );
      
      $cat_data['id']  =  $get_term_data[0]['term_id'];
      $cat_data['name']  =  $get_term_data[0]['name'];
      $cat_data['slug']  =  $get_term_data[0]['slug'];
      if($get_term_data[0]['parent'] == 0){
        $cat_data['parent']  =  'Parent Categories';
      }
      else{
        $cat_data['parent']  =  'Sub Categories';
      }
      $cat_data['parent_id']  =  $get_term_data[0]['parent'] ;
      $cat_data['description']  =  $get_term_data[0]['category_description'];
      $cat_data['img_url']  =  $get_term_data[0]['category_img_url'];
      
      if(count($get_child_cat) > 0){
        $cats_arr = $product->createCategoriesSimpleList( $get_child_cat );
        
        if(count($cats_arr) > 0){
          array_push($cats_arr, $cat_data);
          
          foreach($cats_arr as $cat){
            $get_post_data =  DB::table('posts')
                              ->where(['posts.post_status' => 1, 'posts.post_type' => 'post-blog', 'object_relationships.term_id' => $cat['id'] ])
                              ->join('object_relationships', 'object_relationships.object_id', '=', 'posts.id')
                              ->select('posts.*') 
                              ->orderBy('posts.id', 'desc')
                              ->get()
                              ->toArray();
            
            if(count($get_post_data) > 0){
              foreach($get_post_data as $post){
                $data_array[$post->id] = $post;
              }
            }
            
            array_push($selected_cat, $cat['id']);
          }
        }  
      }
      else{
        $get_post_data =  DB::table('posts')
                          ->where(['posts.post_status' => 1, 'posts.post_type' => 'post-blog', 'object_relationships.term_id' => $cat_data['id'] ])
                          ->join('object_relationships', 'object_relationships.object_id', '=', 'posts.id')
                          ->select('posts.*') 
                          ->orderBy('posts.id', 'desc')
                          ->get()
                          ->toArray();
        
        if(count($get_post_data) > 0){
          foreach($get_post_data as $post){
            $data_array[$post->id] = $post;
          }
        }
        
        array_push($selected_cat, $cat_data['id']);
      }
      
      $str = '';
      $currentPage = LengthAwarePaginator::resolveCurrentPage();
      $col = new Collection( $data_array );
      $perPage = 500;
      $currentPageSearchResults = $col->slice(($currentPage - 1) * $perPage, $perPage)->all();
      $posts_object = new LengthAwarePaginator($currentPageSearchResults, count($col), $perPage);
      $posts_object->setPath( route('blog-cat-page', $cat_data['slug']) );
      
      if($cat_data['parent_id'] > 0){
        $parent_cat = $product->getTermDataById( $cat_data['parent_id'] );
         
        $str = '<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="'. route('home-page') .'">'. Lang::get('frontend.home' ) .'</a></li><li class="breadcrumb-item"><a href="'. route('blogs-page-content') .'">'. Lang::get('frontend.blog' ) .'</a></li><li class="breadcrumb-item"><a href="'. route('blog-cat-page', $parent_cat[0]['slug']) .'">'. $parent_cat[0]['name'] .'</a></li><li class="breadcrumb-item active">'. $cat_data['name'] .'</li></ol></nav>';
      }
      else{
        $str = '<nav aria-label="breadcrumb"><ol class="breadcrumb"><li class="breadcrumb-item"><a href="'. route('home-page') .'">'. Lang::get('frontend.home' ) .'</a></li><li class="breadcrumb-item"><a href="'. route('blogs-page-content') .'">'. Lang::get('frontend.blog' ) .'</a></li><li class="breadcrumb-item active">'. $cat_data['name'] .'</li></ol></nav>';
      }
      
      $post_array['posts'] = $posts_object;
      $post_array['breadcrumb_html'] = $str;
      $post_array['selected_cat'] = $selected_cat;
      $post_array['parent_id'] = $parent_id;
      
    }
    
    return $post_array;
  }
  
  /**
   * 
   * Save/Update testimonial post data
   *
   * @param update slug
   * @return response
   */
  public function saveTestimonialPost($params = ''){
    if( Request::isMethod('post') && Session::token() == Request::Input('_token') ){
      $data = Request::all();

      $rules =  [
                  'testimonial_post_title'  => 'required',
                ];

      $validator = Validator:: make($data, $rules);
      
      if($validator->fails()){
        return redirect()-> back()
        ->withInput()
        ->withErrors( $validator );
      }
      else{
        $post = new Post;

        $post_slug = create_unique_slug('post', Request::Input('testimonial_post_title'));
        
        if(Request::Input('hf_post_type') == 'add'){
          $post->post_author_id         =   Session::get('shopist_admin_user_id');
          $post->post_content           =   string_encode(Request::Input('testimonial_description_editor'));
          $post->post_title             =   strip_tags(Request::Input('testimonial_post_title'));
          $post->post_slug              =   $post_slug;
          $post->parent_id              =   0;
          $post->post_status            =   Request::Input('testimonial_post_visibility');
          $post->post_type              =   'testimonial';
          
          if($post->save()){
            if(PostExtra::insert(array(
                                array(
                                      'post_id'       =>  $post->id,
                                      'key_name'      =>  '_testimonial_image_url',
                                      'key_value'     =>  Request::Input('image_url'),
                                      'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                      'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                ),
                                array(
                                      'post_id'       =>  $post->id,
                                      'key_name'      =>  '_testimonial_client_name',
                                      'key_value'     =>  strip_tags(Request::Input('testimonial_client_name')),
                                      'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                      'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                ),
                                array(
                                      'post_id'       =>  $post->id,
                                      'key_name'      =>  '_testimonial_job_title',
                                      'key_value'     =>  strip_tags(Request::Input('testimonial_job_title')),
                                      'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                      'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                ),
                                array(
                                      'post_id'       =>  $post->id,
                                      'key_name'      =>  '_testimonial_company_name',
                                      'key_value'     =>  strip_tags(Request::Input('testimonial_company_name')),
                                      'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                      'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                ),
                                array(
                                      'post_id'       =>  $post->id,
                                      'key_name'      =>  '_testimonial_url',
                                      'key_value'     =>  strip_tags(Request::Input('testimonial_url')),
                                      'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                      'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                )
            ))){
              Session::flash('success-message', Lang::get('admin.successfully_saved_msg') );
              return redirect()->route('admin.update_testimonial_post_content', $post->post_slug);
            }
          }
        }
        elseif($params && Request::Input('hf_post_type') == 'update'){
          
          $data = array(
                      'post_author_id'         =>  Session::get('shopist_admin_user_id'),
                      'post_content'           =>  string_encode(Request::Input('testimonial_description_editor')),
                      'post_title'             =>  strip_tags(Request::Input('testimonial_post_title')),
                      'post_status'            =>  Request::Input('testimonial_post_visibility')
          );

          if(Post::where('post_slug', $params)->update($data)){
            
            $get_post                 =   Post :: where('post_slug', $params)->first()->toArray();
            
            $testimonial_image_url    = array(
                                            'key_value'  =>  Request::Input('image_url')
            );
            
            $testimonial_client_name  = array(
                                            'key_value'  =>  strip_tags(Request::Input('testimonial_client_name'))
            );
            
            $testimonial_job_title    = array(
                                            'key_value'  =>  strip_tags(Request::Input('testimonial_job_title'))
            );
            
            $testimonial_company_name = array(
                                            'key_value'  =>  strip_tags(Request::Input('testimonial_company_name'))
            );
            
            $testimonial_url          = array(
                                            'key_value'  =>  strip_tags(Request::Input('testimonial_url'))
            );
            
            
            PostExtra::where(['post_id' => $get_post['id'], 'key_name' => '_testimonial_image_url'])->update($testimonial_image_url);
            PostExtra::where(['post_id' => $get_post['id'], 'key_name' => '_testimonial_client_name'])->update($testimonial_client_name);
            PostExtra::where(['post_id' => $get_post['id'], 'key_name' => '_testimonial_job_title'])->update($testimonial_job_title);
            PostExtra::where(['post_id' => $get_post['id'], 'key_name' => '_testimonial_company_name'])->update($testimonial_company_name);
            PostExtra::where(['post_id' => $get_post['id'], 'key_name' => '_testimonial_url'])->update($testimonial_url);
            
            Session::flash('success-message', Lang::get('admin.successfully_updated_msg'));
            return redirect()->route('admin.update_testimonial_post_content', $params);
          }
        }
      }
    }
  }
  
  /**
   * 
   * Get testimonial post data by slug
   *
   * @param slug
   * @return array
   */
  public function get_testimonial_data_by_slug($slug){
    $testimonial_array =   array();
    
    if(isset($slug)){
      $get_post  =   Post :: where('post_slug', $slug)->first();
      
      if(!empty($get_post) && $get_post->count() > 0){
         
        if(isset($get_post->id)){
          $testimonial_array['id'] = $get_post->id;
        }
        if(isset($get_post->post_author_id)){
          $testimonial_array['post_author_id'] = $get_post->post_author_id;
        }
        if(isset($get_post->post_content)){
          $testimonial_array['post_content'] = $get_post->post_content;
        }
        if(isset($get_post->post_title)){
          $testimonial_array['post_title'] = $get_post->post_title;
        }
        if(isset($get_post->post_slug)){
          $testimonial_array['post_slug'] = $get_post->post_slug;
        }
        if(isset($get_post->parent_id)){
          $testimonial_array['parent_id'] = $get_post->parent_id;
        }
        if(isset($get_post->post_status)){
          $testimonial_array['post_status'] = $get_post->post_status;
        }
        if(isset($get_post->post_type)){
          $testimonial_array['post_type'] = $get_post->post_type;
        }
        if(isset($get_post->created_at)){
          $testimonial_array['created_at'] = $get_post->created_at;
        }
        if(isset($get_post->updated_at)){
          $testimonial_array['updated_at'] = $get_post->updated_at;
        }
       
        $get_post_meta  = PostExtra::where(['post_id' => $testimonial_array['id']])->get()->toArray();
        
        
        if(count($get_post_meta) > 0){
          
          foreach($get_post_meta as $post_meta_data){
      
            if($post_meta_data['key_name'] == '_testimonial_image_url'){
              $testimonial_array['testimonial_image_url'] = $post_meta_data['key_value'];
            }
            
            if($post_meta_data['key_name'] == '_testimonial_client_name'){
              $testimonial_array['testimonial_client_name'] = $post_meta_data['key_value'];
            }
            
            if($post_meta_data['key_name'] == '_testimonial_job_title'){
              $testimonial_array['testimonial_job_title'] = $post_meta_data['key_value'];
            }
            
            if($post_meta_data['key_name'] == '_testimonial_company_name'){
              $testimonial_array['testimonial_company_name'] = $post_meta_data['key_value'];
            }
            
            if($post_meta_data['key_name'] == '_testimonial_url'){
              $testimonial_array['testimonial_url'] = $post_meta_data['key_value'];
            }
            
          }
        }
      }
    }
     
    return $testimonial_array;
  }
  
  /**
   * 
   * Get testimonial list data
   *
   * @param pagination required. Boolean type TRUE or FALSE, by default false
   * @param search value optional
	 * @param status flag by default -1. -1 for all data, 1 for status enable and 0 for disable status
   * @return array
   */
  public function get_testimonials($pagination = false, $search_val = null, $status_flag = -1){
    $testimonials;
    
    if($status_flag == -1){
        $where = ['posts.post_type' => 'testimonial'];
    }
    else{
        $where = ['posts.post_type' => 'testimonial', 'posts.post_status' => $status_flag];
    }

    
    if($search_val && $search_val != ''){
      $get_testimonials = DB::table('posts')
                              ->where($where)
                              ->where('posts.post_title', 'LIKE', '%' .$search_val. '%')
                              ->orderBy('posts.id', 'desc');
    }
    else{
      $get_testimonials = DB::table('posts')
                              ->where($where)  
                              ->orderBy('posts.id', 'desc');
    }

    $get_testimonials = $get_testimonials->join('post_extras', 'posts.id', '=', 'post_extras.post_id')
                                         ->select('posts.*', DB::raw("max(CASE WHEN post_extras.key_name = '_testimonial_image_url' THEN post_extras.key_value END) as testimonial_image_url"), DB::raw("max(CASE WHEN post_extras.key_name = '_testimonial_client_name' THEN post_extras.key_value END) as testimonial_client_name"), DB::raw("max(CASE WHEN post_extras.key_name = '_testimonial_job_title' THEN post_extras.key_value END) as testimonial_job_title"), DB::raw("max(CASE WHEN post_extras.key_name = '_testimonial_company_name' THEN post_extras.key_value END) as testimonial_company_name"), DB::raw("max(CASE WHEN post_extras.key_name = '_testimonial_url' THEN post_extras.key_value END) as testimonial_url"));  
    
    
    if($pagination){
      $testimonials = $get_testimonials->groupBy('post_extras.post_id')->paginate(10);
    }
    else{
      $testimonials = $get_testimonials->groupBy('post_extras.post_id')->get()->toArray();
    }

    return $testimonials;
  }
  
  /**
  * 
  * Save manufacturers data
  *
  * @param update id
  * @return void
  */
  public function saveManufacturersData($params = null){
    if( Request::isMethod('post') && Session::token() == Request::Input('_token') ){
      $data = Request::all();
      
      $rules = [
                'inputManufacturersName'   => 'required',
                'inputCountryName'         => 'required'
               ];
        
      $validator = Validator:: make($data, $rules);
      
      if($validator->fails()){
        return redirect()-> back()
        ->withInput()
        ->withErrors( $validator );
      }
      else{ 
        $termObj			 =		new Term;
				$termExtraObj	 =		new TermExtra;
        $post_slug     =    '';
        
        $post_slug = create_unique_slug('term', Request::Input('inputManufacturersName'));

        if($params && Request::is('admin/manufacturers/update/*')){
          $data = array(
                        'name'				=>    strip_tags(Request::Input('inputManufacturersName')),
                        'status'      =>    Request::Input('inputStatus')
          );
          
          if( Term::where('slug', $params)->update($data)){
            $getTerm = Term :: where('slug', $params)->first();
            
            $brand_country_name = array(
                                  'key_value'   =>  strip_tags(Request::Input('inputCountryName'))
            );

            $brand_short_description = array(
                                       'key_value'   =>  string_encode(Request::Input('inputShortDescription'))
            );
            
            $brand_logo_img_url = array(
                                  'key_value'   =>  Request::Input('logo_img')
            );

            TermExtra::where(['term_id' => $getTerm->term_id, 'key_name' => '_brand_country_name'])->update($brand_country_name);
            TermExtra::where(['term_id' => $getTerm->term_id, 'key_name' => '_brand_short_description'])->update($brand_short_description);
            TermExtra::where(['term_id' => $getTerm->term_id, 'key_name' => '_brand_logo_img_url'])->update($brand_logo_img_url);

            Session::flash('success-message', Lang::get('admin.successfully_updated_msg'));
            return redirect()->route('admin.update_manufacturers_content', $params);
          }
        }
        else {
          $termObj->name        =   strip_tags(Request::Input('inputManufacturersName'));
          $termObj->slug        =   $post_slug;
          $termObj->type				=   'product_brands';
          $termObj->parent		  =   0;
          $termObj->status			=   Request::Input('inputStatus');
          
          if( $termObj->save() ){
            if(TermExtra::insert(array(
                                    array(
                                        'term_id'       =>  $termObj->id,
                                        'key_name'      =>  '_brand_country_name',
                                        'key_value'     =>  strip_tags(Request::Input('inputCountryName')),
                                        'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                        'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                    ),
                                    array(
                                        'term_id'       =>  $termObj->id,
                                        'key_name'      =>  '_brand_short_description',
                                        'key_value'     =>  string_encode(Request::Input('inputShortDescription')),
                                        'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                        'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                    ),
                                    array(
                                        'term_id'       =>  $termObj->id,
                                        'key_name'      =>  '_brand_logo_img_url',
                                        'key_value'     =>  Request::Input('logo_img'),
                                        'created_at'    =>  date("y-m-d H:i:s", strtotime('now')),
                                        'updated_at'    =>  date("y-m-d H:i:s", strtotime('now'))
                                    )
                                )
            )){
              Session::flash('success-message', Lang::get('admin.successfully_saved_msg'));
              return redirect()->route('admin.update_manufacturers_content', $termObj->slug);
            }
          }
        }
      }
    }
    else {
      return redirect()-> back();
    }
  }
  
  /**
   * 
   * Update SEO data
   *
   * @param null
   * @return response
   */
  public function updateSeoData(){
    if( Request::isMethod('post') && Session::token() == Request::Input('_token') ){
      $option = new OptionController();	
      
      if(is_vendor_login()){
        $get_user_store_data = get_user_account_details_by_user_id( Session::get('shopist_admin_user_id') );
        $data = json_decode(array_shift($get_user_store_data)['details']);
        
        $data->seo->meta_keywords   = strip_tags(Request::Input('inputMetaKeywords'));
        $data->seo->meta_decription = strip_tags(Request::Input('inputMetaDescription'));
        
        $update_data = array(
                      'details' => json_encode($data)
        );
        
        if(UsersDetail::where('user_id', Session::get('shopist_admin_user_id'))->update( $update_data )){
          Session::flash('success-message', Lang::get('admin.successfully_updated_msg'));
          return redirect()->back();
        }
      }
      else{
        $seo_data  =   $option->getSEOData();
        
        if(isset($seo_data['meta_tag']['meta_keywords']) || empty($seo_data['meta_tag']['meta_keywords'])){
          $seo_data['meta_tag']['meta_keywords'] = strip_tags(Request::Input('inputMetaKeywords')); 
        }
        if(isset($seo_data['meta_tag']['meta_description']) || empty($seo_data['meta_tag']['meta_description'])){
          $seo_data['meta_tag']['meta_description'] = strip_tags(Request::Input('inputMetaDescription')); 
        }

        $data = array(
                     'option_value' => serialize($seo_data)
        );
        
        if( Option::where('option_name', '_seo_data')->update($data)){
          Session::flash('success-message', Lang::get('admin.successfully_updated_msg'));
          return redirect()->back();
        }
      }
    } 
  }
}