@component('mail::layout')
    {{-- Header --}}
    @slot('header')
        @component('mail::header', ['url' => config('app.url')])
            PRINCEAK BLOG
        @endcomponent
    @endslot

{{-- Body --}}
    <p>You are receiving this message because you want to reset/chnge your password.
    <br/>
	Click on the Link Below to change your password

	@component('mail::button', ['url' => config('app.url')."admin/change_password/{$token->token}"])
	CHANGE PASSWORD
	@endcomponent

	THIS LINK CAN ONLY BE USED ONCE
	</p>

{{-- Footer --}}
    @slot('footer')
        @component('mail::footer')
            © {{ date('Y') }} PRINCEAK.
        @endcomponent
    @endslot
@endcomponent