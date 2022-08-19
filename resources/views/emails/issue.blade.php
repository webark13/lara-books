@component('mail::message')
# Book Issue

Book has been issed to you successfully.

@component('mail::button', ['url' => 'http://localhost:8000'])
Visit Site
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
