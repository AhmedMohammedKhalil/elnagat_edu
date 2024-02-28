<div style="">
    <div class="login-form">
        <form wire:submit.prevent='{{ $method }}'>
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
                <div class="form-group">
                    <label for="name">الإسم</label>
                    <input type="text" wire:model.lazy='name' id="name" class="form-control" placeholder="الإسم">
                    @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">القسم</label>
                    <select class="form-control" wire:model.lazy='department_id' id="department_id" @if($method != 'add' && count($teacher->reviews) > 0) disabled @endif>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}" @if($department_id == $department->id) selected @endif>{{ $department->name }}</option>
                        @endforeach
                    </select>
                    @error('department_id') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                @if($method != "add")
                    <button type="submit" class="btn btn-primary d-block m-auto">حفظ التغييرات</button>
                @else
                    <button type="submit" class="btn btn-primary d-block m-auto">إضافة</button>
                @endif
        </form>
    </div>
</div>
