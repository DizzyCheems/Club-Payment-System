@if(session('success'))
    <div class="alert bg-success alert-icon-left alert-arrow-left alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="la la-thumbs-o-up"></i></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>                                         
        {{ session('success') }}        
    </div>
@endif

@if(session('fail'))
    <div class="alert bg-danger alert-icon-left alert-arrow-left alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="la la-warning"></i></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>                                         
        {{ session('fail') }}        
        {{ session('id') }}
    </div>
@endif

@if($errors && $errors->any())                
    @if($errors->first())
    <div class="alert bg-danger alert-icon-left alert-arrow-left alert-dismissible mb-2" role="alert">
        <span class="alert-icon"><i class="la la-warning"></i></span>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>                                         
        {{ $errors->first() }}        
    </div>
    @endif
@endif