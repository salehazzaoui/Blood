@component('mail::message')
# Introduction

## Hello, I'm {{$sender->name}}
I accept your request,
my phone number is {{$sender->phone}}

### Your message :
{{$chat->body}}

Thanks,<br>
{{ config('app.name') }}
@endcomponent
