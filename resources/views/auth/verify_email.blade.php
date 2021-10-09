@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="form-errors"></div>

                <script>
                    const error = ({alert, message}) => `                   <div class="alert ${alert}" role="alert">
 ${message}
</div>`;
                    $.ajax({
                        url: '{{route('api.auth.verifyEmail',['token'=>request()->token])}}',
                        type: 'GET',
                        data: null,
                        cache: false,
                        success: function (data) {
                            console.log(data);
                            $('#form-errors').prepend(error({
                                'alert': 'alert-success',
                                'message': data.data
                            }));
                        },
                        error: function (jqXHR, textStatus, errorThrown) {
                            console.log(jqXHR.responseJSON.error);
                            $('#form-errors').prepend(error({
                                'alert': 'alert-danger',
                                'message': jqXHR.responseJSON.error
                            }));
                        }
                    });
                </script>
            </div>
        </div>
    </div>
@endsection
