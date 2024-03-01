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
                    <label for="owner">رئيس القسم</label>
                    <input type="text" wire:model.lazy='owner' id="owner" class="form-control" placeholder="رئيس القسم">
                    @error('owner') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                @if($method != "add")
                    <button type="submit" class="btn btn-primary d-block m-auto">حفظ التغييرات</button>
                @else
                    <button type="submit" class="btn btn-primary d-block m-auto">إضافة</button>
                @endif
        </form>
    </div>
</div>
