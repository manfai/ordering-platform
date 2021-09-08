<div class="flex shadow-lg bg-base-200 rounded-2xl mb-6 justify-center mt-6 md:mt-0">
<div class="card text-center pt-8">
    <div class="avatar online m-auto">
        <div class="w-24 h-24 mask mask-squircle">
            <img src="/img/profile.png">
        </div>
    </div>
    <div class="card-body">
        <h2 class="card-title">{{auth()->user()->name}}</h2>
        <p>{{auth()->user()->email}}</p>
        <div class="justify-center card-actions p-0">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
            </form>
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="btn btn-sm btn-accent">{{__('Log Out')}}</a>
            <a class="btn btn-sm btn-accent">{{__('Edit')}}</a>
        </div>
    </div>
</div>
</div>