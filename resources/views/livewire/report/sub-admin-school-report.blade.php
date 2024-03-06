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
                    <button type="submit" class="btn btn-primary d-block m-auto">تحرير تقرير</button>
        </form>
    </div>
</div>
