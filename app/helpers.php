<?php
use App\Models\AdminModels\Admin;
use App\Models\AdminModels\SiteSetting;
use App\Models\ProductCategory;
use App\Models\BrandAttribute;
use App\Models\ColorAttribute;
use App\Models\VariationImage;
use App\Models\Product;
use App\Models\ProductGallary;
use App\Models\ProductVariation;
use App\Models\User;
use App\Models\CartSession;
use App\Models\GraphicsCard;
use App\Models\HardDrive;
use App\Models\Processor;
use App\Models\RAM;
use App\Models\ScreenSize;
use App\Models\SSD;
use App\Models\Type;
use App\Models\HomePage;
use App\Models\Coupon;
use App\Models\BillingAddress;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\BankAccount;
use App\Models\Chipset;
use App\Models\ChipsetGallery;
use App\Models\ChipsetSubCategory;
use App\Models\ProductCategoryRelationship;
use App\Models\ProductChipsetCatRelation;
use App\Models\PaymentMethod;
use App\Models\TermRelation;
use App\Models\GiftcardCategory;
use App\Models\GiftcardsGallery;
use App\Models\GiftcardDetail;
use App\Models\SeoTags;
use App\Models\ContactRequest;
use App\Models\ProductRating;
use App\Models\Conversation;
use App\Models\Message;


#->Admins profile image by id
if(!function_exists('AdminsProfileImageById'))
{
	function AdminsProfileImageById($admins_id)
	{
		$admins_profile_image = Admin::where('id',$admins_id)->value('profile_image');
		if(empty(trim($admins_profile_image)))
		{
			$admins_profile_image='admins_default.png';
		}

		return $admins_profile_image_path = url(Config::get('constants.PROFILE_IMAGE_PATH').$admins_profile_image);
	}
}

//admin name
if(!function_exists('AdminsNameById'))
{
	function AdminsNameById($admins_id)
	{
	    $admins_name = '';
	    if(!empty($admins_id)){
		$fname = Admin::where('id',$admins_id)->value('first_name');
		$lname = Admin::where('id',$admins_id)->value('last_name');
	    }

		return $fname.' '.$lname;
	}
}

 #->Meta vale by meta keys
if(!function_exists('metaTagsByKeyPage'))
{
	function metaTagsByKeyPage($page=null,$metaField=null)
	{
		$metaPageFiedval='';
		if(!empty($page) && !empty($metaField))
		{
			$metaPageFiedval = SeoTags::where('page',$page)->value($metaField);
		}
		return $metaPageFiedval;
	}

}

 #->randum sting
 if(!function_exists('Random_String'))
 {
	function Random_String($length=0, $chars=NULL)
	{
		    if (NULL == $chars) {
	          // makes a random alpha numeric string of a given lenth
	         $chars = array_merge(range('A', 'Z'), range('a', 'z'),range(0, 9));
            }
            $out ='';
		    for($c=0;$c < $length;$c++) {
		 	  $out .= $chars[mt_rand(0,count($chars)-1)];
		   }
         return strtoupper($out);
	}
  }

/*Setting Name get Function*/
if(!function_exists('SiteSettingByName'))
{
    function SiteSettingByName($SettingName=Null)
    {
        if(!empty($SettingName))
        {
            $SettingVal='';
            $SettingVal=  SiteSetting::where('setting_name','=',$SettingName)->value('setting_val');
        }
         return $SettingVal;
    }
}

//get user details by id
function getUserDetailsById($user_id){
    $user_details = '';
    if(!empty($user_id)){
        $user_details = User::find($user_id);
    }
    return $user_details;
}

//slug function

function slugify($str) {
    $search = array('', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');
    $replace = array('s', 't', 's', 't', 's', 't', 's', 't', 'i', 'a', 'a', 'i', 'a', 'a', 'e', 'E');
    $str = str_ireplace($search, $replace, strtolower(trim($str)));
    $str = preg_replace('/[^\w\d\-\ ]/', '', $str);
    $str = str_replace(' ', '-', $str);
    return preg_replace('/\-{2,}/', '-', $str);
}

//get all categories
function getallCategories(){
    $categories = '';

    $categories = ProductCategory::orderBy('title','ASC')->get();
    return $categories;
}

//get all categories
function getallCategoriesFooter(){
    $categories = '';

    $categories = ProductCategory::orderBy('title','ASC')->limit(20)->get();
    return $categories;
}

//get category detail by id
function getcatdetailByID($catid){
    $cat_details = '';

    $cat_details = ProductCategory::where('id',$catid)->get();
    return $cat_details;
}

//get all colors
function getallColors(){
    $colors = '';

    $colors = ColorAttribute::orderBy('id','DESC')->get();
    return $colors;
}

//get all brands
function getallBrands(){
    $brands = '';
    $brands = BrandAttribute::orderBy('name','ASC')->get();
    return $brands;


}
function getallBrandsBYCategories($categoriesArray){
    $brands = '';
    if (empty($categoriesArray)) {
        $query = BrandAttribute::orderBy('name','ASC');
    } else {
        $query = BrandAttribute::orderBy('name','ASC');
        $query->whereIn('brand_category_id',$categoriesArray);
    }
    $brands = $query->get();
    return $brands;


}

//brand detail by id
function branddetailById($brand_id){
    $brandDetails = '';
    if(!empty($brand_id)){
    $brandDetails = BrandAttribute::find($brand_id);
    }
    return $brandDetails;
}


//color detail by id
function clorDetailById($color_id){
    $colordetails = '';
    if(!empty($color_id)){
        $colordetails = ColorAttribute::where('id',$color_id)->get();
    }
    return $colordetails;
}

//get all products
function getallproducts(){
    $products = '';
    $products = Product::get();
    return $products;
}

//get all users
function getallusers(){
    $users = '';
    $users = User::get();
    return $users;
}


//product detail by id
function productDetailById($product_id){
    $prodDetail = '';
    if(!empty($product_id)){
    $data = Product::find($product_id);
        if(!empty($data)){
            $prodDetail = $data;
        }
    }
    return $prodDetail;
}

//product gallery images by prod id
function prodGalleryimagesById($product_id){
    $product_gallery = '';
    $product_gallery = ProductGallary::where('product_id',$product_id)->get();
    return $product_gallery;
}


//get variation image by id
function getVariationImageById($var_id){
    $variationImagedetails = '';
    if(!empty($var_id)){
        $variationImagedetails = VariationImage::where('variation_id',$var_id)->get();
    }
    return $variationImagedetails;
}


//get variation detail by variation id
function getVariationdetailById($var_id){
    $variation_details = '';
    $variation_details = ProductVariation::with(["color_details","ssd_details","screen_size_details","ram_details"])->find($var_id);
    return $variation_details;
}

//get product variation by prod id
function getProdvariationById($product_id){
    $prod_variations = '';
    $prod_variations = ProductVariation::with(["color_details","ssd_details","screen_size_details","ram_details"])->where('product_id',$product_id)->get();
    return $prod_variations;
}

//get products by category id
function getProductsByCatId($cat_id){
    $category_products = '';
    $category_products = ProductCategoryRelationship::where('category_id',$cat_id)->get();
    return $category_products;
}

function userCart($user_id){
    $CartSession = '';
    $CartSession = CartSession::where('session_key',$user_id)->orderBy('id','DESC')->get();
    return $CartSession;
}

//get all graphic card
function get_all_graphiccards(){
    $graphic_cards = '';
    $graphic_cards = GraphicsCard::orderBy('id','DESC')->get();
    return $graphic_cards;
}

//get all hard drive
function getallHradDrive(){
    $hardDrives = '';
    $hardDrives = HardDrive::orderBy('id','DESC')->get();
    return $hardDrives;
}

//get all processors
function getallProcessors(){
    $processors  = '';
    $processors = Processor::orderBy('id','DESC')->get();
    return $processors;
}

//get all ram
function getallRams(){
    $rams = '';
    $rams = RAM::orderBy('id','DESC')->get();
    return $rams;
}

//get all screen sizes
function getallScreenSizes(){
    $screeSizes = '';
    $screeSizes = ScreenSize::orderBy('id','DESC')->get();
    return $screeSizes;
}

//get all ssd
function getallSSD(){
    $ssd = '';
    $ssd = SSD::orderBy('id','DESC')->get();
    return $ssd;
}

//get all types
function getalltypes(){
    $types = '';
    $types = Type::orderBy('id','DESC')->get();
    return $types;
}

//get min price
function getminprice(){
    $min_price = '';
    $min_price = Product::min('price');
    return round($min_price);
}

//get max price
function getmaxprice(){
    $max_price = '';
    $max_price = Product::max('price');
    return round($max_price);
}

//home page data by id
function homepagesectionById($section_id){
    $section_data = '';
    $section_data = HomePage::find($section_id);
    return $section_data;
}

//email by user id
function EmailByUserId($user_id=null)
   {
      $userEmail='';
      if(!empty($user_id))
      {
        $userData = User::find($user_id);
        //print_r($userData->email);
        $userEmail = strtolower($userData->email);
      }
      return $userEmail;
    }

function userFullNameById($user_id=null)
	{
		$fullName='';
		if(!empty($user_id))
		{
			$getuserInfo = User::select('first_name','last_name')->where('id','=',$user_id)->get();
			$first_name  = $getuserInfo[0]['first_name'];
			$last_name   = $getuserInfo[0]['last_name'];
			$fullName    = ucfirst($first_name).' '.$last_name;
		}
		return $fullName;
	}


//coupon detail by code
function coupondetailByCode($coupon_code){
    $coupon_details = '';
    $coupon_details = Coupon::where('coupon_code',$coupon_code)->first();
    return $coupon_details;
}

//billing address by user id
function billingdetailById($user_id){
    $billing_detail = '';
    $billing_detail = BillingAddress::where('user_id',$user_id)->first();
    return $billing_detail;
}


//get order detail by Id
function getOrderById($order_id){
    $order_details = '';
    $order_details = Order::find($order_id);
    return $order_details;
}

//get all bank accounts
function getallbankaccount(){
    $bank_accounts = '';
    $bank_accounts = BankAccount::orderBy('id','DESC')->get();
    return $bank_accounts;
}

//order items by id
function orderItemsById($order_id){
    $order_items = '';
    $order_items = OrderItems::where('order_id',$order_id)->get();
    return $order_items;
}

//order status string
function orderStausByKey($status){
    if($status == 'pending_payment'){
        return 'Pending Payment';
    }
    elseif($status == 'processing'){
        return 'Processing';
    }
    elseif($status == 'completed'){
        return 'Completed';
    }
    elseif($status == 'cancelled'){
        return 'Cancelled';
    }elseif($status == 'dispatched'){
        return 'Dispatched';
    }
}

//get chipset tile by id
function getchipsetById($chipset_id){
    $chipset = '';
    $chipset = Chipset::find($chipset_id);
    return $chipset;
}

//payment method name by code
function paymentMethodnameByCode($code){
    $method_detail = '';
    $method_detail = PaymentMethod::where('value',$code)->first();
    return $method_detail;
}

//billing address by user id
function billingAddressByUserId($user_id){
    $billingAddress = '';
    $billingAddress = BillingAddress::where('user_id',$user_id)->first();
    return $billingAddress;
}

//billing address by order id
function billingAddressByOrderId($order_id){
    $billingAddress = '';
    $billingAddress = BillingAddress::where('order_id',$order_id)->first();
    return $billingAddress;
}


//get chipset gallery images
function chipsetSubCatDetailById($chipcat_id){
    $chisubcat_detail = '';
    $chisubcat_detail = ChipsetSubCategory::find($chipcat_id);
    return $chisubcat_detail;
}

//get chipset sub cat
function getChipsetSubCatbyChipId($chip_id){
    $chipsubcat = '';
    $chipsubcat = ChipsetSubCategory::where('chipset_id',$chip_id)->get();
    return $chipsubcat;
}


//chip sub cat products
function chipSubcatproductsById($chip_cat_id){
    $chipcatProducts = '';
    $chipcatProducts = ProductChipsetCatRelation::where('chip_cat_id',$chip_cat_id)->get();
    return $chipcatProducts;
}

//term relation by type and product id
function getTermsByTypeandProductId($product_id, $type){
    $termProducts = '';
    $termProducts = TermRelation::where([
        ['term_type',$type],
        ['product_id',$product_id]
        ])->get();
    return $termProducts;
}

//get RAM term name by id
function termRamNameById($term_id){
    $termDetails = '';
    $termDetails = RAM::find($term_id);
    return $termDetails;
}

//get RAM term name by id
function termSSDNameById($term_id){
    $termDetails = '';
    $termDetails = SSD::find($term_id);
    return $termDetails;
}


//Gift Card category
function getallGiftCardCategories(){
    $categories = '';

    $categories = GiftcardCategory::orderBy('title','ASC')->get();
    return $categories;
}

//get variation image by id
function getGiftCardImages($giftcard_id){
    $giftcard_images = '';
    if(!empty($giftcard_id)){
        $giftcard_images = GiftcardsGallery::where('variation_id',$giftcard_id)->get();
    }
    return $giftcard_images;
}

//send gift card mail
function sendGiftCardMail($giftcards_pin){
    $giftcards_pins = '';
    if(!empty($giftcards_pins)){
        $giftcards_pin = GiftcardDetail::where('giftcard_number', '=', $giftcards_pin['recipient_emailid'])
        ->where('giftcard_pin', '=', $giftcards_pin[''])
        ->where('recipient_emailid', '=', $giftcards_pin['recipient_emailid'])->get();
    }
    return $giftcards_pins;
}


//update order status
function updateOrderStatus($order_id, $status){
    Order::where('id',$order_id)->update(['order_status' => $status]);
}

//product count for term id
function termProductCount($term_id, $type){
    $termproducts_count = array();
    $termproducts = TermRelation::where([
        ['term_id',$term_id],
        ['term_type',$type]
        ])->get();
    $termproducts_count = $termproducts->count();
    return $termproducts_count;
}

//count orders
function countOrders(){
    $orders_count = 0;
   $orders = Order::get();
   $orders_count = $orders->count();
   return $orders_count;
}

//count contact requests
function countContactRequests(){
    $countRequests = 0;
    $all_requests = ContactRequest::get();
    $countRequests = $all_requests->count();
    return $countRequests;
}

//product rating given by user
function productRatingGivenByUser($productId){
    $rating = 0;
    $ratingDetails = ProductRating::where('user_id',auth()->user()->id)->where('product_id', $productId)->first();
    if(!empty($ratingDetails)){
        $rating = $ratingDetails->rating;
    }
    return $rating;
}

//product review status of by user
function productReviewStatusOfUser($productId){
    $status = '';
    $ratingDetails = ProductRating::where('user_id',auth()->user()->id)->where('product_id', $productId)->first();
    if(!empty($ratingDetails)){
        $status = $ratingDetails->status;
    }
    return $status;
}

//limit the text
function limit_text($input,$limit){
    $out = strlen($input) > $limit ? substr($input,0,$limit)."..." : $input;
    return $out;
}

// to get time ago
if(!function_exists('time_elapsed_string'))
{
        function time_elapsed_string($ptime)
        {
            $ptime = strtotime($ptime);
            $etime = time() - $ptime;

            if ($etime < 1)
            {
                return '0 seconds';
            }

            $a = array( 365 * 24 * 60 * 60  =>  'year',
                         30 * 24 * 60 * 60  =>  'month',
                              24 * 60 * 60  =>  'day',
                                   60 * 60  =>  'hour',
                                        60  =>  'minute',
                                         1  =>  'second'
                        );
            $a_plural = array( 'year'   => 'years',
                               'month'  => 'months',
                               'day'    => 'days',
                               'hour'   => 'hours',
                               'minute' => 'minutes',
                               'second' => 'seconds'
                        );

            foreach ($a as $secs => $str)
            {
                $d = $etime / $secs;
                if ($d >= 1)
                {
                    $r = round($d);
                    return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
                }
            }
        }
}

// to check conesartion status for admin
if(!function_exists('getConversationStatusForAdmin'))
{
        function getConversationStatusForAdmin($conversation_id,$admin_id)
        {
            $message_status = false;
            $message = Message::where("conversation_id",$conversation_id)->where("receiver_id",$admin_id)->where("sender_type","Client")->where("is_seen","No")->first();
            if(!empty($message)){
                $message_status = true;
            }
            return $message_status;
        }
}

// to send otp on mobile number
if(!function_exists('sendOtpOnMobile'))
{
        function sendOtpOnMobile($mobile, $message)
        {
            try {
                $api_url = 'https://parewa.technorio.net.np/sms/api?action=send-sms&api_key=c3Rhcm9mZmljZWludGVybmF0aW9uYWw6eHFjVlR5R01qdQ==&to=+977'.$mobile.'&from=infosms&sms='.$message;

                # Make the call using API.
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $api_url);
                curl_setopt($ch, CURLOPT_HTTPGET, 1);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);


                // Response
                $response = curl_exec($ch);
                $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);
                return $response;

            } catch (\Exception $e) {

                return $e->getMessage();
            }
        }
}

// to send otp on mobile number
if(!function_exists('treeMenuFromProductCollection'))
{
        function treeMenuFromProductCollection($collection,$parent_id = null)
        {
            $output = '';
            if($collection->count()){
                            foreach($collection as $item){
                                if($item->parent_id != null){
                                    $smallIcon ='';
                                }else{
                                    if(!empty($item->small_icon)){
                                        $smallIcon = '<img class="cat_small_icon" src="'.url(Config::get('constants.SITE_PRODUCT_IMAGE').$item->small_icon ).'">';
                                    }else{
                                        $smallIcon = '<img class="cat_small_icon" src="'.url('public/img/soi_icon.png').'">';
                                    }
                                }

                                $output .= '<li class="dropdown-item">';
                                if($item->childs->count()){
                                        $output .='<a class="nav-link dropdown-toggle" href="'.route('view.product-collection',[$item->slug]).'" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> '.$smallIcon.' '.$item->title.'
                                        </a>';


                                }else{
                                    $output .='<a class="nav-link" href="'.route('view.product-collection',[$item->slug]).'"> '.$smallIcon.' '.$item->title.'
                                        </a>';
                                }

                                if($item->childs->count()){
                                    $output .= '<ul class="dropdown-menu sub_drop_down" aria-labelledby="navbarDropdown">';
                                    $output .= treeMenuFromProductCollection($item->childs,$item->parent_id);
                                    $output .= '</ul>';
                                }
                                $output .= '</li>';
                            }

            }
            return $output;
        }
}


?>
