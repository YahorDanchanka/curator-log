<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentCardRequest;
use App\Models\Address;
use App\Models\Passport;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
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

    public function store(StudentCardRequest $request)
    {
        $validated = $request->validated();

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
        $student = Student::find($id);

        if (!$student) {
            abort(404);
        }

        $user = $student->user;
        $address = $user->address;
        $passport = $student->passport;
        $updateUrl = route('student-card.update', ['student_card' => $id]);
        return Inertia::render('StudentCard/Update', compact('updateUrl', 'student', 'user', 'address', 'passport'));
    }

    public function update(StudentCardRequest $request, $id)
    {
        $validated = $request->validated();

        $student = Student::find($id);
        $user = $student->user;
        $address = $user->address;
        $passport = $student->passport;

        $student->update($validated['student']);
        $user->update($validated['user']);
        $address->update($validated['address']);
        $passport->update($validated['passport']);

        return Inertia::location(route('student-card.show', ['student_card' => $student->id]));
    }

    public function destroy($id)
    {
        $student = Student::find($id);

        if (!$student) {
            abort(404);
        }

        $student->user->delete();
        return Inertia::location(route('student-card.index'));
    }
}
