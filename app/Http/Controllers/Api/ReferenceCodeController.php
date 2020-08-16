<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\ReferenceCode;
use App\Models\Student;
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

        $student = Student::find($request->student);

        $student->courses()->sync($course->id);

        $referenceCode = ReferenceCode::create([
            'course_id' => $request->course,
            'student_id' => $request->student,
        ]);

        // Agrega credenciales
        MercadoPago\SDK::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));

        $payer = new MercadoPago\Payer();
        $payer->name = $student->name;
        $payer->surname = $student->last_name;
        $payer->email = $student->email;
        $payer->date_created = $student->created_at;
        $payer->phone = array(
            "area_code" => "",
            "number" => $student->phone
        );

        $payer->identification = array(
            "type" => "CC",
            "number" => $student->identification
        );

        // Crea un objeto de preferencia
        $preference = new MercadoPago\Preference();

        // Crea un ítem en la preferencia
        $item = new MercadoPago\Item();

        $preference->back_urls = array(
            "success" => "https://checkout.livingroomcollege.org/response",
            "failure" => "https://checkout.livingroomcollege.org/response",
            "pending" => "https://checkout.livingroomcollege.org/response"
        );

        $preference->auto_return = "approved";

        $preference->notification_url = 'https://checkout.livingroomcollege.org/api/transactions/mercadopago';

        $item->title = $course->name;
        $item->description = $course->description;
        $item->category_id = 'learnings';
        $item->quantity = 1;
        $item->unit_price = $course->price;

        $tax = new MercadoPago\Tax();
        $tax->type = 'IVA';
        $tax->value = 0;
        $preference->taxes = array($tax);

        $preference->external_reference = $referenceCode->id;
        $preference->payer = $payer;
        $preference->items = array($item);
        $preference->save();

        $referenceCode->update(['code' => $preference->id]);

        return response()->json([
            'referenceCode' => $referenceCode->code,
            'referenceId' => $referenceCode->id,
            'init_point' => $preference->init_point,
        ]);

        //return $referenceCode->toJson();
    }
}
