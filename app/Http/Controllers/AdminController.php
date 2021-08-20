<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Package_track;
use App\Models\Point;
use Illuminate\Http\Request;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function addoper(Request $request)
    {
//        echo "ok";
//        dd($request->request->all()); die;

        $user = new CreateNewUser();
        $newUser = $user->create($request->request->all());
//        $newUser = CreateNewUser::create($request->request->all());

        if ($newUser) return redirect()->back()->with('success', 'Пользователь создан!');
        else return redirect()->back()->withErrors(["Ошибка при создании пользователя!!!"]);


    }

    public function viewAdmin()
    {
        $point = Point::all();
//        foreach ($point->all() as $point) {
//            echo $point->point_number." - ".$point->city->city_name." ".$point->point_address."<br>";
//        }

        return view('admin', ['point' => $point,]);
    }

    public function adminGoPackage()
    {
        $packagesToMove = Package::where('status_id', 3)->get();
//        dd($packagerToMove); die;

        $logsToView = [];

        foreach ($packagesToMove as $id => $packageToMove) {

            $packageToMove->status_id = 4;
            $packageToMove->status_msg = "Отправление в дороге. Направляется в отделение №". $packageToMove->point_r->point_number. " г.".$packageToMove->point_r->city->city_name." ".$packageToMove->point_r->point_address;

            $track = new Package_track();
//              $track->package_id;
            $track->package_status_message = $packageToMove->status_msg;
            $track->package_status_id =  $packageToMove->status_id;
            $track->package_status_data = time();


            DB::transaction(function () use($packageToMove, $track) {
                $packageToMove->save();

//                $track->package_id = $package->idd;
//                $track->save();

                $packageToMove->package_track()->save($track);


            });
            $logsToView[$packageToMove->order_num] = "Почтовому отправлению $packageToMove->order_num статус 3 присвоен статус 4 'в дороге'";

        }

        $packagesToHome = Package::where('status_id', 4)->get();
//        dd($packagerToMove); die;

        foreach ($packagesToHome as $id => $packageToHome) {

            $packageToHome->status_id = 5;
            $packageToHome->status_msg = "Прибыло в отделение получателя №". $packageToHome->point_r->point_number. " г.".$packageToHome->point_r->city->city_name." ".$packageToHome->point_r->point_address." Ожидает обработку/принятие складом.";

            $track = new Package_track();
//              $track->package_id;
            $track->package_status_message = $packageToHome->status_msg;
            $track->package_status_id =  $packageToHome->status_id;
            $track->package_status_data = time();

            DB::transaction(function () use($packageToHome, $track) {

                $packageToHome->save();
//                $track->package_id = $package->idd;
//                $track->save();
                $packageToHome->package_track()->save($track);

            });
            $logsToView[$packageToHome->order_num] = "Почтовому отправлению $packageToHome->order_num статус 4 присвоен статус 5 'прибыло в отделение получателя'";
        }

        return view('admintomove', ['logsToView' => $logsToView,]);
    }

}
//            $package->save();
////
////            $package->package_track()->save($track);
//            $package->package_track()->save($track);
//            echo "Почтовому отправлению $packageToMove->order_num статус 3 присвоен статус 4 'в дороге'";
//
//            echo $packageToMove->status_msg."<br>";
//            echo $track->package_status_data."<br>";
