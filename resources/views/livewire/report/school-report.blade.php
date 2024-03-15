<div style="">
    <div class="login-form">
        <form wire:submit.prevent='getreport'>
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

                <div class="form-group">
                    <label class="school_id">المدرسة</label>
                    <select class="form-control" wire:model.lazy='school_id' id="school_id">
                        <option value="0">اختر المدرسة</option>
                        @foreach ($schools as $school)
                            <option value="{{ $school->id }}">{{ $school->name }}</option>
                        @endforeach
                    </select>
                    @error('school_id') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                <div class="form-group">
                    <label class="week_id">الأسبوع</label>
                    <select class="form-control" wire:model.lazy='week_id' id="week_id">
                        <option value="0" selected>اختر الأسبوع</option>
                        @foreach ($weeks as $week)
                        <option value="{{ $week->id }}">{{ $week->week_index }}</option>
                        @endforeach
                        <option value="{!! count($weeks)+1 !!}">الكل</option>
                    </select>
                    @error('week_id') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                    <button type="submit" class="btn btn-primary d-block m-auto">تحرير تقرير</button>
        </form>
    </div>
</div>
