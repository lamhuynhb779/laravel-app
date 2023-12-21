<form method="POST" action="/session">
    @csrf
    <label>
        <input type="text" name="name" />
    </label>
    <!-- Equivalent to... -->
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
