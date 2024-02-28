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
                    <label for="email">البريد الإلكترونى</label>
                    <input type="email" wire:model.lazy='email' id="email" class="form-control" placeholder="البريد الإلكترونى">
                    @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label class="form-label">النوع</label>
                    <select class="form-control" wire:model.lazy='gender' id="gender">
                        <option value="ذكر" @if($gender == 'ذكر') selected @endif>ذكر</option>
                        <option value="أنثى" @if($gender == 'أنثى') selected @endif>أنثى</option>
                    </select>
                    @error('gender') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="password">كلمة المرور</label>
                    <input type="password" wire:model.lazy='password' id="password" class="form-control" placeholder="كلمة المرور">
                    @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="confirm_password">أعد كلمة المرور</label>
                    <input type="password" wire:model.lazy='confirm_password' id="confirm_password" class="form-control" placeholder="أعد كلمة المرور">
                    @error('confirm_password') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                @if($method != "addSubAdmin" && $method != "addOfficial")
                    <button type="submit" class="btn btn-primary d-block m-auto">حفظ التغييرات</button>
                @else
                    <button type="submit" class="btn btn-primary d-block m-auto">إضافة</button>
                @endif
        </form>
    </div>
</div>
