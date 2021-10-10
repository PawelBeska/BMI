<div class="container">

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                      Twoje wyniki
                    </div>
                    <div class="card-body">
                        <div class="table-responsive p-t-10">
                            <table id="" class="table" style="width:100%">
                                <thead>
                                <tr>
                                    <th>Waga</th>
                                    <th>Wzrost</th>
                                    <th>Bmi</th>
                                    <th>Zarządzaj</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <script>
                                $(document).ready(function () {
                                    window.datatable = $('.table').DataTable({
                                        "language":   { {!!  __('messages.movies.datatable.json')!!}
                                        },
                                        createdRow: function (row, data) {
                                            $(row).find('.remove').attr('href', '/api/historia/' + data.id)
                                        },
                                        columns: [
                                            {data: 'weight', "sClass": 'weight'},
                                            {data: 'height', "sClass": 'height'},
                                            {data: 'bmi', "sClass": 'bmi'},
                                            {
                                                name: "buttons",
                                                "targets": -1,
                                                "data": null,
                                                "defaultContent": `<div class="btn-group" role="group">

                                                <a class="dropdown-item remove" href="#"> Usuń</a>

                                        </div>`
                                            }
                                        ],
                                        "autoWidth": true,
                                        'responsive': true,
                                        "processing": true,
                                        "serverSide": true,
                                        oLanguage: {
                                            sProcessing: `<div class="lime-body">    <div class="container">        <div class="row" style="  position: absolute;  top: 50%;  left: 50%;  transform: translate(-50%, -50%);">            <div class="col-md-8">                <div class="spinner-border" style="color: #00bc8c;" le="status">                    <span class="sr-only">Loading...</span>                </div>            </div>        </div>    </div></div>`
                                        },
                                        rowId: 'id',
                                        ajax: {
                                            "url": "{{Route('api.history.getData')}}",
                                            "type": "POST",
                                            "global": false,
                                            "cache": false,
                                            "data": {"_token": "{{ csrf_token() }}"}
                                        }
                                    });
                                });

                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>
