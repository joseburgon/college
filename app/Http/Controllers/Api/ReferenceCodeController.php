<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\ReferenceCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use MercadoPago;

class ReferenceCodeController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $referenceCodes = ReferenceCode::all();
    }

    public function store(Request $request)
    {
        $course = Course::find($request->course);

        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));

        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        // Crea un ítem en la preferencia
        $item = new MercadoPago\Item();

        $preference->back_urls = array(
            "success" => "http://checkout.livingroomcollege.org/response",
            "failure" => "http://checkout.livingroomcollege.org/response",
            "pending" => "http://checkout.livingroomcollege.org/response"
        );
        
        $preference->auto_return = "approved";

        $preference->notification_url = 'http://checkout.livingroomcollege.org/api/notifications?source_news=ipn';

        $item->title = $course->name;
        $item->quantity = 1;
        $item->unit_price = $course->price;
        $preference->items = array($item);
        $preference->save();

        $referenceCode = new ReferenceCode;
        $referenceCode->code = $preference->id;
        $referenceCode->course_id = $request->course;
        $referenceCode->save();

        return $referenceCode->toJson();
    }
}
