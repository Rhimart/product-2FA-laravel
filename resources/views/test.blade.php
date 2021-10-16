
<div>{!! $qr !!}</div>

<form method="POST" action="/google2fa/authenticate">
    @csrf
    <input name="one_time_password" type="text">
    <button type="submit">Authenticate</button>
</form>
