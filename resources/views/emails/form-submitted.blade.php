@component('mail::message')
# Form submitted email notification

below is the entire form data.

@component('mail::table')
| Field       | Data         |
| ------------- |:-------------:|
@foreach($formData as $key => $value)
| {{ $key }}     | {{ $value}}     |
@endforeach

@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
