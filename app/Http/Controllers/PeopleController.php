<?php

namespace App\Http\Controllers;

use App\Models\People;
use App\Models\Province;
use Illuminate\Http\Request;
// Import 2 request vào !
use App\Http\Requests\People\AddPeopleRequest;
use App\Http\Requests\People\UpdatePeopleRequest;

class PeopleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $people = People::search()->paginate(4)->withQueryString();
        return view('people.index', compact('people'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // truy vấn để lấy ra tất cả các province, truyền vào view create để thực hiện lặp
        $provinces = Province::all();
        return view('people.create', compact('provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddPeopleRequest $request)
    {
        // lấy ra tên file: $request-><tên_input_file>->getClientOriginalName()
        $file_name = time() . $request->avatar->getClientOriginalName();
        // thực hiện upload ảnh vào trong thư mục uploads
        // cú pháp: $request-><tên_input_file>->move(public_path(<tên_thư_mục_ảnh>), $biến_tên_ảnh)
        $request->avatar->move(public_path('uploads'), $file_name);

        // vì là có nhiều trường nên phải định nghĩa từng trường và dữ liệu thêm mới vào
        People::create([
            'name' => $request->name,
            'province_id' => $request->province_id,
            'avatar' => $file_name,
            'birthday' => $request->birthday,
            'gender' => $request->gender,
            'about' => $request->about
        ]);
        return redirect()->route('people.index')->with('message', 'Insert Data Succesfully');
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
        // truy vấn để lấy ra tất cả các province, truyền vào view edit để thực hiện lặp
        $provinces = Province::all();
        // truy vấn để lấy ra 1 people theo id, truyền vào view edit
        $people = People::find($id);
        return view('people.update', compact('provinces', 'people'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePeopleRequest $request, $id)
    {
        $people = People::find($id);
        $file_name=$people->avatar;
        try {
            if ($request->has('avatar')) {
                // lấy ra tên file: $request-><tên_input_file>->getClientOriginalName()
                $file_name = time() . $request->avatar->getClientOriginalName();

                // thực hiện upload ảnh vào trong thư mục uploads
                $request->image->move(public_path('uploads'), $file_name);
            }
            // tìm kiếm theo bản ghi: find($id) và sửa: update()
            People::find($id)->update([
                'name' => $request->name,
                'province_id' => $request->province_id,
                'avatar' => $file_name,
                'birthday' => $request->birthday,
                'gender' => $request->gender,
                'about' => $request->about
            ]);
            return redirect()->route('people.index')->with('message', 'Update Data Succesfully');
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
            // truy vấn để lấy ra 1 people theo id cần xóa
            $people = People::find($id);
            // xóa bản ghi
            $people->delete();
            // trả về route index của people và kèm theo thông báo
            return redirect()->route('people.index')->with('message', 'Delete Data Succesfully');
        } catch (\Throwable $th) {
            dd($th);
        }
    }
}
