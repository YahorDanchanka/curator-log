<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Inertia\Inertia;

class StudentCardController extends Controller
{
    public function index($id)
    {
        $student = Student::find($id);

        if (!$student) {
            abort(404);
        }

        $student->load('user', 'achievements', 'violations', 'recommendations', 'individualWork');

        return Inertia::render('StudentCard/Index', compact('student'));
    }
}
