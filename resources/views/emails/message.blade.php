@component('mail::message')
# Blood Response
## Hello I'm {{$sender->name}}
### My phone number : {{$sender->phone}}

{{ $chat->body }}

* you want to give me the blood, please call me.
@component('mail::button', ['url' => $url])
Accept request
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent