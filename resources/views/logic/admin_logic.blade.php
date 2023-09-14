
@guest





@else
        @if(!Auth::user()->profile->profileable_type === 'Admin')
            
            
            
        @elseif(Auth::user()->profile->profileable_type === 'Admin')

            
            <li><a class="nav-link" href="/courses">Courses</a></li>


            <li><a class="nav-link" href="{{ url('courses/create') }}">Register Courses</a></li>

        @else

        @endif
@endguest