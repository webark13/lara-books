@component('mail::message')
# Book Return

Book has been Returned successfully.

@component('mail::button', ['url' => 'http://localhost:8000'])
Visit Site
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent