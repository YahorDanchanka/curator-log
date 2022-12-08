<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class RelativeController extends Controller
{
    public function index()
    {
        //
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'relative.surname' => 'required',
            'relative.first_name' => 'required',
            'relative.middle_name' => 'required',
            'relative.sex' => ['required', Rule::in(['male', 'female'])],
            'relative.birthday' => 'required|date',
            'relative.citizenship' => 'required',
            'relative.job' => 'nullable',
            'relative.phone_number' => 'nullable',
            'familyMember.type' => ['required', Rule::in(['mother', 'father', 'brother', 'sister'])],
            'address.region' => 'required',
            'address.district' => 'required',
            'address.residenceType' => 'required',
            'address.residence' => 'required',
            'address.street' => 'required',
            'studentId' => 'required',
        ]);

        $student = Student::find($validated['studentId']);

        if (!$student) {
            abort(404);
        }

        $login = Str::random(8);
        $user = User::create(
            array_merge($validated['relative'], [
                'login' => $login,
                'password' => Hash::make($login),
            ]),
        );

        $student->familyMembers()->attach($user->id, ['type' => $validated['studentId']]);
        Address::create(array_merge($validated['address'], ['user_id' => $user->id]));

        return Inertia::location(route('student-card.show', ['student_card' => $validated['studentId']]));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }
    public function update(Request $request, $id)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
