<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="form-errors"></div>
            <div class="card">
                <div class="card-header">Oblicz swoje BMI</div>

                <div class="card-body">
                    <form data-alert="form-errors" method="POST" action="{{ route('api.history.addToHistory') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="male"
                                   class="col-md-4 col-form-label text-md-right">Wybierz płeć:</label>

                            <div class="col-md-6">
                                {!! Form::select('male',[0=>"Mężczyzna",1=>'Kobieta'],null,['class'=>'form-control']) !!}


                            </div>
                        </div>
                        <div class="form-group row">
                            {!!  Form::label('age','Podaj wiek',['min'=>10,'max'=>100,'class'=>'col-md-4 col-form-label text-md-right'])!!}
                            <div class="col-md-6">
                                {!! Form::number('age',21,['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <div class="form-group row">
                            {!!  Form::label('weight','Podaj wagę',['class'=>'col-md-4 col-form-label text-md-right'])!!}
                            <div class="col-md-6">
                                {!! Form::number('weight',null,['min'=>10,'max'=>600,'class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group row">
                            {!!  Form::label('height','Podaj wzrost',['class'=>'col-md-4 col-form-label text-md-right'])!!}


                            <div class="col-md-6">
                                {!! Form::number('height',null,['min'=>60,'max'=>272,'class'=>'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Oblicz
                                </button>
                            </div>
                        </div>
                    </form>

                    <script>
                        const error = ({alert, message}) => `                   <div class="alert ${alert}" role="alert">
 ${message}
</div>`;
                        $(document).on('submit', 'form', function (e) {
                            e.preventDefault();
                            e.stopImmediatePropagation();
                            let form = $(this);

                            $.ajax({
                                url: form.attr('action'),
                                type: form.attr('method'),
                                global: false,
                                cache: false,
                                contentType: false,
                                processData: false,
                                data: new FormData(form[0]),
                                success: function (data) {
                                    $('#form-errors').append(error({alert:'alert-success',message:'Twoje bmi wynosi: '+data.data.bmi}))
                                    $('#form-errors').append('<img src="https://www.bmi-kalkulator.pl/bmi_grafiki/tabela_bmi.png">')
                                },
                                error: function (data) {
                                    form.data('error') ? errors({'error': form.data('error')}, $("#" + form.data('alert'))) : errors(data, $("#" + form.data('alert')));
                                }
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
