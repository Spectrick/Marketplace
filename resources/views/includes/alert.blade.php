@if(session('flash.message'))
    <div class="alert alert-{{ session('flash.type') }} mb-0 rounded-0 small py-2 text-center">
        {{ session('flash.message') }}
        <div class="position-absolute top-0 end-0 mt-2 me-3">
            <button type="button" class="btn-close float-end" data-bs-dismiss="alert"></button>
        </div>
    </div>
@endif
