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
use App\Model\Backend\Product;

Route::get('/', function () {
    $products = Product::all();
    return view('welcome',compact('products'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



// **************************Backend***********************

// ******Admin******
    Route::prefix('admin')->group(function(){
    Route::group(['namespace' => 'Admin\Auth'], function () {
    Route::get('/login', 'LoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'LoginController@login')->name('admin.login');
    Route::get('/register', 'RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('/register', 'RegisterController@register')->name('admin.register');
    Route::get('/forget-password', 'ForgotPasswordController@forgetPage')->name('admin.forget-password');
    Route::post('/forget-password-email', 'ForgotPasswordController@SendLinksToEmail')->name('admin.forget-password.email');
    Route::get('/password-reset', 'ResetPasswordController@showResetForm')->name('admin.password.request');
    });
    Route::get('/dashboard', 'Backend\AdminController@index')->name('admin.dashboard');
    });

// *****Catagory Start*******

    Route::group(['namespace' => 'Backend','prefix'=>'admin/catagory'], function () {
    Route::get('/','CatagoryController@index')->name('catagory.index');
    Route::post('/post','CatagoryController@post')->name('catagory.post');
    Route::get('/edit/{id}','CatagoryController@edit')->name('catagory.edit');
    Route::post('/update/{id}','CatagoryController@update')->name('catagory.update');
    Route::get('/delete/{id}','CatagoryController@destroy')->name('catagory.delete');
    });
// *****Catagory Ends*******

// *****subcatagory Start*******
    Route::group(['namespace' => 'Backend','prefix'=>'admin/subcatagory'], function () {
    Route::get('/','SubcatagoryController@index')->name('subcatagory.index');
    Route::post('/store','SubcatagoryController@store')->name('subcatagory.store');
    Route::post('/update/{id}','SubcatagoryController@update')->name('subcatagory.update');
    Route::get('/delete/{id}','SubcatagoryController@destroy')->name('subcatagory.delete');
    });
// *****subcatagory Ends*******

// *****products Start*******
    Route::group(['namespace' => 'Backend','prefix'=>'admin/product'], function () {
    Route::get('/','ProductController@index')->name('product.index');
    Route::get('/create','ProductController@create')->name('product.create');
    Route::get('/azax/{id}','ProductController@subcatagoryAzax')->name('sub.azax.get');
    Route::post('/store','ProductController@store')->name('product.store');
    Route::get('/edit/{id}','ProductController@edit')->name('product.edit');
    Route::get('/active/{id}','ProductController@active')->name('product.active');
    Route::get('/deactive/{id}','ProductController@deactive')->name('product.deactive');
    Route::post('/update/{id}','ProductController@update')->name('product.update');
    Route::get('/delete/{id}','ProductController@destroy')->name('product.delete');
    });
// *****products Ends*******

// *****Color & Size Start*******
    Route::group(['namespace' => 'Backend','prefix'=>'admin/color'], function () {
    Route::get('/','colorsizeController@index')->name('color.index');
    Route::get('/create','colorsizeController@create')->name('color.create');
    Route::post('/store','colorsizeController@store')->name('color.store');
    Route::post('/update/{id}','colorsizeController@update')->name('color.update');
    Route::get('/delete/{id}','colorsizeController@destroy')->name('color.delete');
    });
// *****Color & Size Ends*******

// *****Brand area Start*******
    Route::group(['namespace' => 'Backend','prefix'=>'admin/brand'], function () {
    Route::get('/','BrandController@index')->name('brand.index');
    // Route::get('/create','BrandController@create')->name('brand.create');
    Route::post('/store','BrandController@store')->name('brand.store');
    Route::get('/edit/{id}','BrandController@edit')->name('brand.edit');
    Route::post('/update/{id}','BrandController@update')->name('brand.update');
    Route::get('/delete/{id}','BrandController@destroy')->name('brand.delete');
    });
// *****Brand area Ends*******

// *****Blog Start*******
    Route::group(['namespace' => 'Backend','prefix'=>'admin/blog'], function () {
    Route::get('/','BlogController@index')->name('blog.index');
    Route::get('/create','BlogController@create')->name('blog.create');
    Route::post('/store','BlogController@store')->name('blog.store');
    Route::get('/edit/{id}','BlogController@edit')->name('blog.edit');
    Route::post('/update/{id}','BlogController@update')->name('blog.update');
    Route::get('/delete/{id}','BlogController@destroy')->name('blog.delete');
    // commnets
    Route::post('/comment/{id}','BlogController@StoreComment')->name('comment.store');
    });
// *****Blog Ends*******

// *****Contacts Start*******
Route::group(['namespace' => 'Backend','prefix'=>'admin/contact'], function () {
    Route::get('/','ContactController@index')->name('contact.index');
    Route::get('/create','ContactController@create')->name('contact.create');
    Route::post('/store','ContactController@store')->name('contact.store');
    Route::post('/update/{id}','ContactController@update')->name('contact.update');
    Route::get('/delete/{id}','ContactController@destroy')->name('contact.delete');
    Route::post('/message','ContactController@PostMessage')->name('contact.message');
    });
// *****Contacts Ends*******

// *****About Start*******
Route::group(['namespace' => 'Backend','prefix'=>'admin/about'], function () {
    Route::get('/','AboutController@index')->name('about.index');
    Route::get('/create','AboutController@create')->name('about.create');
    Route::post('/store','AboutController@store')->name('about.store');
    Route::post('/update/{id}','AboutController@update')->name('about.update');
    Route::get('/delete/{id}','AboutController@destroy')->name('about.delete');

    });
// *****About Ends*******

// *****FAQ Start*******
Route::group(['namespace' => 'Backend','prefix'=>'admin/faq'], function () {
    Route::get('/','FaqController@index')->name('faq.index');
    Route::get('/create','FaqController@create')->name('faq.create');
    Route::post('/store','FaqController@store')->name('faq.store');
    Route::get('/edit/{id}','FaqController@edit')->name('faq.edit');
    Route::post('/update/{id}','FaqController@update')->name('faq.update');
    Route::get('/delete/{id}','FaqController@destroy')->name('faq.delete');
    Route::get('/active/{id}','FaqController@active')->name('faq.active');
    Route::get('/deactive/{id}','FaqController@deactive')->name('faq.deactive');
    });
// *****FAQ Ends*******

// *****Subscription Start*******
Route::group(['namespace' => 'Backend','prefix'=>'admin/subscription'], function () {
    Route::get('/','SubscriptionController@index')->name('subscription.index');
    Route::get('/create','SubscriptionController@create')->name('subscription.create');
    Route::post('/store','SubscriptionController@store')->name('subscription.store');
    Route::get('/delete/{id}','SubscriptionController@destroy')->name('subscription.delete');
    Route::get('/email/{id}','SubscriptionController@SendingEmail')->name('sub.email');
    Route::post('/email-sent/{id}','SubscriptionController@EmailSent')->name('subscription.email.sent');
    Route::get('/email-all-sent','SubscriptionController@EmailSentAllSubscriber')->name('subscription.email.sent.all');
    // users
    Route::get('/users','SubscriptionController@users')->name('users');
    // Admin
    Route::get('/admins','SubscriptionController@Admin')->name('all.admins');
    });
// *****Subscription Ends*******

// *****Subscription Start*******
Route::group(['namespace' => 'Backend','prefix'=>'admin/order'], function () {
    Route::get('/','OrderController@index')->name('order.index');
    Route::get('/create','OrderController@create')->name('order.create');
    Route::post('/store','OrderController@store')->name('order.store');
    Route::get('/delete/{id}','OrderController@destroy')->name('order.delete');

    });
// *****Subscription Ends*******



// ************************FRONTEND******************

// *****Cart Start*******
    Route::group(['namespace' => 'Frontend','prefix'=>'cart'], function () {
    Route::get('/','CartController@index')->name('cart.index');
    // Route::get('/create','CartController@create')->name('cart.create');
    Route::get('/store/{id}','CartController@store')->name('cart.store');
    // Route::get('/edit/{id}','CartController@edit')->name('cart.edit');
    Route::post('/update','CartController@update')->name('cart.update');
    Route::get('/delete/{id}','CartController@destroy')->name('cart.delete');

    });
// *****Cart Ends*******




// *****Checkout Start*******
    Route::group(['namespace' => 'Backend','prefix'=>'checkout'], function () {
    Route::get('/','CheckoutController@index')->name('checkout.index');
    // Route::get('/create','CheckoutController@create')->name('checkout.create');
    Route::post('/store','CheckoutController@store')->name('checkout.store');
    // Route::get('/edit','CheckoutController@edit')->name('checkout.edit');
    Route::post('/update','CheckoutController@update')->name('checkout.update');
    Route::get('/delete/{id}','CheckoutController@destroy')->name('checkout.delete');
    Route::get('/product/shipped/{id}','CheckoutController@shippedProduct')->name('product.shipped');

    });
// *****Checkout Ends*******



// *****Wishlist Start*******
Route::group(['namespace' => 'Frontend','prefix'=>'wishlist'], function () {
    Route::get('/','WishListController@index')->name('wishlist.index');
    Route::get('/abijabi','WishListController@abijabi')->name('wishlist.abijabi');

    Route::get('/store/{id}','WishListController@store')->name('wishlist.store');

    Route::get('/wish-to-cart/{id}','WishListController@WishToCart')->name('wishlistToCart.update');
    Route::get('/delete/{id}','WishListController@destroy')->name('wishlist.delete');
    });
// *****Wishlist Ends*******





