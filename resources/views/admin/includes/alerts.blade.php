<!-- alerts -->
<div class="row content-section">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show col-lg-10 offset-lg-1" role="alert">
            <strong>{{ session('success') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show col-lg-10 offset-lg-1" role="alert">
            <strong>{{ session('error') }}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
</div>
