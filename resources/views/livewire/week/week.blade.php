<div style="">
    <div class="login-form">
        <form wire:submit.prevent='{{ $method }}'>
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
                <div class="form-group">
                    <label for="week_index">الأسبوع</label>
                    <input type="text" wire:model.lazy='week_index' id="week_index" class="form-control" placeholder="الإسبوع">
                    @error('week_index') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                <div class="form-group">
                    <label for="start_date">بداية الأسبوع</label>
                    <div class="input-group date">
                        <input type="text" class="form-control" id="start_date" wire:model='start_date' placeholder="بداية الأسبوع">
                    </div>
                    {{-- <input type="date" id="datepicker" class="form-control" wire:model.lazy='start_date' placeholder="بداية الأسبوع"> --}}
                    @error('start_date') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>

                @if($method != "add")
                    <button type="submit" class="btn btn-primary d-block m-auto">حفظ التغييرات</button>
                @else
                    <button type="submit" class="btn btn-primary d-block m-auto">إضافة</button>
                @endif
        </form>
    </div>
</div>

@push('js')
<script>
    document.addEventListener('livewire:load', function () {
        $('#start_date').datepicker({
            format: 'yyyy-mm-dd', // Date format you prefer
            autoclose: true
        }).on('changeDate', function (e) {
            @this.set('start_date', e.target.value);
        });
    });
</script>

@endpush
