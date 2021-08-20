<?php

namespace App\Http\Controllers;

use App\Models\ExpressUser;
use App\Models\Package;
use App\Models\Package_track;
use App\Models\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SkladController extends Controller
{
    public function viewDesktop()
    {
        $operName = Auth::user()->name;
        $operFullName = Auth::user()->user_name;
        $operPoint = Point::find(Auth::user()->point_id);

        return view('sklad', ['operName' => $operName,
            'operFullName' => $operFullName,
            'operPoint' => $operPoint,
        ]);
    }

    public function packagePackView()
    {
        $operName = Auth::user()->name;
        $operFullName = Auth::user()->user_name;
        $pointId = Auth::user()->point_id;
        $operPoint = Point::find(Auth::user()->point_id);

//        $package = Package::find(34);
//        echo $package->user_s->user_name;
//        die;


//        $expressUser->find

        $packages = Package::where([['point_id_s',  $pointId],
                                    ['status_id', 1]])->get();

//        echo "<pre>";
//        var_dump($packages); die;

        return view('skladpack', ['operName' => $operName,
            'operFullName' => $operFullName,
            'operPoint' => $operPoint,
            'packages' => $packages
        ]);
    }

    public function packagePack(Request $request)
    {
//        dd($request); die;

        $packagesFromSklad = $request->input('packcheck');
//        var_dump($packagesFromSklad); die;

        foreach ($packagesFromSklad as $id => $packageFromSklad) {

            $package = Package::find($packageFromSklad);
            $package->status_id = 2;
            $package->status_msg = "Находится в отделении ".$package->point_num.", По адресу ". $package->point_address. " Пройдено обработку складом. Ожидает отправку из отделения.";

            $track = new Package_track();
//              $track->package_id;
            $track->package_status_message = $package->status_msg;
            $track->package_status_id =  $package->status_id;
            $track->package_status_data = time();

            $package->save();
//
//            $package->package_track()->save($track);
            $package->package_track()->save($track);

//            echo $track->package_status_data."<br>";
            return redirect(route('sklad'))->with('success', 'Посылки обработаны складом!!');
        }
    }

    public function packageReciveView()
    {
        $operName = Auth::user()->name;
        $operFullName = Auth::user()->user_name;
        $pointId = Auth::user()->point_id;
        $operPoint = Point::find(Auth::user()->point_id);

        $packages = Package::where([['point_id',  $pointId],
            ['status_id', 5]])->get();

//        echo "<pre>";
//        var_dump($packages); die;

        return view('skladRecive', ['operName' => $operName,
            'operFullName' => $operFullName,
            'operPoint' => $operPoint,
            'packages' => $packages
        ]);
    }


    public function packageRecive(Request $request)
    {
//        dd($request); die;

        $packagesFromSklad = $request->input('packrecive');
        $packagesBad = $request->has('bad') ? $request->input('bad') : [];
//        $packagesBad = $request->input('bad');

//        var_dump($packagesFromSklad); die;

        foreach ($packagesFromSklad as $id => $packageFromSklad) {

            $package = Package::find($packageFromSklad);
            $package->status_id = in_array($package->id, $packagesBad) ? 999 : 6;
            $package->isbad = in_array($package->id, $packagesBad) ? 999 : 0;
            $package->status_msg = "Находиться в отделении №". $package->point_r->point_number. " г.".$package->point_r->city->city_name." ".$package->point_r->point_address." Обработано складом. Готовиться к выдаче.";

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

            return redirect(route('sklad'))->with('success', 'Посылки обработаны складом!!');
        }
    }


}

