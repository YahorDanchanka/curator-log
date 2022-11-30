<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function index()
    {
//        $user = new User();
//        $user->email = 'mihail@mail.ru';
//        $user->surname = 'Данченко';
//        $user->first_name = 'Михаил';
//        $user->middle_name = 'Иванов';
//        $user->birthday = '1953-03-16';
//        $user->citizenship = 'Россия';
//        $user->address = 'д. Ленино, 36';
//        $user->job = 'УО "Лесхоз ромашка"';
//        $user->phone_number = '375291345438';
//        $user->password = Hash::make('qwerty');
//        $user->save();
//        $user = new User();
//        $user->email = 'igor16075@mail.ru';
//        $user->surname = 'Данченко';
//        $user->first_name = 'Игорь';
//        $user->middle_name = 'Анатольевич';
//        $user->birthday = '1973-03-16';
//        $user->citizenship = 'Беларусь';
//        $user->address = 'ул. 60 лет СССР, к. 148';
//        $user->job = 'УО "Минск-реклама"';
//        $user->phone_number = '375447343438';
//        $user->password = Hash::make('qwerty');
//        $user->save();
//        $user = new User();
//        $user->email = 'lusya0712@yandex.by';
//        $user->surname = 'Данченко';
//        $user->first_name = 'Людмила';
//        $user->middle_name = 'Ивановна';
//        $user->birthday = '1978-12-07';
//        $user->citizenship = 'Беларусь';
//        $user->address = 'ул. Волгоградская 12, 412';
//        $user->job = 'УО "Гимназия 71"';
//        $user->phone_number = '375447343438';
//        $user->password = Hash::make('qwerty');
//        $user->save();
//        $student = new Student();
//        $student->graduated = 'Гимназия 71';
//        $student->passport_data = 'пасп. данные';
//        $student->relationship = 'хорошие';
//        $student->hobbies = 'программирование';
//        $student->health = 'хорошее';
//        $student->user_id = 1;
//        $student->address = 'общежитие';
//        $student->save();
        return view('main.welcome');
    }
}
