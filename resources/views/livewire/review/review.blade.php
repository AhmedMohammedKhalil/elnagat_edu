@push('css')
    <style>


        .review .row{
            justify-content: center;
            align-items: center
        }
        /* @media (min-width: 576px){
            .review .col-sm-12 {
                flex: 0 0 auto;
                width: 90.999% !important;
            }
        } */
        @media (min-width: 768px){
            .review .col-lg-7 {
                flex: 0 0 auto;
                width: 55.55556% !important;
            }

            .review .col-lg-3 {
                flex: 0 0 auto;
                width: 22.22223% !important;
            }
        }




    </style>
@endpush

<div style="">
    <div class="login-form">
        <form wire:submit.prevent='{{ $method }}'>
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="date">تاريخ اليوم</label>
                        <input readonly id="date" type="text" class="form-control" value="{!! \Carbon\Carbon::parse($date)->translatedFormat("l Y-m-d") !!}">
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="school">المدرسة</label>
                        <input readonly id="school" type="text" class="form-control" value="{{ $school->name }}">
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="department_id">القسم</label>
                        <select class="form-control" wire:model='department_id' id="department_id" @if($method != 'add') disabled @endif>
                            @if($method == 'add')
                            <option value="0" selected>اختر القسم</option>
                            @endif
                            @if($departments)
                            @foreach ($departments as $department)
                                @if(count($department->teachers) > 0)
                                <option value="{{ $department->id }}" @if($department_id == $department->id) selected @endif>{{ $department->name }}</option>
                                @endif
                            @endforeach
                            @endif
                        </select>
                        @error('department_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="teacher_id"></label>المعلم</label>
                        <select class="form-control" wire:model='teacher_id' id="teacher_id" @if($method != 'add') disabled @endif>
                            @if($method == 'add')
                            <option value="0" selected>اختر المعلم</option>
                            @endif
                            @if($teachers)
                            @foreach ($teachers as $teacher)
                                @if(count($teacher->levels) > 0)
                                <option value="{{ $teacher->id }}" @if($teacher_id == $teacher->id) selected @endif>{{ $teacher->name }}</option>
                                @endif
                            @endforeach
                            @endif
                        </select>
                        @error('teacher_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="level_id"></label>المرحلة التعليمية</label>
                        <select class="form-control" wire:model='level_id' id="level_id" @if($method != 'add') disabled @endif>
                            @if($method == 'add')
                            <option value="0" selected>اختر المرحلة التعليمية</option>
                            @endif
                            @if($levels)
                            @foreach ($levels as $level)
                                @if(count($level->classrooms) > 0)
                                <option value="{{ $level->id }}" @if($level_id == $level->id) selected @endif>{{ $level->name }}</option>
                                @endif
                            @endforeach
                            @endif
                        </select>
                        @error('level_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label class="classroom_id"></label>الصف الدراسى</label>
                        <select class="form-control" wire:model='classroom_id' id="classroom_id" @if($method != 'add') disabled @endif>
                            @if($method == 'add')
                            <option value="0" selected>اختر الصف الدراسى</option>
                            @endif

                            @if($classrooms)
                            @foreach ($classrooms as $classroom)
                                <option value="{{ $classroom->id }}" @if($classroom_id == $classroom->id) selected @endif>{{ $classroom->name }}</option>
                            @endforeach
                            @endif
                        </select>
                        @error('classroom_id') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </div>

                <hr class="mx-auto" style="width:90%;opacity: 1;border:3px solid #044c71;border:3px solid #044c71">

                <div class="col-md-3 col-sm-12">
                    <div class="form-group">
                        <label for="week">الاٍسبوع</label>
                        <input readonly id="week" type="text" class="form-control" value="{{ $week->week_index }}" >
                    </div>
                </div>

                <div class="col-md-9 col-sm-12">
                    <div class="form-group">
                        <label for="week_date">التاريخ</label>
                        <input readonly id="week_date" type="text" class="form-control" value="{!! \Carbon\Carbon::parse($week->start_date)->translatedFormat("l Y-m-d")."   -   ".\Carbon\Carbon::parse($week->end_date)->translatedFormat("l Y-m-d") !!}" >
                    </div>
                </div>

                <div class="mx-auto" style="width:90%;background: #4eaf52;color:#044c71;text-align:center;vertical_aline:middle">
                    <h3 style="height:70px;padding-top:30px"> بنود المتابعة </h3>
                </div>

                <div class="col-sm-12 pt-5"></div>

                <div class="col-md-12 col-sm-12 review">
                    <div class="form-group row">
                        <label class="col-lg-3  col-sm-12" for="tasks">الواجبات المرفوعة</label>
                        <input id="tasks" type="number" style="width: 90%" class="form-control col-lg-7  col-sm-12" wire:model:tasks>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 review">
                    <div class="form-group row">
                        <label class="col-lg-3 col-sm-12" for="lessons">الدروس المحضرة</label>
                        <input id="lessons" type="number" style="width: 90%" class="form-control col-lg-7 col-sm-12" wire:model:lessons>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 review">
                    <div class="form-group row">
                        <label class="col-lg-3 col-sm-12" for="weekly_plan">الخطة الأسبوعية</label>
                        <input id="weekly_plan" type="number" style="width: 90%" class="form-control col-lg-7 col-sm-12" wire:model:weekly_plan>
                    </div>
                </div>



                {{-- <div class="col-sm-12 mx-auto row justify-content-center">
                    <div class="col-sm-3 mx-1 m-1" style="border-radius:20px; background:#044c71; color:white;text-align:center;vertical_aline:middle">
                        <h3 style="color:white !important;height:50px;padding-top:15px">م</h3>
                    </div>
                    <div class="col-sm-5 mx-2 m-1" style="border-radius:20px;background:#044c71; color:white;text-align:center;vertical_aline:middle ">
                        <h3  style="color:white !important;height:50px;padding-top:15px">أسم البند</h3>
                    </div>
                    <div class="col-sm-3 mx-1 m-1" style="border-radius:20px;background:#044c71; color:white;text-align:center;vertical_aline:middle ">
                        <h3 style="color:white !important;height:50px;padding-top:15px">العدد</h3>
                    </div>
                </div>

                <div class="col-sm-12 mx-auto row justify-content-center">
                    <div class="col-sm-3 mx-1 m-1" style="border-radius:20px;text-align:center;vertical_aline:middle">
                        <h2 style="height:50px;padding-top:15px">1</h2>
                    </div>
                    <div class="col-sm-5 mx-2 m-1" style="border-radius:20px;text-align:center;vertical_aline:middle ">
                        <h2  style="height:50px;padding-top:15px">الوجبات المرفوعة</h2>
                    </div>
                    <div class="col-sm-3 mx-1 m-1" style="border-radius:20px;text-align:center;vertical_aline:middle ">
                        <div class="form-group " style="height:50px;padding-top:15px">
                            <input  id="tasks" min="0"
                             class="form-control mx-auto text-center" wire:model="tasks">
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 mx-auto row justify-content-center">
                    <div class="col-sm-3 mx-1 m-1" style="border-radius:20px;text-align:center;vertical_aline:middle">
                        <h2 style="height:50px;padding-top:15px">2</h2>
                    </div>
                    <div class="col-sm-5 mx-2 m-1" style="border-radius:20px;text-align:center;vertical_aline:middle ">
                        <h2  style="height:50px;padding-top:15px">الدروس المحضرة</h2>
                    </div>
                    <div class="col-sm-3 mx-1 m-1" style="border-radius:20px;text-align:center;vertical_aline:middle ">
                        <div class="form-group" style="height:50px;padding-top:15px">
                            <input id="lessons" min="0"  class="form-control mx-auto  text-center" wire:model="lessons">
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 mx-auto row justify-content-center">
                    <div class="col-sm-3 mx-1 m-1" style="border-radius:20px;text-align:center;vertical_aline:middle">
                        <h2 style="height:50px;padding-top:15px">3</h2>
                    </div>
                    <div class="col-sm-5 mx-2 m-1" style="border-radius:20px;text-align:center;vertical_aline:middle ">
                        <h2  style="height:50px;padding-top:15px">الخطة الأسبوعية</h2>
                    </div>
                    <div class="col-sm-3 mx-1 m-1" style="border-radius:20px;text-align:center;vertical_aline:middle ">
                        <div class="form-group text-center" class="form-group text-center" style="height:50px;padding-top:15px">
                            <input id="weekly_plan" min="0"  class="form-control mx-auto  text-center" wire:model="weekly_plan">
                        </div>
                    </div>
                </div>


                <div class="col-sm-12 mx-auto row justify-content-center">
                    <div class="col-sm-8 mx-2 m-1" style="border-radius:20px; background:#044c71; color:white;text-align:center;vertical_aline:middle">
                        <h3 style="color:white !important;height:50px;padding-top:15px">الأجمالى</h3>
                    </div>
                    <div class="col-sm-3 mx-1 m-1" style="border-radius:20px;text-align:center;vertical_aline:middle ">
                        <div class="form-group text-center" style="height:50px;padding-top:15px">
                            <input id="result" min="0"  class="form-control mx-auto  text-center" wire:model="result">
                        </div>
                    </div>
                </div> --}}

                <div class="mx-auto" style="width:90%;background: #4eaf52;color:#044c71;text-align:center;vertical_aline:middle">
                    <h3 style="height:70px;padding-top:30px"> الملاحظات </h3>
                </div>
                <div class="col-sm-12 pt-5"></div>

                <div class="col-md-12 col-sm-12">
                    <div class="form-group">
                        <label for="notes">فى حالة وجود مشاكل تواجهك  أثناء الأسبوع يرجى إضافتها</label>
                        <textarea name="notes" id="notes" placeholder="اكتب ملاحظاتك هنا" class="form-control" wire:model.lazy="notes" cols="30" rows="6">
                            {{ $notes }}
                        </textarea>
                    </div>
                </div>

                <div class="col-md-8 col-sm-8 m-auto">
                @if($method != "add")
                    <button type="submit" class="btn btn-primary d-block w-100">حفظ التغييرات</button>
                @else
                    <button type="submit" class="btn btn-primary d-block w-100">إرسال</button>
                @endif
                </div>
            </div>
        </form>
    </div>
</div>

