<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\File;
use App\Models\Mf;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        // //danh sách xe
        // $cars = Car::all();
        // return view('index', compact('cars'));
        


    }
    //Tìm kiếm
    public function postSearch(Request $req){
        $search_value=$req->txtSearch;
        //lấy về tất cả mf_id từ mfs có chứa các từ trong $search_value rồi chuyển từ collection sang mảng
        $mfs_array=Mf::select('id')->where('mf_name','like','%'.$search_value.'%')->get()->toArray();
        //dd($mfs_array);

        $cars_search=Car::where('model','like','%'.$search_value.'%')->orWhere('description','like','%'.$search_value.'%')->orWhereIn('mf_id',$mfs_array)->get();
       // dd($cars_search);
        return view('index',compact('cars_search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    //Thêm mới 1 xe
    public function create()
    {
        //Thêm
        $mfs=Mf::all();
        return view('create',compact('mfs'));
        
        // return view('create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //để lưu
        $validation = Validator::make($request->all(),
        [
            "description"  => "required",
            "model" => "required",
            "produced_on"  => "required|date",
            "mf_id" =>"required",
            'image_file'=>'mimes:jpeg,jpg,png,gif|max:10000'
        ]);
        //nếu không thành công, trả về trang tạo xe với lỗi và dữ liệu đầu vào cũ
        if ($validation->fails()){
            return redirect('cars/create')->withErrors($validation)->withInput();
        }
        //Xử lí tệp tin hình ảnh
        if($request->hasfile('image_file'))
        {
            $file = $request->file('image_file');
            $name=time().'_'.$file->getClientOriginalName();
            $destinationPath=public_path('images'); //project\public\images, //public_path(): trả về đường dẫn tới thư mục public
            $file->move($destinationPath, $name); //lưu hình ảnh vào thư mục public/images/
        }
        //Tạo đối tượng xe mới và lưu vào database
        $car=new Car();
        $car->description=$request->input('description');
        $car->model=$request->input('model');
        $car->produced_on=$request->input('produced_on');
        $car->mf_id=$request->input('mf_id');
        $car->image=$name;
        $car->save();
        //chuyển về trang danh sách với thông báo thành công
        return redirect('cars')->with('message','Thêm xe thành công');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //show 1 xe
        $car = Car::find($id);
        return view('show', compact('car')); //2.
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $car = Car::find($id); 
        $mfs = Mf::all(); // Lấy tất cả các hãng xe
        return view('edit', compact('car', 'mfs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            "description" => "required",
            "model" => "required",
            "produced_on" => "required|date",
            "mf_id" => "required",
            'image_file' => 'mimes:jpeg,jpg,png,gif|max:10000'
        ]);

        if ($validation->fails()) {
            return redirect()->route('cars.edit',$id)->withErrors($validation)->withInput();
        }

        $car = Car::find($id);

        if (!$car) {
            return redirect()->route('cars.edit',$id)->with('error', 'Xe không tồn tại');
        }

        $car->description = $request->input('description');
        $car->model = $request->input('model');
        $car->produced_on = $request->input('produced_on');
        $car->mf_id = $request->input('mf_id');

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $name = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('images');
            $file->move($destinationPath, $name);
            $car->image = $name;
        }

        $car->save();

        return redirect()->route('cars.index')->with('message', 'Thông tin xe đã được cập nhật');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //Xóa 
        $car = Car::find($id);
        $linkImage = public_path('images/').$car->image;
        if(File::exists($linkImage)){
            File::delete($linkImage);
        }
        $car->delete();     
        return redirect()->back()->with('message','Bạn đã xóa thành công');
    }
}
