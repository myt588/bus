Dear {{$user->fullname()}}, 
<br>
<br>
You rent inquery at triponbus.com has been received. An operator will contact you shortly. 
<br>
Here is the link to your confirmation page.
<a href="{{ $link = route('rentals.thankyou', $rent->id) }}"> {{ $link }} </a>
<br>
Thank you
<br>
TriponBus
