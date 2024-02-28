
                <form wire:submit.prevent='login'>
                    @if (session()->has('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label class="form-label" for="email">البريد الإلكترونى</label>
                        <input type="email" wire:model.lazy='email' id="email" class="form-control" placeholder="البريد الإلكترونى">
                        @error('email') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>

                    <div class="mb-4 position-relative form-group">
                        <label class="form-label" for="dlabPassword">كلمة المرور</label>
                        <input type="password" wire:model.lazy='password' id="dlabPassword" class="form-control" placeholder="كلمة المرور">
                        @error('password') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">سجل الأن</button>
                    </div>
                </form>
