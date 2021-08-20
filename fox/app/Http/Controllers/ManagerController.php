<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Package_track;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManagerController extends Controller
{
    public function viewDesktop()
    {
        $operName = Auth::user()->name;
        $operFullName = Auth::user()->user_name;
        $operPoint = Point::find(Auth::user()->point_id);

        return view('manager', ['operName' => $operName,
            'operFullName' => $operFullName,
            'operPoint' => $operPoint,
        ]);
    }

    public function packageSendView()
    {
        $operName = Auth::user()->name;
        $operFullName = Auth::user()->user_name;
        $pointId = Auth::user()->point_id;
        $operPoint = Point::find(Auth::user()->point_id);

        $packages = Package::where([['point_id_s',  $pointId],
            ['status_id', 2]])->get();

//        echo "<pre>";
//        var_dump($packages); die;

        return view('managersend', ['operName' => $operName,
            'operFullName' => $operFullName,
            'operPoint' => $operPoint,
            'packages' => $packages
        ]);
    }

    public function packageSend(Request $request)
    {
//        echo "!!";
//        dd($request); die;

        $packagesFromSklad = $request->input('packsend');
//        var_dump($packagesFromSklad); die;

        foreach ($packagesFromSklad as $id => $packageFromSklad) {

            $package = Package::find($packageFromSklad);
            $package->status_id = 3;
            $package->status_msg = "Отправлено из отделения №".$package->point_num.", ". $package->point_address. " направляется в отделение №". $package->point_r->point_number. " г.".$package->point_r->city->city_name." ".$package->point_r->point_address;

            $track = new Package_track();
//              $track->package_id;
            $track->package_status_message = $package->status_msg;
            $track->package_status_id =  $package->status_id;
            $track->package_status_data = time();

//            $package->save();
////
////            $package->package_track()->save($track);
//            $package->package_track()->save($track);

            DB::transaction(function () use($package, $track) {
                $package->save();

//                $track->package_id = $package->idd;
//                $track->save();

                $package->package_track()->save($track);

            });

            echo $package->status_msg."<br>";
//            echo $track->package_status_data."<br>";
        }
        return redirect(route('manager'))->with('success', 'Посылки отправлены из отделения!!');

    }

    public function packageToRecive(Request $request)
    {
//        echo "!!@";
//
//        dd($request); die;

        $packagesFromSklad = $request->input('packget');
        $packagesBad = $request->has('bad') ? $request->input('bad') : [];
//        $packagesBad = $request->input('bad');

//        var_dump($packagesFromSklad); die;

        foreach ($packagesFromSklad as $id => $packageFromSklad) {

            $package = Package::find($packageFromSklad);
            $package->status_id = 7;
            $package->status_msg = "Находиться в отделении №". $package->point_r->point_number. " г.".$package->point_r->city->city_name." ".$package->point_r->point_address." Готова к выдаче.";

            $track = new Package_track();
//              $track->package_id;
            $track->package_status_message = $package->status_msg;
            $track->package_status_id =  $package->status_id;
            $track->package_status_data = time();

            DB::transaction(function () use($package, $track) {
                $package->save();
                $package->package_track()->save($track);
            });

//            echo $track->package_status_data."<br>";
//            echo $package->id;
//            echo $package->status_id;
//            echo $package->isbad;
//
//            dd($request); die;

            return redirect(route('manager'))->with('success', 'Посылки направлены на выдачу!!');
        }
    }

    public function managerToReciveViews()
    {
        $operName = Auth::user()->name;
        $operFullName = Auth::user()->user_name;
        $pointId = Auth::user()->point_id;
        $operPoint = Point::find(Auth::user()->point_id);

        $packages = Package::where([['point_id',  $pointId],
            ['status_id', 6]])->get();

//        echo "<pre>";
//        var_dump($packages); die;

        return view('managerrecive', ['operName' => $operName,
            'operFullName' => $operFullName,
            'operPoint' => $operPoint,
            'packages' => $packages
        ]);
    }

}
