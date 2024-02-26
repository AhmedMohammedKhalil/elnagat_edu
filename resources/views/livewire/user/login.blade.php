<section class="login-area" style="min-height: calc(100vh - 167px);height:0">
    <div class="d-table" style="">
        <div class="d-table-cell">
            <div class="login-form">
                <h3>سجل الأن او <a href="{{ route('user.register') }}" class="text-decoration-underline">إنشاء حساب</a></h3>

                <form wire:submit.prevent='login'>
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <input type="email" wire:model.lazy='email' id="email" class="form-control" placeholder="الإيميل">
                        @error('email') <span class="text-danger error">{{ $message }}</span>@enderror

                    </div>

                    <div class="form-group">
                        <input type="password" wire:model.lazy='password' id="password" class="form-control" placeholder="كلمة السر">
                        @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                    <button type="submit" class="btn btn-primary">سجل الأن</button>
                </form>
            </div>
        </div>
    </div>
</section>
