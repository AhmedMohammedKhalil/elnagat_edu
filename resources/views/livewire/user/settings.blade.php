    <div style="padding: 40px 0 ">
        <div class="login-form">
            <form wire:submit.prevent='edit'>
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

                    <button type="submit" class="btn btn-primary d-block m-auto">حفظ التغييرات</button>
            </form>
        </div>
    </div>

