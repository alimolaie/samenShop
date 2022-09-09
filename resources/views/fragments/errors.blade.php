<!-- /resources/views/post/create.blade.php -->



@if ($errors->any())
    <div class="alert alert-danger mt-0 message">
        <button type="button" class="close" data-dismiss="alert" aria-label="بستن">
            <span aria-hidden="true">&times;</span>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Create Post Form -->
