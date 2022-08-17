<div class="col-12 col-md-12 col-lg-12">

@if($errors->any())

                @foreach($errors->all() as $error)
            <div id="card-alert" class="card red">
                <div class="card-content white-text">
                    <p><i class="material-icons">warning</i> {{ $error }}</p>
                </div>
            </div>
                @endforeach

@endif


        @if (\Session::has('success'))

        <div id="card-alert" class="card green">
            <div class="card-content white-text">
                <p><i class="material-icons">done</i> {!! \Session::get('success') !!}</p>
            </div>
        </div>

        @endif

    @if (\Session::has('warning'))

        <div id="card-alert" class="card red">
            <div class="card-content white-text">
                <p><i class="material-icons m-r-10">warning</i> {!! \Session::get('warning') !!}</p>
            </div>
        </div>

    @endif



        @if (\Session::has('success-file'))

        <div id="card-alert" class="card light-green">
            <div class="card-content white-text">
                <p><i class="material-icons">done</i> {!! \Session::get('success-file') !!}</p>
            </div>
        </div>

        @endif

    @if (\Session::has('success-migrations'))

        <div id="card-alert" class="card light-green">
            <div class="card-content white-text">
                <p><i class="material-icons">done</i> {!! \Session::get('success-migrations') !!}</p>
            </div>
        </div>

    @endif


</div>