<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\RandomDetail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $random_session = session('randomCus');
        // return  dd($random_session);
        $customers = Customer::all();
        return view('home', compact('customers', 'random_session'));
    }



    public function store(Request $request)
    {
        if ($request->id != "") {
            $customer = Customer::find($request->id);
            $request->validate(
                [
                    "username" => $customer->username != $request->username ? "required|min:6|max:12|unique:customers|unique:users" : "required|min:6|max:12|unique:users",
                    "name" => "required|min:6|max:255",
                    "tel" => $customer->tel != $request->tel ? "min:10|max:10|unique:customers" : "min:10|max:10",
                ],
                [
                    //username
                    "username.required" => "กรุณากรอกช่องนี้",
                    "username.min" => "ต้องมีอย่างน้อย6ตัวอักษร",
                    "username.max" => "ต้องมีไม่เกิน12ตัวอักษร",
                    "username.unique" => "ชื่อผู้ใช้นี้ถูกใช้แล้ว",
                    //name
                    "name.required" => "กรุณากรอกช่องนี้",
                    "name.min" => "ต้องมีอย่างน้อย6ตัวอักษร",
                    "name.max" => "ต้องมีไม่เกิน255ตัวอักษร",
                    //tel
                    "tel.min" => "กรุณากรอกเบอร์โทร10หลัก",
                    "tel.max" => "กรุณากรอกเบอร์โทร10หลัก",
                    "tel.unique" => "เบอร์โทรนี้ถูกใช้แล้ว",
                ],
            );
        } else {
            $request->validate(
                [
                    "username" => "required|min:6|max:12|unique:customers|unique:users",
                    "name" => "required|min:6|max:255",
                    "tel" => "min:10|max:10|unique:customers"
                ],
                [
                    //username
                    "username.required" => "กรุณากรอกช่องนี้",
                    "username.min" => "ต้องมีอย่างน้อย6ตัวอักษร",
                    "username.max" => "ต้องมีไม่เกิน12ตัวอักษร",
                    "username.unique" => "ชื่อผู้ใช้นี้ถูกใช้แล้ว",
                    //name
                    "name.required" => "กรุณากรอกช่องนี้",
                    "name.min" => "ต้องมีอย่างน้อย6ตัวอักษร",
                    "name.max" => "ต้องมีไม่เกิน255ตัวอักษร",
                    //tel
                    "tel.min" => "กรุณากรอกเบอร์โทร10หลัก",
                    "tel.max" => "กรุณากรอกเบอร์โทร10หลัก",
                    "tel.unique" => "เบอร์โทรนี้ถูกใช้แล้ว",
                ],
            );
        }
        $user = Customer::updateOrCreate(['id' => $request->id], [
            "username" => $request->username,
            "name" => $request->name,
            "tel" => $request->tel,
        ]);

        // if ($user && $request->id != "") {
        //     $random_session = session('randomCus');
        //     for ($i = 0; $i < count($random_session); $i++) {
        //         if ($random_session[$i]['cus_id'] == (string)$request->id) {
        //             $random_session[$i]['name'] = $request->name;
        //             $random_session[$i]['username'] = $request->username;
        //             $random_session[$i]['tel'] = $request->tel;
        //             // dd($random_session);
        //             break;
        //         }
        //     }
        //     session(["randomDetail" => $random_session]);
        // }
        return response()->json(['code' => '200', 'message' => 'บันทึกข้อมูลสำเร็จ', 'data' => $user], 200);
    }

    public function getData($id)
    {
        $customer = Customer::find($id);
        return response()->json($customer);
    }

    public function deletePost($id)
    {
        $random_detail = RandomDetail::where('cus_id', $id)->count();
        if ($random_detail) {
            return response()->json(['error' => "ไม่สามารถลบข้อมูลได้เนื่องจากข้อมูลผู้ใช้คนนี้ถูก Random แล้ว", "code" => "424"]);
        }
        $customer = Customer::find($id)->delete();
        return response()->json(['sucess' => "ลบข้อมูลเรียบร้อย", "code" => "200"]);
    }

    public function random(Request $request)
    {
        if ($request->number <= 0) {
            return response()->json(["code" => "424", "message" => "ตัวเลขต้องห้ามน้อยกว่า0"]);
        }
        $row = Customer::all();
        if ($request->number > count($row)) {
            return response()->json(["code" => "424", "message" => "ตัวเลขมากเกินกว่าลูกค้า"]);
        }
        $customers = Customer::all();
        return response()->json(["data" => $customers]);
    }

    public function saveRandom(Request $request)
    {
        $customers = Customer::inRandomOrder()->limit($request->number)->get();
        foreach ($customers as $customer) {
            RandomDetail::insert([
                "cus_id"=> $customer->id,
                "cus_name"=> $customer->name,
                "cus_username"=> $customer->username,
                "tel"=> $customer->tel,
                "created_at"=> Carbon::now(),
            ]);
        }
        session(["randomCus" => $customers]);
        return response()->json(["data" => $customers]);
    }

    public function deleteAll(Request $request)
    {
        // return dd($request->pass);
        $data = $request->pass;
        for ($i = 0; $i < count($data); $i++) {
            Customer::find($data[$i]['id'])->delete();
        }
        return response()->json(["code" => "200", "message" => "ลบข้อมูลสำเร็จ", "data" => $data]);
    }

    public function viewHistory(){
        $random_details = RandomDetail::orderByDesc('created_at')->paginate(10);
        return view('history',compact('random_details'));
    }
}
