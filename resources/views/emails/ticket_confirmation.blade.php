Dear {{$user->fullname()}}, 
<br>
<br>
You ticket order at triponbus.com has been comfirmed.
<br>
Here is the link to your invoice.
<a href="{{ $link = route('tickets.invoice', $transaction->id) }}"> {{ $link }} </a>
<br>
Thank you
<br>
TriponBus
