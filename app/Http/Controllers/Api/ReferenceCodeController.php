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
    public function index(Request $request)
    {
        $referenceCodes = ReferenceCode::all();
    }

    public function store(Request $request)
    {
        $referenceCode = ReferenceCode::create([
            'course_id' => $request->course,
            'student_id' => $request->student,
        ]);

        $testing = $request->query('testing');

        $student = Student::find($request->student);

        $course = Course::find($request->course);

        $preference = $this->createPreference($student, $course, $referenceCode, $testing);

        $referenceCode->update(['code' => $preference->id]);

        return response()->json([
            'referenceCode' => $referenceCode->code,
            'referenceId' => $referenceCode->id,
            'init_point' => $preference->init_point,
        ]);
    }

    private function createPreference(Student $student, Course $course, ReferenceCode $referenceCode, $testing)
    {
        MercadoPago\SDK::setAccessToken(config('app.mercadopago_access_token'));

        $preference = new MercadoPago\Preference();

        $preference->back_urls = array(
            "success" => "https://checkout.livingroomcollege.org/success",
            "failure" => "https://checkout.livingroomcollege.org/failure",
            "pending" => "https://checkout.livingroomcollege.org/pending"
        );

        $preference->auto_return = "approved";

        $preference->notification_url = 'https://checkout.livingroomcollege.org/api/transactions/mercadopago';

        $payer = $this->createPayer($student);

        $item = $this->createItem($course, $testing);

        $tax = $this->createTax();

        $preference->taxes = array ($tax);

        $preference->external_reference = $referenceCode->id;
        $preference->payer = $payer;
        $preference->items = array ($item);
        $preference->save();

        return $preference;
    }

    private function createPayer(Student $student)
    {
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

        return $payer;
    }

    private function createItem(Course $course, $testing)
    {
        $item = new MercadoPago\Item();

        $item->title = $course->name;
        $item->description = $course->description;
        $item->category_id = 'learnings';
        $item->quantity = 1;

        $item->unit_price = $testing === '1' ? '2000' : $course->price;

        return $item;
    }

    private function createTax()
    {
        $tax = new MercadoPago\Tax();
        $tax->type = 'IVA';
        $tax->value = 0;

        return $tax;
    }
}
