<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Passport;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class StudentCardController extends Controller
{
    public function index()
    {
        $students = Student::all()->load('user', 'user.address', 'passport');
        return Inertia::render('StudentCard/Index', compact('students'));
    }

    public function create()
    {
        $storeUrl = route('student-card.store');
        return Inertia::render('StudentCard/Create', compact('storeUrl'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user.surname' => 'required',
            'user.first_name' => 'required',
            'user.middle_name' => 'required',
            'user.sex' => ['required', Rule::in(['male', 'female'])],
            'user.birthday' => 'required|date',
            'user.citizenship' => 'required',
            'user.job' => 'nullable',
            'user.phone_number' => 'nullable',
            'student.home_phone_number' => 'nullable',
            'student.graduated' => 'required',
            'student.relationship' => 'nullable',
            'student.hobbies' => 'nullable',
            'student.address' => 'nullable',
            'student.health' => 'required',
            'student.social_conditions' => 'nullable',
            'student.apprenticeship' => 'required',
            'student.certificate_date' => 'required|date',
            'student.other_details' => 'nullable',
            'address.region' => 'required',
            'address.district' => 'required',
            'address.residenceType' => 'required',
            'address.residence' => 'required',
            'address.street' => 'required',
            'passport.series' => 'required',
            'passport.number' => 'required',
            'passport.district_department' => 'required',
            'passport.issue_date' => 'required|date',
        ]);

        $login = Str::random(8);
        $user = User::create(
            array_merge($validated['user'], [
                'login' => $login,
                'password' => Hash::make($login),
            ]),
        );

        $student = Student::create(array_merge($validated['student'], ['user_id' => $user->id]));
        Address::create(array_merge($validated['address'], ['user_id' => $user->id]));
        Passport::create(array_merge($validated['passport'], ['student_id' => $student->id]));

        return Inertia::location(route('student-card.show', ['student_card' => $student->id]));
    }

    public function show($id)
    {
        $student = Student::find($id);

        if (!$student) {
            abort(404);
        }

        $student->load(
            'user',
            'user.address',
            'passport',
            'achievements',
            'violations',
            'recommendations',
            'individualWork',
            'familyMembers',
        );
        return Inertia::render('StudentCard/Show', compact('student'));
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
