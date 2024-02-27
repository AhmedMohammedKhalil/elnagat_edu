<section class="login-area" style="min-height: calc(100vh - 167px);height:auto !important;padding:15px 0">
    <div class="d-table" style="">
        <div class="d-table-cell">
            <div class="login-form">
                <h3>إنشئ حساب أو <a href="{{ route('user.login') }}" class="text-decoration-underline"> سجل الان </a></h3>

                <form wire:submit.prevent='register'>
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                        <div class="form-group">
                            <input type="text" wire:model.lazy='name' id="name" class="form-control" placeholder="الإسم">
                            @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <input type="email" wire:model.lazy='email' id="email" class="form-control" placeholder="الإيميل">
                            @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <input type="text" wire:model.lazy='phone' id="phone" class="form-control" placeholder="الموبايل">
                            @error('phone') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <input type="password" wire:model.lazy='password' id="password" class="form-control" placeholder="كلمة السر">
                            @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <input type="password" wire:model.lazy='confirm_password' id="confirm_password" class="form-control" placeholder="أعد كلمة السر">
                            @error('confirm_password') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>

                        <div class="form-group">
                            <textarea name="address" class="form-control"  wire:model.lazy='address' id="address" rows="6" placeholder="العنوان"></textarea>
                            @error('address') <span class="text-danger error">{{ $message }}</span>@enderror
                        </div>
                        <button type="submit" class="btn btn-primary">حفظ التغييرات</button>
                </form>
            </div>
        </div>
    </div>
</section>

