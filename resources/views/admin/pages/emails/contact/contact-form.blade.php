@component('mail::message')
# thank your for yor message

<strong>Name: </strong> {{$data['name']}} <br/>
<strong>Phone: </strong> {{$data['phone']}}<br/>

<strong > Message: </strong>
 {{$data['message']}} <br/>

 <strong > Slug: </strong> {{$data[0]}} <br/>
@endcomponent
