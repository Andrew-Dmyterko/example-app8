<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrackNumRequest;
use App\Models\Package_track;
use App\Models\Package;
use App\Models\ExpressUser;
use App\Models\Point;
use App\Models\City;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    //
    public function packageTrack(TrackNumRequest $req)
    {

//                валидация формы перенесена в реквесты

        $trackNumber = $req->input('trackNum');

        $package = Package::where('order_num', $trackNumber)->first();

        if ($package) {
            $userSend = ExpressUser::find($package->user_sender_id);
            $userRecive = ExpressUser::find($package->user_reciver_id);

            $pointSender = Point::find($package->point_id_s);
            $pointReciver = Point::find($package->point_id);

//            $packageTrack = Package_track::where('package_id', $package->id)
//                                                ->orderBy('package_status_data', 'asc')->get();

            $packageTracks = $package->package_track->sortBy('package_status_data');

            return view('packageTrack', ['package' => $package,
                'userSend' => $userSend,
                'userRecive' => $userRecive,
                'pointSender' => $pointSender,
                'pointReciver' => $pointReciver,
                'packageTracks' => $packageTracks
            ]);
        }
        else return redirect()->back()->withErrors(["Трек #$trackNumber не найден!!! Проверте данные!!!"]);
    }
}

//                валидация формы перенесена в реквесты
//        $validation = $req->validate([
//            'trackNum' => 'required|integer|min:10'
//        ]);

//        dd($req->input('trackNum'));
//        dd(Request::all());
//        return Request::all();

//
//            $city = City::find(4);
////            var_dump($city);
//            echo"<pre>@@@@@@@@@";
////            var_dump($city->point->all());
//            foreach ($city->point->all() as $point) {
//                echo $point->city->city_name." ".$point->point_address;
//            }
//echo "<hr>";
//            $city = City::where('city_name', 'like', 'Хмел%')->first();
//            foreach ($city->point->all() as $point) {
//                echo $point->city->city_name." ".$point->point_address."<br>";
//            }
////            echo"!!!".$pointS->city->created_at;
//            echo "<hr>";
//            $city = City::where('city_name', 'like', 'Хмел%')->first();
//            foreach ($city->point->all() as $point) {
//                echo $point->city->city_name." ".$point->point_address."<br>";
//            }
//       $packageId = $package->id;
//        echo "<pre>";
//        var_dump($pointSender);
//        var_dump($pointReciver);
//        var_dump($packageTrack);
//die;
//        $package = Package::find($trackId);
//        var_dump($package);

//        // сырой запрос
////            $pointSender = DB::select('select * from points a, cities b where a.id = ? and b.`id`=a.`city_id` order by a.point_number', [$package->point_id_s]);
////            $pointReciver = DB::select('select * from points a, cities b where a.id = ? and b.`id`=a.`city_id` order by a.point_number', [$package->point_id]);
//


//            //        $results = DB::select('select * from users where id = ?', [1]);


//$packageTrack = Package_track::find(31);
//echo "<pre>";
//var_dump($packageTrack);
//echo "<hr>";
//
//$package1 = $packageTrack->package;
//var_dump($package);
//
//die;
