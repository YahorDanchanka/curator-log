@extends('layouts.main')
@section('title', 'Карта персонифицированного учета')

@section('content')
    <style>
        .text-field {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
        }

        .text-field__value {
            flex-grow: 1;
            text-align: center;
            border-bottom: 1px solid;
            min-height: 24px;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <h1>Карта персонифицированного учета</h1>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-xl-1 text-center">
                <img class="img-fluid" src="https://dummyimage.com/100x100/000/fff" alt="Фото учащегося">
            </div>
            <div class="col-xl-11">
                <div class="row">
                    <div class="col">
                        <div class="text-field">
                            <div class="text-field__label">
                                1. Фамилия
                            </div>
                            <div class="text-field__value">
                                {{ $student->user->surname }}
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-field">
                            <div class="text-field__label">
                                2. Имя
                            </div>
                            <div class="text-field__value">
                                {{ $student->user->first_name }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="text-field">
                            <div class="text-field__label">
                                3. Отчество
                            </div>
                            <div class="text-field__value">
                                {{ $student->user->middle_name }}
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="text-field">
                            <div class="text-field__label">
                                4. Дата рождения
                            </div>
                            <div class="text-field__value">
                                {{ $student->user->birthday }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="row">
                <div class="col">
                    <div class="text-field">
                        <div class="text-field__label">
                            5. Гражданство
                        </div>
                        <div class="text-field__value">
                            {{ $student->user->citizenship }}
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="text-field">
                        <div class="text-field__label">
                            6. Окончил УО
                        </div>
                        <div class="text-field__value">
                            {{ $student->graduated }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12">
            <div class="text-field">
                <div class="text-field__label">
                    7. Паспортные данные
                </div>
                <div class="text-field__value">
                        {{ $student->passport_data }}
                </div>
            </div>
            <div class="text-field">
                <div class="text-field__label">
                    8. Домашний адрес, телефон
                </div>
                <div class="text-field__value">
                    {{ $student->user->address }}, <a href="tel:+{{ $student->user->phone_number }}">+{{ $student->user->phone_number }}</a>
                </div>
            </div>
            <div class="text-field">
                <div class="text-field__label">
                    9. Место проживания в период обучения
                </div>
                <div class="text-field__value">
                    {{ $student->address }}
                </div>
            </div>
            <div class="text-field">
                <div class="text-field__label">
                    10. Сведения о состоянии здоровья
                </div>
                <div class="text-field__value">
                    {{ $student->health }}
                </div>
            </div>
            11. Сведения о семье: ФИО, дата рождения, гражданство, место жительства и (или) место пребывания, место работы родителей или других законных представителей
            <div class="text-field">
                <div class="text-field__label">
                    Отец
                </div>
                <div class="text-field__value">
                    @if($student->father)
                        {{ $student->father->info }}
                    @endif
                </div>
            </div>
            <div class="text-field">
                <div class="text-field__label">
                    Мать
                </div>
                <div class="text-field__value">
                    @if($student->mother)
                        {{ $student->mother->info }}
                    @endif
                </div>
            </div>
            <div class="text-field">
                <div class="text-field__label">
                    Другие члены семьи
                </div>
                <div class="text-field__value">
                    {!! collect($student->otherFamilyMembers)->pluck('info')->join('<br>') !!}
                </div>
            </div>
            <div class="text-field">
                <div class="text-field__label">
                    12. Отношения учащегося с членами семьи, попечителем и др.
                </div>
                <div class="text-field__value">{{ $student->relationship }}</div>
            </div>
            <div class="text-field">
                <div class="text-field__label">
                    13. Увлечения
                </div>
                <div class="text-field__value">{{ $student->hobbies }}</div>
            </div>
            <div class="text-field">
                <div class="text-field__label">
                    14. Другие сведения
                </div>
                <div class="text-field__value">{{ $student->other_details }}</div>
            </div>
            15. Поощрения учащегося:
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Дата</th>
                        <th>За какие достижения</th>
                        <th>Форма поощрения</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($student->achievements as $achievement)
                        <tr>
                            <td>{{ $achievement->date }}</td>
                            <td>{{ $achievement->reason }}</td>
                            <td>{{ $achievement->encouragement }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            16. Факты ассоциального поведения учащегося
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Дата</th>
                        <th>Характер проявления</th>
                        <th>Меры</th>
                        <th>Результат</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($student->violations as $violation)
                        <tr>
                            <td>{{ $violation->date }}</td>
                            <td>{{ $violation->actions }}</td>
                            <td>{{ $violation->measures }}</td>
                            <td>{{ $violation->result }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
