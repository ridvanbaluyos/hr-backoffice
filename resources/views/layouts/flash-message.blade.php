<div class="row">
    <div class="col-lg-6">
        @if (Session::has('alert-message'))
            <div class="alert alert-{{ Session::get('alert-class') }}">
                <a href="#" class="close" data-dismiss="alert"><i class="fa fa-times-circle"></i></a>
                @if (Session::get('alert-class') === 'success')
                    <i class="fa fa-check fa-2x"></i>
                @elseif (Session::get('alert-class') === 'danger')
                    <i class="fa fa-warning fa-2x"></i>
                @endif
                {{ Session::get('alert-message') }}
            </div>
        @endif
    </div>
</div>
<br/>