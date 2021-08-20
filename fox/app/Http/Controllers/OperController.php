<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrackNumRequest;
use App\Models\Package_track;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Point;
use App\Models\City;
use App\Models\ExpressUser;
use App\Models\Package;
use Illuminate\Support\Facades\DB;

class OperController extends Controller
{
    public function viewDesktop()
    {
        $operName = Auth::user()->name;
        $operFullName = Auth::user()->user_name;
        $operPoint = Point::find(Auth::user()->point_id);

        return view('oper', ['operName' => $operName,
            'operFullName' => $operFullName,
            'operPoint' => $operPoint,
        ]);
    }

    public function addNewExpressUser(Request $request)
    {
//        dd($request); die;
        $phoneUser = $request->input('user_phone');
        $phoneName = $request->input('user_name');

        $newExpressUser = new ExpressUser();

//        echo $phoneUser;
//        echo $phoneName;
//        die;

        $newExpressUser->user_phone = $phoneUser;
        $newExpressUser->user_name = $phoneName;
        $newExpressUser->user_bonus = 0;
        $newExpressUser->user_count = 0;
        $newExpressUser->user_client_card = 0;

        $newExpressUser->save();

//        return redirect()->route('operSend', ['user_phone_sender' => $newExpressUser->user_phone])->with('success', 'Клиент добавлен');
        return redirect()->back()->with('success', 'Клиент добавлен');

    }

    public function sendPackage(Request $request)
    {
        // валидация телефона отрпавителя потом написать
//        $validation = $req->validate([
//            'trackNum' => 'required|integer|min:10'
//        ]);

        $phoneSender = $request->input('user_phone_sender');
        $phoneReciver = $request->input('phone_phone_recive');

        $operName = Auth::user()->name;
        $operFullName = Auth::user()->user_name;
        $operPoint = Point::find(Auth::user()->point_id);

        if (!$request->has('user_phone_sender'))
        return view('send', ['operName' => $operName,
            'operFullName' => $operFullName,
            'operPoint' => $operPoint,
        ]);

        $userSender = ExpressUser::where('user_phone', $phoneSender)->first();

        if (!$userSender) {
            $newPhone = $phoneSender;
            $userSender = new ExpressUser();
            $userSender->user_phone = "##########";
            $userSender->user_name = "##########";
            $userSender->user_bonus = "##########";
            $userSender->user_count = "##########";
            $userSender->user_client_card = "##########";
        }

        $userReciver = ExpressUser::where('user_phone', $phoneReciver)->first();

        if (!$userReciver) {
            $userReciver = new ExpressUser();
            $userReciver->user_phone = "##########";
            $userReciver->user_name = "##########";
            $userReciver->user_bonus = "##########";
            $userReciver->user_count = "##########";
            $userReciver->user_client_card = "##########";
        }

        $city_id = $request->has('city_id') ? $request->input('city_id') : null;
        $cityRecive = City::find($city_id);

        $point_id = $request->has('point_id') ? $request->input('point_id') : null;
        $pointRecive = Point::find($point_id);

        $package = new Package();

        $package->user_phone_sender = ($userSender->user_phone == '##########') ? $phoneSender : $userSender->user_phone;
        $package->point_num = $operPoint->point_number;
        $package->point_id_s = $operPoint->id;
        $package->point_address = $operPoint->city->city_name.", ".$operPoint->point_address;
        $package->pack_descr = $request->has('pack_descr') ? $request->input('pack_descr') : null;
        $package->pack_weight = $request->has('pack_weight') ? $request->input('pack_weight') : null;
        $package->pack_length = $request->has('pack_length') ? $request->input('pack_length') : null;
        $package->pack_width = $request->has('pack_width') ? $request->input('pack_width') : null;
        $package->pack_height = $request->has('pack_height') ? $request->input('pack_height') : null;
//        $package->phone_phone_recive = $userReciver->user_phone ?? null;
        $package->phone_phone_recive = ($userReciver->user_phone == '##########') ? $phoneReciver : $userReciver->user_phone;
        $package->city_id = $city_id;
        $package->point_id = $point_id;
        $package->pay_beznal = $request->has('pay_beznal') ? $request->input('pay_beznal') : 'off';
        $package->pay = $request->has('pay') ? $request->input('pay') : 'off';
        $package->pay_reciver = $request->has('pay_reciver') ? $request->input('pay_reciver') : 'off';
        $package->order_num = time();
        $package->status_msg = "Находится в отделении ".$operPoint->point_number.", По адресу ". $userSender->point_number .$operPoint->city->city_name.", ". $operPoint->point_address.". Ожидает обработку/проверку складом.";
        $package->status_id = 1;
        $package->timePkgCreate = time();
        $package->user_sender_id = $userSender->id;
        $package->user_reciver_id = $userReciver->id ?? null;
        $package->pack_price_send = $request->has('sendPockagePrice') ? $request->input('sendPockagePrice') : 0;
        $package->pack_price = $request->has('pack_price') ? $request->input('pack_price') : 0;

        $track = new Package_track();
//        $track->package_id;
        $track->package_status_message = $package->status_msg;
        $track->package_status_id =  $package->status_id;
        $track->package_status_data = time();

        if ($request->has('send_offer')) {

            DB::transaction(function () use($package, $track) {

                $package->save();
//                $track->package_id = $package->idd;
//                $track->save();
                $package->package_track()->save($track);

            });

            $package = Package::find($package->id);

            return view('qr', ['operName' => $operName,
                'operFullName' => $operFullName,
                'operPoint' => $operPoint,
                'userSender' => $userSender,
                'userReciver' => $userReciver,
                'package' => $package,
                'city_id' => $city_id,
                'cityRecive' => $cityRecive,
                'pointRecive' => $pointRecive,
            ]);
        }

        $package->pack_price = $request->has('pack_price') ? $request->input('pack_price') : null;

        $sendPackagePrice = ($package->pack_width*$package->pack_height*$package->pack_length)*0.3+($package->pack_price/10);

        $go_cost = $request->has('go_cost') ? $request->input('go_cost') : null;

        $findpoint = $request->has('findpoint') ? $request->input('findpoint') : null;

        if(!isset($findpoint) && isset($city_id) && isset($point_id) && empty($cityRecive->point->find($point_id)) ) {

            return redirect()->back()->withErrors(["Расчет стоимости не выполнен!! Прверте данные"]);
        }

        if (!$cityRecive) $cityRecive = new City();
        if (!$pointRecive) $pointRecive = new Point();

        $citiesList = City::all();

        return view('send', ['operName' => $operName,
            'operFullName' => $operFullName,
            'operPoint' => $operPoint,
            'userSender' => $userSender,
            'userReciver' => $userReciver,
            'package' => $package,
            'citiesList' => $citiesList,
            'city_id' => $city_id,
            'cityRecive' => $cityRecive,
            'pointRecive' => $pointRecive,
            'go_cost' => $go_cost,
            'sendPockagePrice' => $sendPackagePrice,
        ]);
    }

    public function recivePackage(Request $req)
    {
        $operName = Auth::user()->name;
        $operFullName = Auth::user()->user_name;
        $pointId = Auth::user()->point_id;
        $operPoint = Point::find(Auth::user()->point_id);

        if (!$req->has('order'))
            return view('recive', ['operName' => $operName,
                'operFullName' => $operFullName,
                'operPoint' => $operPoint,
            ]);

        $trackNumber = $req->input('order');

        $package = Package::where([['point_id',  $pointId],
                                    ['status_id',  7],
                                    ['order_num', $trackNumber]])->first();

        if (isset($package->id)) {
            $userSender = ExpressUser::find($package->user_sender_id);
            $userReciver = ExpressUser::find($package->user_reciver_id);

            $pointSender = Point::find($package->point_id_s);
            $pointRecive = Point::find($package->point_id);

            return view('recive', ['operName' => $operName,
                'operFullName' => $operFullName,
                'operPoint' => $operPoint,
                'userSender' => $userSender,
                'userReciver' => $userReciver,
                'package' => $package,
                'pointSender' => $pointSender,
                'pointRecive' => $pointRecive,
            ]);
        }
        else {
            return redirect()->back()->withErrors(["Трек #$trackNumber не найден!!! Проверте данные!!!"]);
        }
    }

    public function recivePackageDo(Request $request)
    {
        $package = $request->input('packageId');

        $package = Package::find($package);
        $package->status_id = 8;
        $package->status_msg = "Вручено получателю в отделении №". $package->point_r->point_number. " г.".$package->point_r->city->city_name." ".$package->point_r->point_address;

        $track = new Package_track();
//              $track->package_id;
        $track->package_status_message = $package->status_msg;
        $track->package_status_id =  $package->status_id;
        $track->package_status_data = time();

        DB::transaction(function () use($package, $track) {
            $package->save();
            $package->package_track()->save($track);
        });

        echo $package->status_msg."<br>";

        return redirect(route('oper'))->with('success', 'Посылка выдана!!');
    }
}


//        $pointRecive = Point::find($city_id);



//            ------------
//            $package->save();
////
////            $package->package_track()->save($track);
//            $package->package_track()->save($track);
//            =============

//            $package->save();
//            $track->package()->save($package);
//            $track->save($package);
//            $package->$track->save();
//
//            $track->package_id = $package->id;
//            $track->save();

//            echo "ok"; die;
//        echo "<pre>";



//        var_dump($package); die;

//        $package->pack_descr = $request->has('pack_descr') ? $request->input('pack_descr') : null;
//        $package->pack_weight = $request->has('pack_weight') ? $request->input('pack_weight') : null;
//        $package->pack_length = $request->has('pack_length') ? $request->input('pack_length') : null;
//        $package->pack_width = $request->has('pack_width') ? $request->input('pack_width') : null;
//        $package->pack_height = $request->has('pack_height') ? $request->input('pack_height') : null;

//        var_dump($cityRecive->point->all()); die;

//        var_dump($package); die;

//        $city_id = $request->has('city_id') ? $request->input('city_id') : null;
//        $cityRecive = City::find($city_id);
//
//        $point_id = $request->has('point_id') ? $request->input('point_id') : null;
//        $pointRecive = Point::find($point_id);

//            $packageTrack = Package_track::where('package_id', $package->id)
//                                                ->orderBy('package_status_data', 'asc')->get();

//        echo "p-".$point_id."<br>";
//        echo "c-".$city_id."<br>";
//        echo "<pre>";
//        var_dump($cityRecive->point->find($point_id));
//        die;

//            return view('send', ['operName' => $operName,
//                'operFullName' => $operFullName,
//                'operPoint' => $operPoint,
//                'userSender' => $userSender
//            ]);

//            return view('send', ['operName' => $operName,
//                'operFullName' => $operFullName,
//                'operPoint' => $operPoint,
//                'userSender' => $userSender
//            ]);
