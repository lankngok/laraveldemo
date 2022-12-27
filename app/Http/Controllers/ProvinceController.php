<?php

namespace App\Http\Controllers;

use App\Models\Province;
// Import 2 request vào !
use App\Http\Requests\Province\AddProvinceRequest;
use App\Http\Requests\Province\UpdateProvinceRequest;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // lấy ra danh sách province, kết hợp tìm kiếm và phân trang, bên people cũng vậy
        $provinces = Province::search()->paginate(3)->withQueryString();

        // trả về view danh sách, truyền theo biến provinces sang view
        return view('province.index', compact('provinces'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // trả về view form thêm mới
        return view('province.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddProvinceRequest $request)
    {
        try {
            // lấy dữ liệu từ form thông qua $request->all()
            // Validate bằng form request, mở folder request lên xem
            // thực hiện thêm mới vào bảng provinces thông qua model Province, phthuc create
            Province::create($request->all());
            // trả về view khi thêm mới thành công, kèm theo message
            return redirect()->route('province.index')->with('message', 'Insert Data Successful');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // lấy ra bản ghi cần thực hiện sửa
        $province = Province::find($id);

        // trả về view sửa, truyền theo bản ghi cần sửa
        return view('province.update', compact('province'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProvinceRequest $request, $id)
    {
        try {
            // lấy dữ liệu từ form thông qua $request->all()
            // Validate bằng form request, mở folder request lên xem
            // thực hiện sửa data thông qua model Province, trỏ vào find để tìm bản ghi theo id, trỏ vào update để sửa
            Province::find($id)->update($request->all());

            // trả về route index của province và bắn thông báo khi sửa thành công
            return redirect()->route('province.index')->with('message', 'Update Data Successful');
        } catch (\Throwable $th) {
            dd($th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // thực hiện tìm kiếm bản ghi cần xóa theo ID
            $province = Province::find($id);

            // kiểm tra nếu có dữ liệu khóa ngoại thì k xóa
            if ($province->people->count() > 0) {
                return redirect()->route('province.index')->with('message', 'Delete Data Failed, This Data Has Record');
            } else {
                // kiểm tra nếu không có dữ liệu khóa ngoại thì xóa
                $province->delete();

                // trả về route index của province kèm theo message
                return redirect()->route('province.index')->with('message', 'Delete Data Successful');
            }
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
