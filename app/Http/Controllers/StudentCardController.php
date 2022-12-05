<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Inertia\Inertia;

class StudentCardController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
        return Inertia::render('StudentCard/Create');
    }

    public function store(Request $request)
    {
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
        return Inertia::render('StudentCard/Index', compact('student'));
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
