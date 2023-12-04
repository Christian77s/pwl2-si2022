@component('mail::massage')
# Your Transaction Has Been Confirmed

Hi{{$checkout->user->name}}
<br>Your Transaction has been Confirmed,
now you can enjoy the benefits of <b>{{$checkout->camp->title}}</b>

@component('mail::button', ['url' => route('user.dashboard')])
My Dashboard 
@endcomponent

Thanks, <br>
{{ config('app.name') }}
@endcomponent
<!-- <x-mail::message>
# Introduction

The body of your message.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message> -->
