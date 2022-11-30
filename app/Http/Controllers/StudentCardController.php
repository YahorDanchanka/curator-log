<?php

namespace App\Http\Controllers;

use App\Models\Student;

class StudentCardController extends Controller
{
    public function index($id)
    {
        $student = Student::find($id);

        if (!$student) {
            abort(404);
        }

        return view('student-card.index', compact('student'));
    }
}
