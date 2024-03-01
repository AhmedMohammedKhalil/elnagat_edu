<div class="dlabnav" style="top:7rem">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">القائمة الرئيسية</li>

            @if(auth()->user()->role != 'sub_admin')
            @if(auth()->user()->role == 'admin')
            <li>
                <a class="ai-icon" href="{{ route('dashboard') }}" aria-expanded="false">
                    <i class="la la-home"></i>
                    <span class="nav-text">لوحة التحكم</span>
                </a>
            </li>
            <li><a class="ai-icon" href="{{ route('officials.index') }}" aria-expanded="false">
                    <i class="la la-users"></i>
                    <span class="nav-text">فريق التشغيل</span>
                </a>
            </li>

             <li><a class="ai-icon" href="#" aria-expanded="false">
                    <i class="la la-users"></i>
                    <span class="nav-text"> الاسبوع</span>
                </a>
            </li>
            @else
            {{-- <li><a class="ai-icon" href="{{ route('sub_admins.index') }}" aria-expanded="false">
                    <i class="la la-user"></i>
                    <span class="nav-text">المدراء المساعدين</span>
                </a>
            </li> --}}
                <li><a class="ai-icon" href="{{ route('schools.index') }}" aria-expanded="false">
                        <i class="la la-school"></i>
                        <span class="nav-text">المدارس</span>
                    </a>
                </li>
                <li><a class="ai-icon" href="{{ route('departments.index') }}" aria-expanded="false">
                        <i class="la la-building"></i>
                        <span class="nav-text">الأقسام</span>
                    </a>
                </li>
                <li><a class="ai-icon" href="{{ route('teachers.index') }}" aria-expanded="false">
                        <i class="la la-users"></i>
                        <span class="nav-text">المعلمين</span>
                    </a>
                </li>

                {{-- <li><a class="ai-icon" href="{{ route('levels.index') }}" aria-expanded="false">
                        <i class="la la-building"></i>
                        <span class="nav-text">المستويات</span>
                    </a>
                </li>

                <li><a class="ai-icon" href="#" aria-expanded="false">
                        <i class="la la-building"></i>
                        <span class="nav-text">الفصول</span>
                    </a>
                </li> --}}

                
            @endif
            @else
                <li><a class="ai-icon" href="{{ route('') }}" aria-expanded="false">
                        <i class="la la-users"></i>
                        <span class="nav-text">التقييمات</span>
                    </a>
                </li>
            @endif
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="la la-id-card-alt"></i>
                    <span class="nav-text">البيانات الشخصية</span>
                </a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('profile') }}">البروفايل</a></li>
                    <li><a href="{{ route('settings') }}">تعديل البروفايل</a></li>
                    <li><a href="{{ route('changePassword') }}">تغيير كلمة السر</a></li>
                </ul>
            </li>
            <li><a class="ai-icon" href="{{ route('logout') }}" aria-expanded="false">
                    <i class="la la-sign-out-alt"></i>
                    <span class="nav-text">خروج</span>
                </a>
            </li>

        </ul>
    </div>
</div>
