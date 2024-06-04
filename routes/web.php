<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\PtController;
use App\Http\Controllers\CarController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hello1', function () {
    return "<h1 style= 'color:red; text-align: center'>Hello Hà<h1>";
});

Route::get('/hello2', function () {
    return view('hello');
});



//bai giai phương trình
// Route::get('/giaiptb1', function () {
//     return view('giaiptb1');
// });
Route::get('/giaiptb1',[PtController::class,'getGiaiptb1'])->name('getgiaiptb1');

// Route::post('/giaiptb1', function (Request $req) {
//     $a = $req->hsa;
//     $b = $req->hsb;
//     if($a == 0)
//         if($b == 0)
//             $ketqua="Phương trình vô số nghiệm";
//         else $ketqua ="Phương trình vô nghiệm";
//     else $ketqua = "Phương trình có nghiệm x=".-$b/$a;    

//     return view('giaiptb1', compact('ketqua','a','b'));
// })->name('postgiaiptb1');

Route::post('/giaiptb1',[PtController::class, 'giaiptb1'])->name('postgiaiptb1');


// Car project

Route::resource('cars',CarController::class);
Route::post('cars/search',[CarController::class,'postSearch'])->name('postSearch');
/* tương đương 7 route
Route::get('cars',[CarController::class,'index'])->name('cars.index');
Route::post('cars',[CarController::class,'store'])->name('cars.store');
Route::get('cars/create',[CarController::class,'create'])->name('cars.create');
Route::get('cars/{car}',[CarController::class,'show'])->name('cars.show');
Route::put('cars/{car}',[CarController::class,'update'])->name('cars.update');p
Route::delete('cars/{car}',[CarController::class,'destroy'])->name('cars.destroy');
Route::get('cars/{car}/edit',[CarController::class,'edit'])->name('cars.edit');
*/

//Route  project bán hàng-------------------------------------------------------------
//Route:
Route::get('index',[PageController::class,'index'])->name('banhang.index');

//để liên kết với nút hình Giỏ hàng để thêm sản phẩm vào giỏ hàng
Route::get('/add-to-cart/{id}',[PageController::class,'addToCart'])->name('banhang.addtocart');



// Định nghĩa route để xử lý việc đặt hàng
// Route::get('/dathang', [PageController::class, 'getDatHang'])->name('banhang.getdathang');

// Định nghĩa route để xử lý việc xóa hàng
Route::get('/del-cart/{id}',[PageController::class,'delCartItem'])->name('banhang.xoagiohang');

Route::get('checkout',[PageController::class,'getCheckout'])->name('banhang.getdathang');
Route::post('checkout',[PageController::class,'postCheckout'])->name('banhang.postdathang');//sau khi đã định nghĩa route mà trong file view header báo lỗi chưa định nghĩa thì chạy câu lệnh php artisan route:clear


//đăng ký khách hàng
Route::get('/dangky',[PageController::class,'getSignin'])->name('getsignin');
Route::post('/dangky',[PageController::class,'postSignin'])->name('postsignin');

//Viết route đăng nhập khách hàng
Route::get('/dangnhap',[PageController::class,'getLogin'])->name('getlogin');
Route::post('/dangnhap',[PageController::class,'postLogin'])->name('postlogin');

//đăng xuất
Route::get('/dangxuat',[PageController::class,'getLogout'])->name('getlogout');

//đăng nhập/đăng xuất quản trị ADMIN
Route::get('/admin/dangnhap',[UserController::class,'getLogin'])->name('admin.getLogin');
Route::post('/admin/dangnhap',[UserController::class,'postLogin'])->name('admin.postLogin');
Route::get('/admin/dangxuat',[UserController::class,'getLogout']);

//Viết route rồi gán hành động submit tại thuộc tính action của thẻ form ở mục trên:
Route::post('/input-email',[PageController::class,'postInputEmail'])->name('postInputEmail');

//Viết route get ra trang giao diện input-email khi người dùng nhấn quên mật khẩu
Route::get('/input-email',[PageController::class,'getInputEmail'])->name('getInputEmail');

//Trang admin
Route::prefix('admin')->group(function () {
    Route::middleware([EnsureTokenIsValid::class])->group(function () {
        Route::group(['prefix'=>'category'],function(){
             // admin/category/danhsach
             Route::get('danhsach',[CategoryController::class,'getCateList'])->name('admin.getCateList');
             Route::get('them',[CategoryController::class,'getCateAdd'])->name('admin.getCateAdd');
             Route::post('them',[CategoryController::class,'postCateAdd'])->name('admin.postCateAdd');
             Route::get('xoa/{id}',[CategoryController::class,'getCateDelete'])->name('admin.getCateDelete');
             Route::get('sua/{id}',[CategoryController::class,'getCateEdit'])->name('admin.getCateEdit');
             Route::post('sua/{id}',[CategoryController::class,'postCateEdit'])->name('admin.postCateEdit');
         });
   //viết tiếp các route khác cho crud products, users,.... thì viết tiếp
   });
 });



// //random so
// Route::get('/randomso', function () {
//     return view('randomso');
// });

// Route::post('/random-number', function (Request $req) {
//     $min = $req->min; // Minimum value
//     $max = $req->max; // Maximum value

//     // Generate a random number within the specified range
//     $randomNumber = random_int($min, $max);

//     // Return the random number as a JSON response
//     return response()->json(['random_number' => $randomNumber]);
// })->name('generateRandomNumber');


