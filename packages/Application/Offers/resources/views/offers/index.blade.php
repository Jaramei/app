@extends('core::partials.app')

@section('content')

    @include('Offers::common.header')

    @include('Offers::offers.list',['data'=>$data])

    @include('core::common.messages',['errors'=>$errors])


    {{Form::open(['files' => true])}}

        @include('Offers::offers.form',['button'=>trans('Offers::default.buttons.add'),'trans'=>'Offers::default.titles.add'])

    {{Form::close()}}


@stop

@section('after-scripts')


    <script type="text/javascript">

        $(document).ready(function () {

        $('.dd').nestable({maxDepth:2});

        $(".dd a").on("mousedown", function(event) {
            event.preventDefault();
            return false;
        });

        $(".dd a").on("click", function(event) {
            event.preventDefault();
            window.location = $(this).attr("href");
            return false;
        });


        $('.dd').on('change', function (e) {

            $.post('{{ route('offers.sort') }}', {
                sort: JSON.stringify($('.dd').nestable('serialize')),
                _token: '{{ csrf_token() }}'
            }, function (data) {
                toastr.success("Successfully updated menu order.");
            });

        });

        });

    </script>

    @stop