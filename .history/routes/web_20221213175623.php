<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();
/*Route::get('/', function () {
    return view('welcome');
});*/

/*
*
* Social Login
*/

Route::get('auth/google',[App\Http\Controllers\Auth\GoogleController::class,'redirectToGoogle'])->name('google.auth');

Route::get('google/callback',[App\Http\Controllers\Auth\GoogleController::class,'handleGoogleCallback'])->name('google.callback');

Route::get('auth/facebook',[App\Http\Controllers\Auth\FacebookController::class,'redirectToFacebook'])->name('facebook.auth');

Route::get('facebook/callback',[App\Http\Controllers\Auth\FacebookController::class,'handlefacebookCallback'])->name('facebook.callback');



Route::get('/home',function(){  return redirect()->route('home'); });
Route::any('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//about page front
Route::any('/about', [App\Http\Controllers\PagesController::class, 'about'])->name('about');

//pc builder
Route::any('/build/pc', [App\Http\Controllers\PagesController::class, 'pcbuilder'])->name('pcbuilder');

//pc builder
Route::any('/search-results', [App\Http\Controllers\SearchResultController::class, 'searchResults'])->name('search.result');

//change chipset & performance ajax
Route::any('/ajax/change_chip_performance',[App\Http\Controllers\PagesController::class,'changeChipPerformance']);

//change chipset & performance ajax
Route::match(['POST','GET'],'/build/pc/{randomNumber?}',[App\Http\Controllers\PagesController::class,'continueBuild'])->name('continue.build');

//pc build tab change
Route::match(['POST','GET'],'/ajax/pc_tab_change',[App\Http\Controllers\PagesController::class,'pcbuildTabChange'])->name('tab.change');

//color change on pc builder
Route::match(['POST','GET'],'/ajax/pc_color_change',[App\Http\Controllers\PagesController::class,'pcbuildColorChange'])->name('color.change');

//add on color change
Route::match(['POST','GET'],'/ajax/pc_addon_color_change',[App\Http\Controllers\PagesController::class,'pcbuildAddonColorChange'])->name('addon.color.change');

//add on product ajax
Route::match(['POST','GET'],'/ajax/pc_addon_product_add',[App\Http\Controllers\PagesController::class,'pcbuildAddonProductAdd'])->name('addon.product.add');

//add on cat change ajax
Route::match(['POST','GET'],'/ajax/pc_addon_cat_change',[App\Http\Controllers\PagesController::class,'pcbuildAddonCatChange'])->name('chipaddcat.change');

//chip cat change ajax
Route::match(['POST','GET'],'/ajax/pc_chipcat_change',[App\Http\Controllers\PagesController::class,'pcbuildChipCatChange'])->name('chipcat.change');

//capacity change ajax
Route::match(['POST','GET'],'/ajax/pc_capacity_change',[App\Http\Controllers\PagesController::class,'pcbuildCapacityChange'])->name('capacity.change');

//add pc builder product
Route::match(['POST','GET'],'/ajax/add_pc_product',[App\Http\Controllers\PagesController::class,'AddpcbuildProduct'])->name('add.pc.product');

//delete cart item
Route::any('/ajax/delete_pc_cart_item',[App\Http\Controllers\PagesController::class,'deletePcCartItem']);

//contact page front
Route::match(['POST','GET'],'/contact-us', [App\Http\Controllers\PagesController::class, 'contact'])->name('contact');

//testmonial page front
Route::any('/testimonial', [App\Http\Controllers\PagesController::class, 'testimonial'])->name('testimonial');

//single product page

Route::get('/product/{productSlug?}', [App\Http\Controllers\ProductController::class, 'viewProduct'])->name('view.product');

//products
Route::get('/products', [App\Http\Controllers\ProductFilterController::class, 'index'])->name('view.products');

//product category
Route::get('/product-category/{productcategorySlug?}', [App\Http\Controllers\ProductCategoryBrandController::class, 'viewProductCategory'])->name('view.product.category');

//product brand
Route::get('/product-brand/{productbrandSlug?}', [App\Http\Controllers\ProductCategoryBrandController::class, 'viewProductBrand'])->name('view.product.brand');

//change color variation
Route::match(['get','post'],'/ajax/change_color',[App\Http\Controllers\ProductController::class,'changeColor']);

//submit testimonial
Route::match(['get','post'],'/ajax/submit-review',[App\Http\Controllers\HomeController::class,'submitReview']);

//add to cart
Route::get('add-to-cart/{id}', [App\Http\Controllers\Cart::class,'addToCart'])->name('add.cart');

//cart page
Route::get('/cart', [App\Http\Controllers\Cart::class,'viewCart'])->name('view.cart');

//delete cart item
Route::any('/ajax/delete_cart',[App\Http\Controllers\Cart::class,'deleteCart']);

//delete cart item
Route::any('/ajax/delete_pc_cart',[App\Http\Controllers\Cart::class,'deletePCCart']);

//update cart
Route::patch('update-cart', [App\Http\Controllers\Cart::class,'updateCart'])->name('update.cart');

//apply coupon
Route::any('/ajax/apply_coupon',[App\Http\Controllers\Cart::class,'applyCoupon']);

//checkout page
Route::get('/checkout', [App\Http\Controllers\Checkout::class, 'checkout'])->name('checkout');

//create order
Route::match(['get','post'],'/create_order',[App\Http\Controllers\Checkout::class,'createOrder'])->name('create.order');

//esewa route
Route::any('/checkout/payment/esewa', [App\Http\Controllers\EsewaController::class, 'payWithEsewa'])->name('payment.esewa');

//esewa success route
Route::any('/esewa-success', [App\Http\Controllers\EsewaController::class, 'esewaSuccess'])->name('esewa.success');
//esewa failure route
Route::any('/esewa-fail', [App\Http\Controllers\EsewaController::class, 'paymentFailure'])->name('esewa.failure');

//khalti route
Route::any('/checkout/payment/khalti', [App\Http\Controllers\KhaltiController::class, 'paywithkhalti'])->name('payment.khalti');
Route::get('payment/verification', [App\Http\Controllers\KhaltiController::class, 'verification']);

Route::get('/checkout/order-placed', [App\Http\Controllers\Checkout::class, 'thankuPage'])->name('order.placed');
Route::get('/checkout/create-Invoice', [App\Http\Controllers\Checkout::class, 'createInvoice'])->name('order.createInvoice');

//user login
Route::post('/login',[App\Http\Controllers\Auth\LoginController::class,'login'])->name('login');

//my account
Route::any('/my-account', [App\Http\Controllers\MyAccountController::class, 'dashboard'])->name('user.dashboard');
//update profile
Route::match(['get','post'],'/my-account/edit-profile', [App\Http\Controllers\MyAccountController::class, 'editProfile'])->name('user.dashboard.profile');
//update billing address
Route::match(['get','post'],'/my-account/edit-billing-address', [App\Http\Controllers\MyAccountController::class, 'updateAddress'])->name('user.dashboard.address');
//orders
Route::match(['get','post'],'/my-account/orders', [App\Http\Controllers\MyAccountController::class, 'allorders'])->name('user.dashboard.orders');
//order view 
Route::match(['get','post'],'/my-account/view-order/{orderId?}', [App\Http\Controllers\MyAccountController::class, 'vieworder'])->name('user.dashboard.view.order');
//give rating ajax
Route::any('/ajax/star_rating',[App\Http\Controllers\MyAccountController::class,'updateStarRating']);

//logout
Route::get('/logout',[App\Http\Controllers\Auth\LoginController::class,'logout'])->name('logout');

//user register
Route::post('/register',[App\Http\Controllers\Auth\RegisterController::class,'register'])->name('user.register');

//user verify
Route::get('/user/verify/{token}',[App\Http\Controllers\Auth\RegisterController::class,'verifyUser']);

//resend verification link
Route::match(['get','post'],'/ajax/resend_link',[App\Http\Controllers\Auth\LoginController::class,'resendVerifyLink']);


 //single gift card in front
Route::get('/list/giftcard/{giftcardSlug?}', [App\Http\Controllers\GiftCardContoller::class, 'viewGiftCard'])->name('view.giftcard');

//add to cart
// Route::get('add-to-gift-cart/{id}/{status}', [App\Http\Controllers\Cart::class,'addToGiftCart'])->name('add.giftcart');
Route::post('/add-to-gift-cart', [App\Http\Controllers\Cart::class,'addToGiftCart'])->name('add.giftcart');
 
// Apply Gift card 
Route::post('/apply-giftcard', [App\Http\Controllers\GiftCardContoller::class,'applyGiftcard'])->name('apply-giftcard');

//single gift card in front
Route::get('/view/giftcardform/{giftcardSlug?}', [App\Http\Controllers\GiftCardContoller::class, 'viewGiftCardForm'])->name('view.giftcardform');

 //single gift card in front
 Route::post('/check/giftcardbalanceview', [App\Http\Controllers\GiftCardContoller::class, 'viewGiftCardBalance'])->name('view.checkgiftcardbalance');
 
 
 //pdf generate
  Route::get('/invoice/pdf', [App\Http\Controllers\PdfController::class, 'index'])->name('view.invoice');
 
 


//admin login route
Route::get('web-admin/login',[App\Http\Controllers\Admin\AdminController::class,'adminLogin'])->name('admin.login');
Route::post('/web-admin/login',[App\Http\Controllers\Admin\AdminController::class,'adminDoLogin']);

Route::prefix('/web-admin/')->middleware(['IsAdmin'])->name('admin.')->group(function()
    {
        Route::get('dashboard',[App\Http\Controllers\Admin\AdminController::class,'adminDashboard'])->name('dashboard');
        Route::get('',[App\Http\Controllers\Admin\AdminController::class,'adminDashboard']);
        Route::get('logout',[App\Http\Controllers\Admin\AdminController::class,'adminLogout'])->name('logout');
        
        Route::match(['get','post'],'profile',[App\Http\Controllers\Admin\AdminController::class,'viewUpdateProfile'])->name('profile');
        Route::match(['get','post'],'password',[App\Http\Controllers\Admin\AdminController::class,'changePassword'])->name('password');
        
        //site setting
     
        Route::match(['POST','GET'],'/site-setting',[App\Http\Controllers\Admin\SiteSettingController::class,'sitesetting'])->name('site.setting'); 
        
       //giftcard
             Route::match(['POST','GET'],'/manage-giftcard',[App\Http\Controllers\Admin\GiftcardDetailController::class,'viewGiftcard'])->name('giftcard.view');
             
             //giftcard
             Route::match(['POST','GET'],'/update-giftcard',[App\Http\Controllers\Admin\GiftcardDetailController::class,'updateExpiryDate'])->name('giftcard.update');

             /////////admin/////
        //list giftcards
            Route::match(['POST','GET'],'/list-giftcard',[App\Http\Controllers\Admin\GiftcardDetailController::class,'listGiftCard'])->name('giftcard.list');
                //add update giftcard
            Route::match(['POST','GET'],'/giftcard-add-update/{enGiftCardid?}',[App\Http\Controllers\Admin\GiftcardDetailController::class,'addUpdateGiftCard'])->name('add.update.giftcard');
               //view update giftcard form
               Route::match(['POST','GET'],'/mangage-add-update-giftcard/{enGiftCardid?}',[App\Http\Controllers\Admin\GiftcardDetailController::class,'viewGiftCardForm'])->name('manage-giftcard.add_update');
       ////////////////////
       
        //home slider
       Route::match(['POST','GET'],'/manage-home-slider',[App\Http\Controllers\Admin\HomeSliderController::class,'viewslider'])->name('home.slider.view');
       Route::match(['POST','GET'],'/slider-add-update/{encsliderId?}',[App\Http\Controllers\Admin\HomeSliderController::class,'addUpdateslider'])->name('add.update.home.slider');
       Route::match(['get','post'],'/ajax/update-status-homesilider',[App\Http\Controllers\Admin\HomeSliderController::class,'changestuts']);
       Route::match(['get','post'],'/ajax/delete-home-silider',[App\Http\Controllers\Admin\HomeSliderController::class,'DyanmicDelete']);
       
       //home logo
       Route::match(['POST','GET'],'/manage-home-logo',[App\Http\Controllers\Admin\HomeLogosSliderController::class,'viewlogo'])->name('home.logo.view');
       Route::match(['POST','GET'],'/logo-add-update/{enclogoId?}',[App\Http\Controllers\Admin\HomeLogosSliderController::class,'addUpdatelogo'])->name('add.update.home.logo');
       Route::match(['get','post'],'/ajax/delete-home-logo',[App\Http\Controllers\Admin\HomeLogosSliderController::class,'DyanmicDelete']);
       Route::match(['get','post'],'/ajax/update-status-homelogo',[App\Http\Controllers\Admin\HomeLogosSliderController::class,'changestuts']);
       
       //testimonial
       Route::match(['POST','GET'],'/manage-testimonial',[App\Http\Controllers\Admin\TestimonialController::class,'viewtestimonial'])->name('testimonial.view');
       Route::match(['POST','GET'],'/testimonial-add-update/{enctestimonialId?}',[App\Http\Controllers\Admin\TestimonialController::class,'addUpdatetestimonial'])->name('add.update.testimonial');
       Route::match(['get','post'],'/ajax/delete-testimonial',[App\Http\Controllers\Admin\TestimonialController::class,'DyanmicDelete']);
       Route::match(['get','post'],'/ajax/update-status-testimonial',[App\Http\Controllers\Admin\TestimonialController::class,'changestuts']);
       
       //home getting started
       Route::match(['POST','GET'],'/manage-getting-started',[App\Http\Controllers\Admin\GettingStartedController::class,'viewgettingstarted'])->name('getting.view');
       Route::match(['POST','GET'],'/getting-add-update/{encgettingId?}',[App\Http\Controllers\Admin\GettingStartedController::class,'addUpdategetting'])->name('add.update.getting');
       Route::match(['get','post'],'/ajax/delete-getting',[App\Http\Controllers\Admin\GettingStartedController::class,'DyanmicDelete']);
       Route::match(['get','post'],'/ajax/update-status-getting',[App\Http\Controllers\Admin\GettingStartedController::class,'changestuts']);
       
       //about page update
       Route::match(['POST','GET'],'/manage-about-us',[App\Http\Controllers\Admin\PagesController::class,'updateabout'])->name('update.about');
       Route::match(['POST','GET'],'/manage-home-page',[App\Http\Controllers\Admin\PagesController::class,'updateHome'])->name('update.home');
       Route::match(['POST','GET'],'/manage-contact-page',[App\Http\Controllers\Admin\PagesController::class,'updatecontact'])->name('update.contact');
       
       //product add update
       Route::match(['POST','GET'],'/manage-products',[App\Http\Controllers\Admin\ProductController::class,'viewproducts'])->name('product.view');
       
       Route::match(['POST','GET'],'add-product',[App\Http\Controllers\Admin\ProductController::class,'addproduct'])->name('add.product');
       
       Route::match(['POST','GET'],'/product-update/{encproductId?}',[App\Http\Controllers\Admin\ProductController::class,'updateProduct'])->name('update.product');
       
       Route::match(['get','post'],'/ajax/delete-product',[App\Http\Controllers\Admin\ProductController::class,'DyanamicDelete']);
       Route::match(['get','post'],'/ajax/update-status-product',[App\Http\Controllers\Admin\ProductController::class,'updaetDyanamicStatus']);
       Route::match(['get','post'],'/ajax/delete-variation',[App\Http\Controllers\Admin\ProductController::class,'DyanamicDeleteVariation']);
       
      
      //product gallery image
        Route::post('ajax/edit-gallery',[App\Http\Controllers\Admin\ProductController::class,'ChangeGalleryimg']);
        Route::post('ajax/delete-gallery',[App\Http\Controllers\Admin\ProductController::class,'DeleteGalleryimg']);
      
       //product category manage
      
       Route::match(['POST','GET'],'/manage-product-categories',[App\Http\Controllers\Admin\ProductCategoryController::class,'viewproductcategories'])->name('product.category.view');
       
       Route::match(['POST','GET'],'/product-category-add-update/{encProductCategoryId?}',[App\Http\Controllers\Admin\ProductCategoryController::class,'addupdateProductCategory'])->name('add.update.product.category');
       
       Route::match(['get','post'],'/ajax/delete-product-category',[App\Http\Controllers\Admin\ProductCategoryController::class,'DyanamicDelete']);
       Route::match(['get','post'],'/ajax/update-status-product-category',[App\Http\Controllers\Admin\ProductCategoryController::class,'changestuts']);
       
       
       //color attribute 
      
       Route::match(['POST','GET'],'/manage-color-attributes',[App\Http\Controllers\Admin\ColorAttributeController::class,'viewcolorattributes'])->name('color.attribute.view');
       
       Route::match(['POST','GET'],'/color-add-update/{encColorAttrId?}',[App\Http\Controllers\Admin\ColorAttributeController::class,'addupdateColorAttr'])->name('add.update.color.attr');
       
       Route::match(['get','post'],'/ajax/delete-color-attribute',[App\Http\Controllers\Admin\ColorAttributeController::class,'DyanamicDelete']);
       
       
       //brand attribute 
      
       Route::match(['POST','GET'],'/manage-brand-attributes',[App\Http\Controllers\Admin\BrandAttributeController::class,'viewbrandattribute'])->name('brand.attribute.view');
       
       Route::match(['POST','GET'],'/brand-add-update/{encBrandAttrId?}',[App\Http\Controllers\Admin\BrandAttributeController::class,'addupdateBrandAttr'])->name('add.update.brand.attr');
       
       Route::match(['get','post'],'/ajax/delete-brand-attribute',[App\Http\Controllers\Admin\BrandAttributeController::class,'DyanamicDelete']);
       
       
       //graphic card
      
       Route::match(['POST','GET'],'/manage-graphic-card-attributes',[App\Http\Controllers\Admin\GraphicCardController::class,'viewgraphicattribute'])->name('graphic.attribute.view');
       
       Route::match(['POST','GET'],'/graphic-card-add-update/{encGraphicAttrId?}',[App\Http\Controllers\Admin\GraphicCardController::class,'addupdateGraphicAttr'])->name('add.update.graphic.attr');
       
       Route::match(['get','post'],'/ajax/delete-graphic-attribute',[App\Http\Controllers\Admin\GraphicCardController::class,'DyanamicDelete']);
       
       
       //hard drive
       Route::match(['POST','GET'],'/manage-hard-drive-attributes',[App\Http\Controllers\Admin\HardDriveController::class,'viewdriveattribute'])->name('drive.attribute.view');
       
       Route::match(['POST','GET'],'/hard-drive-add-update/{encDriveAttrId?}',[App\Http\Controllers\Admin\HardDriveController::class,'addupdateDriveAttr'])->name('add.update.drive.attr');
       
       Route::match(['get','post'],'/ajax/delete-drive-attribute',[App\Http\Controllers\Admin\HardDriveController::class,'DyanamicDelete']);
       
       //screen size
       Route::match(['POST','GET'],'/manage-screen-size-attributes',[App\Http\Controllers\Admin\ScreenSizeController::class,'viewScreenattribute'])->name('screen.attribute.view');
       
       Route::match(['POST','GET'],'/screen-size-add-update/{encScreenAttrId?}',[App\Http\Controllers\Admin\ScreenSizeController::class,'addupdateScreenAttr'])->name('add.update.screen.attr');
       
       Route::match(['get','post'],'/ajax/delete-screen-size-attribute',[App\Http\Controllers\Admin\ScreenSizeController::class,'DyanamicDelete']);
       
        //ssd
       Route::match(['POST','GET'],'/manage-ssd-attributes',[App\Http\Controllers\Admin\SSDController::class,'viewSSDattribute'])->name('ssd.attribute.view');
       
       Route::match(['POST','GET'],'/ssd-add-update/{encSsdAttrId?}',[App\Http\Controllers\Admin\SSDController::class,'addupdateSSDAttr'])->name('add.update.ssd.attr');
       
       Route::match(['get','post'],'/ajax/delete-ssd-attribute',[App\Http\Controllers\Admin\SSDController::class,'DyanamicDelete']);
       
       //type
       Route::match(['POST','GET'],'/manage-type-attributes',[App\Http\Controllers\Admin\TypeController::class,'viewTypeattribute'])->name('type.attribute.view');
       
       Route::match(['POST','GET'],'/type-add-update/{encTypeAttrId?}',[App\Http\Controllers\Admin\TypeController::class,'addupdateTypeAttr'])->name('add.update.type.attr');
       
       Route::match(['get','post'],'/ajax/delete-type-attribute',[App\Http\Controllers\Admin\TypeController::class,'DyanamicDelete']);
       
       //processor
       Route::match(['POST','GET'],'/manage-processor-attributes',[App\Http\Controllers\Admin\ProcessorController::class,'viewProcessorattribute'])->name('processor.attribute.view');
       
       Route::match(['POST','GET'],'/processor-add-update/{encProcessorAttrId?}',[App\Http\Controllers\Admin\ProcessorController::class,'addupdateProcessorAttr'])->name('add.update.processor.attr');
       
       Route::match(['get','post'],'/ajax/delete-processor-attribute',[App\Http\Controllers\Admin\ProcessorController::class,'DyanamicDelete']);
       
       //ram
       Route::match(['POST','GET'],'/manage-ram-attributes',[App\Http\Controllers\Admin\RamController::class,'viewRamattribute'])->name('ram.attribute.view');
       
       Route::match(['POST','GET'],'/ram-add-update/{encRamAttrId?}',[App\Http\Controllers\Admin\RamController::class,'addupdateRamAttr'])->name('add.update.ram.attr');
       
       Route::match(['get','post'],'/ajax/delete-ram-attribute',[App\Http\Controllers\Admin\RamController::class,'DyanamicDelete']);
       
       //coupon
       Route::match(['POST','GET'],'/manage-coupons',[App\Http\Controllers\Admin\CouponController::class,'viewCoupons'])->name('coupon.view');
       
       Route::match(['POST','GET'],'/coupon-add-update/{encCouponId?}',[App\Http\Controllers\Admin\CouponController::class,'addupdateCoupon'])->name('add.update.coupon');
       
       Route::match(['get','post'],'/ajax/delete-coupon-attribute',[App\Http\Controllers\Admin\CouponController::class,'DyanamicDelete']);
       
        //admin users
       Route::match(['POST','GET'],'/manage-users',[App\Http\Controllers\Admin\UserController::class,'viewUsers'])->name('user.view');
       
       Route::match(['POST','GET'],'/add-user',[App\Http\Controllers\Admin\UserController::class,'addUser'])->name('add.user');
       Route::match(['POST','GET'],'/update-user/{encUserId?}',[App\Http\Controllers\Admin\UserController::class,'updateUser'])->name('update.user');
       
       Route::match(['get','post'],'/ajax/delete-user',[App\Http\Controllers\Admin\UserController::class,'DyanamicDelete']);
       Route::match(['get','post'],'/ajax/update-status-user',[App\Http\Controllers\Admin\UserController::class,'ChangeStatus']);
       
       
       //payment method
       Route::match(['POST','GET'],'/manage-payment-methods',[App\Http\Controllers\Admin\PaymentMethodController::class,'allMethods'])->name('payment.methods');
       Route::match(['get','post'],'/ajax/update-status-method',[App\Http\Controllers\Admin\PaymentMethodController::class,'ChangeStatus']);
       Route::match(['POST','GET'],'/add-bank-account',[App\Http\Controllers\Admin\PaymentMethodController::class,'addupdateBankAccount'])->name('add.update.bank.account');
       Route::match(['POST','GET'],'/esewa-details',[App\Http\Controllers\Admin\PaymentMethodController::class,'updateEsewaCredential'])->name('update.esewa');
       
       //manage chipset
       Route::match(['POST','GET'],'/manage-chipset',[App\Http\Controllers\Admin\PCbuilderController::class,'allchipset'])->name('chipset');
       Route::match(['POST','GET'],'/update-chipset/{encChipsetId?}',[App\Http\Controllers\Admin\PCbuilderController::class,'updateChipset'])->name('update.chipset');
       Route::match(['POST','GET'],'/add-update-chipset-subcat/{encChipsetSubcatId?}',[App\Http\Controllers\Admin\PCbuilderController::class,'addupdateChipsetSubcat'])->name('add.update.chipset.subcat');
       Route::match(['POST','GET'],'/manage-chipset-subcat',[App\Http\Controllers\Admin\PCbuilderController::class,'allchipsetSubcat'])->name('chipset.subcat');
      
      //manage orders
      Route::match(['POST','GET'],'/manage-orders',[App\Http\Controllers\Admin\OrdersController::class,'allorders'])->name('orders');
       Route::match(['POST','GET'],'/edit-order/{encOrderId?}',[App\Http\Controllers\Admin\OrdersController::class,'viewUpdateOrder'])->name('update.order');
       Route::match(['POST','GET'],'/ajax/delete-order',[App\Http\Controllers\Admin\OrdersController::class,'DyanamicDelete']);
       
       
      //manage seo tags
      //Route::match(['POST','GET'],'/manage-seo-tags',[App\Http\Controllers\Admin\SeoTagsController::class,'allseotags'])->name('seo.tags');
      Route::match(['get','post'],'manage-seo-tags',[App\Http\Controllers\Admin\SeoTagsController::class,'updateSeoTags'])->name('site.seo.tags');

       //manage contact requests
      Route::match(['POST','GET'],'/manage-contact-requests',[App\Http\Controllers\Admin\ContactRequestController::class,'allrequests'])->name('contact.requests');
      Route::match(['POST','GET'],'/view-contact-request/{encRequestId?}',[App\Http\Controllers\Admin\ContactRequestController::class,'viewRequest'])->name('view.contact.request');
      Route::match(['POST','GET'],'/ajax/delete_request',[App\Http\Controllers\Admin\ContactRequestController::class,'DyanamicDelete']);
       
       
       
       
      //import export routes
      Route::get('/file-import',[App\Http\Controllers\Admin\ProductController::class,
            'importView'])->name('import-view');
    Route::post('/import',[App\Http\Controllers\Admin\ProductController::class,
            'import'])->name('import');
    Route::get('/export-products',[App\Http\Controllers\Admin\ProductController::class,
            'exportProducts'])->name('export-products');
    });