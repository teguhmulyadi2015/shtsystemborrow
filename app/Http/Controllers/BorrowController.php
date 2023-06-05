<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Borrow, Asset, Employee};
use Illuminate\Support\Facades\DB;

class BorrowController extends Controller
{
    protected $trno;
    public function __construct()
    {
        //trno generate
        $today = date('Y-m-d');
        $getMaxCount = Borrow::where(DB::raw('DATE(date_borrow)'), '=', $today)->count('*');
        $getMaxCount = $getMaxCount + 1;
        // dd($getMaxCount);

        $getDate = date('mdy');
        $this->trno = "JSBI" . $getDate . $getMaxCount; //SBI-date-maxNumberByToday+1
    }
    //
    public function index()
    {
        return view('borrow.index');
    }

    public function createFd()
    {
        $assets = DB::table('assets')
            ->join('categories', 'assets.category_id', '=', 'categories.id')
            ->select('assets.asset_code', 'assets.asset_name')
            ->where('assets.status', '=', 1)
            ->where(DB::raw("SUBSTRING(assets.asset_code, 1, 1)"), '=', 'F') //DB::raw("SUBSTRING(column, $position, 1)") position adalah start awal yg mau di ambil karakternya
            ->get();
        // dd($assets);
        return view('borrow.v_create_fd', compact('assets'));
    }

    public function storeFd(Request $request)
    {
        $option = Asset::join('categories', 'assets.category_id', '=', 'categories.id')
            ->where('assets.status', '=', 1)
            ->where(DB::raw("SUBSTRING(assets.asset_code, 1, 1)"), '=', 'F') //DB::raw("SUBSTRING(column, $position, 1)") position adalah start awal yg mau di ambil karakternya
            ->pluck('assets.asset_code')->toArray();
        // dd($option);
        // validasi form
        $request->validate([
            'nik' => 'required',
            'asset' => 'required|in:' . implode(',', $option),
            // 'return_date_plan' => 'required'
        ]);


        // cek nik di db
        $cekNIK = Employee::where('employee_id', '=', $request->input('nik'))->first();
        // dd($cekNIK);

        if (!$cekNIK) {
            return redirect()->to(route('borrow.fd'))->withInput()->with('fail', 'ID ' . $request->input('nik') . ' Not registered!!');
        }


        // dd($this->trno);
        $data = [
            'trno' => $this->trno,
            'employee_id_borrow' => $request->input('nik'),
            'asset_id' => $request->input('asset'),
            'date_borrow' => now(),
            // 'date_return_plan' => date('Y-m-d')
            'date_return_plan' => $request->input('return_date_plan')
        ];

        //insert into table borrows
        $borrow = Borrow::create($data);

        // udpate status 1 (tidak pinjam) menjadi 0 (dipinjam)
        $asset = Asset::where('asset_code', '=', $request->input('asset'))
            ->where('status', '=', 1)
            ->update(['status' => 0]);

        if (($borrow and $asset) == true) {
            return redirect()->to(route('home.index'))->with('success', 'Done with succes! ');
        } else {
            return redirect()->to(route('borrow.fd'))->with('fail', 'Error , please check! ');
        }
    }

    public function returnAsset($id)
    {
        // $borrow = DB::table('borrows')
        //     ->join('assets', 'assets.asset_code', '=', 'borrows.asset_id')
        //     ->select('borrows.*', 'assets.asset_name')
        //     ->where('borrows.id', '=', $id)
        //     ->first();

        // show form return
        $borrow = Borrow::join('assets', 'assets.asset_code', '=', 'borrows.asset_id')
            ->where('borrows.id', '=', $id)->first(['borrows.*', 'assets.asset_name']);
        // dd($borrow);
        if ($borrow) {
            return view('borrow.v_returned', compact('borrow'));
        } else {
            abort(404);
        }
    }

    public function returnAssetUpdate(Request $request)
    {

        // validasi form
        $request->validate([
            'nik' => ['required', 'min:5']
        ]);
        // cek nik di db
        $cekNIK = Employee::where('employee_id', '=', $request->input('nik'))->first();
        // dd($cekNIK);

        if (!$cekNIK) {
            return redirect()->back()->withInput()->with('fail', 'ID ' . $request->input('nik') . ' Not registered!!');
        }


        $borrow = Borrow::where(['id' => $request->input('id')])->update(['employee_id_return' => $request->input('nik'), 'date_return' => $request->input('date_returned')]);

        $asset = Asset::where(['asset_code' => $request->input('asset_id'), 'status' => '0'])->update(['status' => '1']);

        if ($borrow && $asset) {
            return redirect()->to(route('home.index'))->with('success', 'Asset Already return! thank you');
        } else {
            return redirect()->to(route('home.index'))->with('fail', 'ERRORR BORROW!!!! ');
            DB::rollback();
        }
    }

    public function createLaptop()
    {
        $assets = DB::table('assets')
            ->join('categories', 'assets.category_id', '=', 'categories.id')
            ->select('assets.asset_code', 'assets.asset_name')
            ->where('assets.status', '=', '1')
            ->where(DB::raw("SUBSTRING(assets.asset_code, 1, 3)"), '=', '701') //DB::raw("SUBSTRING(column, $position, 1)") position adalah start awal yg mau di ambil karakternya
            ->get();
        // dd($assets);
        return view('borrow.v_create_laptop', compact('assets'));
    }

    public function storeLaptop(Request $request)
    {
        // validasi form
        $request->validate([
            'nik' => 'required',
            'asset' => 'required',
            // 'return_date_plan' => 'required'
        ]);


        // cek nik di db
        $cekNIK = Employee::where('employee_id', '=', $request->input('nik'))->first();
        // dd($cekNIK);

        if (!$cekNIK) {
            return redirect()->to(route('borrow.laptop'))->withInput()->with('fail', 'ID ' . $request->input('nik') . ' Not registered!!');
        }


        // menampung data inputan kedalam array data
        // dd($request->input('return_date_plan'));
        $data = [
            'trno' => $this->trno,
            'employee_id_borrow' => $request->input('nik'),
            'asset_id' => $request->input('asset'),
            'date_borrow' => now(),
            // 'date_return_plan' => date('Y-m-d')
            'date_return_plan' => $request->input('return_date_plan')
        ];

        //insert into table borrows
        $borrow = Borrow::create($data);

        // udpate status 1 (tidak pinjam) menjadi 0 (dipinjam)
        $asset = Asset::where('asset_code', '=', $request->input('asset'))
            ->where('status', '=', 1)
            ->update(['status' => 0]);

        if (($borrow and $asset) == true) {
            return redirect()->to(route('home.index'))->with('success', 'Done with succes!');
        } else {
            return redirect()->to(route('borrow.laptop'))->with('fail', 'Error , please check!');
        }
    }

    public function createPointer()
    {
        // looking for asset pointer which status is 1 or status is not borrow
        $assets = Asset::join('categories', 'assets.category_id', '=', 'categories.id')
            ->where('assets.status', '=', 1)
            ->where('categories.id', '=', '3')
            ->where(DB::raw("SUBSTRING(assets.asset_code, 1, 3)"), '=', '725') //P adalah asset code untuk pointer
            ->get(['assets.*']);
        return view('borrow.v_create_pointer', compact('assets'));
    }



    public function storePointer(Request $request)
    {
        // validasi form
        $request->validate([
            'nik' => 'required',
            'asset' => 'required',
            // 'return_date_plan' => 'required'
        ]);


        // cek nik di db
        $cekNIK = Employee::where('employee_id', '=', $request->input('nik'))->first();
        // dd($cekNIK);

        if (!$cekNIK) {
            return redirect()->to(route('borrow.pointer'))->withInput()->with('fail', 'ID ' . $request->input('nik') . ' Not registered!!');
        }


        // menampung data inputan kedalam array data
        // dd($request->input('return_date_plan'));
        $data = [
            'trno' => $this->trno,
            'employee_id_borrow' => $request->input('nik'),
            'asset_id' => $request->input('asset'),
            'date_borrow' => now(),
            // 'date_return_plan' => date('Y-m-d')
            'date_return_plan' => $request->input('return_date_plan')
        ];

        //insert into table borrows
        $borrow = Borrow::create($data);

        // udpate status 1 (tidak pinjam) menjadi 0 (dipinjam)
        $asset = Asset::where('asset_code', '=', $request->input('asset'))
            ->where('status', '=', 1)
            ->update(['status' => 0]);

        if (($borrow and $asset) == true) {
            return redirect()->to(route('home.index'))->with('success', 'Done with succes!');
        } else {
            return redirect()->to(route('borrow.pointer'))->with('fail', 'Error , please check!');
        }
    }



    public function createJabra()
    {
        // looking for asset pointer which status is 1 or status is not borrow
        $assets = Asset::join('categories', 'assets.category_id', '=', 'categories.id')
            ->where('assets.status', '=', 1)
            ->where('categories.id', '=', '4')
            ->where(DB::raw("SUBSTRING(assets.asset_code, 1, 3)"), '=', '725') //P adalah asset code untuk pointer dan jabra
            ->get(['assets.*']);
        return view('borrow.v_create_jabra', compact('assets'));
    }


    public function storeJabra(Request $request)
    {
        // validasi form
        $request->validate([
            'nik' => 'required',
            'asset' => 'required',
            // 'return_date_plan' => 'required'
        ]);


        // cek nik di db
        $cekNIK = Employee::where('employee_id', '=', $request->input('nik'))->first();
        // dd($cekNIK);

        if (!$cekNIK) {
            return redirect()->to(route('borrow.jabra'))->withInput()->with('fail', 'ID ' . $request->input('nik') . ' Not registered!!');
        }


        // menampung data inputan kedalam array data
        // dd($request->input('return_date_plan'));
        $data = [
            'trno' => $this->trno,
            'employee_id_borrow' => $request->input('nik'),
            'asset_id' => $request->input('asset'),
            'date_borrow' => now(),
            // 'date_return_plan' => date('Y-m-d')
            'date_return_plan' => $request->input('return_date_plan')
        ];

        //insert into table borrows
        $borrow = Borrow::create($data);

        // udpate status 1 (tidak pinjam) menjadi 0 (dipinjam)
        $asset = Asset::where('asset_code', '=', $request->input('asset'))
            ->where('status', '=', 1)
            ->update(['status' => 0]);

        if (($borrow and $asset) == true) {
            return redirect()->to(route('home.index'))->with('success', 'Done with succes!');
        } else {
            return redirect()->to(route('borrow.jabra'))->with('fail', 'Error , please check!');
        }
    }



    public function createHeadphone()
    {
        // looking for asset pointer which status is 1 or status is not borrow
        $assets = Asset::join('categories', 'assets.category_id', '=', 'categories.id')
            ->where('assets.status', '=', 1)
            ->where('categories.id', '=', '5')
            ->where(DB::raw("SUBSTRING(assets.asset_code, 1, 1)"), '=', 'H') //H adalah asset code untuk Headphone
            ->get(['assets.*']);
        return view('borrow.v_create_headphone', compact('assets'));
    }

    public function storeHeadphone(Request $request)
    {
        // validasi form
        $request->validate([
            'nik' => 'required',
            'asset' => 'required',
            // 'return_date_plan' => 'required'
        ]);


        // cek nik di db
        $cekNIK = Employee::where('employee_id', '=', $request->input('nik'))->first();
        // dd($cekNIK);

        if (!$cekNIK) {
            return redirect()->to(route('borrow.headphone'))->withInput()->with('fail', 'ID ' . $request->input('nik') . ' Not registered!!');
        }


        // menampung data inputan kedalam array data
        // dd($request->input('return_date_plan'));
        $data = [
            'trno' => $this->trno,
            'employee_id_borrow' => $request->input('nik'),
            'asset_id' => $request->input('asset'),
            'date_borrow' => now(),
            // 'date_return_plan' => date('Y-m-d')
            'date_return_plan' => $request->input('return_date_plan')
        ];

        //insert into table borrows
        $borrow = Borrow::create($data);

        // udpate status 1 (tidak pinjam) menjadi 0 (dipinjam)
        $asset = Asset::where('asset_code', '=', $request->input('asset'))
            ->where('status', '=', 1)
            ->update(['status' => 0]);

        if (($borrow and $asset) == true) {
            return redirect()->to(route('home.index'))->with('success', 'Done with succes!');
        } else {
            return redirect()->to(route('borrow.headphone'))->with('fail', 'Error , please check!');
        }
    }

    public function createSaramonic()
    {
        // looking for asset pointer which status is 1 or status is not borrow
        $assets = Asset::join('categories', 'assets.category_id', '=', 'categories.id')
            ->where('assets.status', '=', 1)
            ->where('categories.id', '=', '6')
            ->where(DB::raw("SUBSTRING(assets.asset_code, 1, 1)"), '=', 'S') //H adalah asset code untuk Headphone
            ->get(['assets.*']);
        return view('borrow.v_create_saramonic', compact('assets'));
    }
    public function storeSaramonic(Request $request)
    {
        // validasi form
        $request->validate([
            'nik' => 'required',
            'asset' => 'required',
            // 'return_date_plan' => 'required'
        ]);


        // cek nik di db
        $cekNIK = Employee::where('employee_id', '=', $request->input('nik'))->first();
        // dd($cekNIK);

        if (!$cekNIK) {
            return redirect()->to(route('borrow.saramonic'))->withInput()->with('fail', 'ID ' . $request->input('nik') . ' Not registered!!');
        }


        // menampung data inputan kedalam array data
        // dd($request->input('return_date_plan'));
        $data = [
            'trno' => $this->trno,
            'employee_id_borrow' => $request->input('nik'),
            'asset_id' => $request->input('asset'),
            'date_borrow' => now(),
            // 'date_return_plan' => date('Y-m-d')
            'date_return_plan' => $request->input('return_date_plan')
        ];

        //insert into table borrows
        $borrow = Borrow::create($data);

        // udpate status 1 (tidak pinjam) menjadi 0 (dipinjam)
        $asset = Asset::where('asset_code', '=', $request->input('asset'))
            ->where('status', '=', 1)
            ->update(['status' => 0]);

        if (($borrow and $asset) == true) {
            return redirect()->to(route('home.index'))->with('success', 'Done with succes!');
        } else {
            return redirect()->to(route('borrow.saramonic'))->with('fail', 'Error , please check!');
        }
    }
}
