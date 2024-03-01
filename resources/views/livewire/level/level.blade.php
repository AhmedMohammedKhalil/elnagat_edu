<div style="">
    <div class="login-form">
        <form wire:submit.prevent='add'>
            @if (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
                
                <div class="form-group">
                    <label class="department_id"> المرحلة التعليمية</label>
                    <select class="form-control" wire:model.lazy='name' id="name" >
                    @foreach ($stages as  $stage)
                            <option value="{{$stage}}" @if($name == $stage) selected @endif>{{$stage}}</option>
                    @endforeach
                    </select>
                    @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                </div>
                    <button type="submit" class="btn btn-primary d-block m-auto">إضافة</button>
        </form>
    </div>
</div>
