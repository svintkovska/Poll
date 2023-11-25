@php
    /**
     * @var $user \App\Models\User
     */
    $user = \Illuminate\Support\Facades\Auth::user();

    $languages = [
        'en' => "EN",
        'uk' => "UA",
];
$appLocale = app()->getLocale();
@endphp

<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <a class="navbar-brand text-light" href="{{ route('poll.index') }}" >{{__('site.poll.poll')}}</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link text-light" href="{{ route('questions.index') }}" >{{__('site.question.my_questions')}} <span class="sr-only">(current)</span></a>
            </li>
        </ul>

        <ul class="navbar-nav">
            @guest
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('login') }}">{{__('site.action.login')}}</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light" href="{{ route('register') }}">{{__('site.action.register')}}</a>
            </li>
            @endguest

            @auth
            <li class="nav-item">
                <span class="nav-link text-info">{{ $user->email }}</span>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="btn btn-link nav-link text-light" type="submit">{{__('site.action.logout')}}</button>
                </form>
            </li>
            @endauth
            <li class="nav-item ">
                 <img id="languageImage" src="{{ asset('images/' . $appLocale . '.jpg') }}"  style="margin-left: 50px; margin-top:5px; width: 40px; height: 30px; object-fit: cover;">
            </li>
            <li class="nav-item row" style="margin-left: 10px; margin-right:10px;">
                <select class="language-change" aria-label="Language" style="background: none;  border: 1px solid blue;
                                                                                                border-radius: 10px;
                                                                                                color: blue;
                                                                                                width: 50px;
                                                                                                height: 40px;
                                                                                                padding: 1px 3px;">
                @foreach($languages as $key=>$language)
                    <option {{$appLocale === $key ? 'selected' : null}} value="{{$key}}">{{$language}}</option>
                    @endforeach
                </select>
            </li>
        </ul>
    </div>
</nav>




@push('scripts')
<script>
    $('.language-change').on('change', (e)=>{
        let selected = $(e.target).val();
                console.log(selected);
        $('#languageImage').attr('src', `/images/${selected}.jpg`);

        console.log(`/change-language/${selected}`);

        fetch(`/change-language/${selected}`)
        .then(r=>r.json())
        .then(data=> {
            if(data.ok && data.language !== '{{$appLocale}}'){
                window.location.reload()
            }
        })
    })
    
</script>
@endpush
