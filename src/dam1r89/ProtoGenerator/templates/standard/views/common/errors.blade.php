@if (!$errors->isEmpty())
<div class="alert alert-danger" role="alert">
    @foreach ($errors->getMessages() as $message)
    {{ implode($message, ',') }} <br/>
    @endforeach
</div>
@endif
