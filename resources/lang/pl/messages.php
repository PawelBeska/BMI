<?php

return [

    'menu' => [
        'login'=>'Logowanie',
        'register'=>'Rejestracja',
        'movies' => "Filmy",
        'home' => 'Strona główna',
        'employees' => 'Pracownicy',
        'about' => "O mnie",
        'logout'=>'Wyloguj',
        'posts'=>"Posty",
        'blog'=>"Blog",
    ],
    'elements' => [
        'buttons' => [
            'close' => 'Zamknij',
            'edit' => 'Edytuj',
            'quickEdit' => 'Szybka edycja',
            'remove' => 'Usuń',
            'add' => 'Stwórz',
            'select' => 'Wybierz',
            'show' => 'Podgląd',
        ]
    ],
    'logout' => [
        'success' => "Pomyślnie wylogowano",
    ],
    'register' => [
        'success' => "Pomyślnie zarejestrowano",
    ],
    'login' => [
        'success' => "Pomyślnie zalogowano",
        'needs_email_confirmation' => 'Wymagane potwierdzenie adresu email',
        'error'=>"Błąd podczas logowania: podano nieprawidłowy login lub hasło"
    ],
    'forgot_password' => [
        'success'=>"Link do resetowania hasła został wysłany na podany adres email",
        'error'=>"Błąd podczas resetowania hasła"
    ],
    'register_activate'=>[
        'success' =>'Pomyślnie aktywowano konto',
        'error'=>"Wystąpił błąd podczas aktywacji konta"
    ],
    'password_reset'=>[
        'success' =>'Pomyślnie zmieniono hasło',
        'error'=>"Błąd podczas zmieniania hasła"
    ],
    'index' => [
        'card' => [

            'title' => 'COVID',
            'content' => 'Pandemia COVID-19 – pandemia zakaźnej choroby COVID-19 wywoływanej przez koronawirusa SARS-CoV-2. Rozpoczęła się jako epidemia 17 listopada 2019 w mieście Wuhan, w prowincji Hubei, w środkowych Chinach, a 11 marca 2020 została uznana przez Światową Organizację Zdrowia (WHO) za pandemię. W okresie od listopada 2019 do stycznia 2020 zachorowania pojawiały się głównie w mieście Wuhan, w środkowych Chinach, ale już w połowie stycznia wirus rozprzestrzenił się w całych Chinach. W drugiej połowie lutego ogniska zakażeń z setkami chorych wybuchły w Korei Południowej, we Włoszech oraz w Iranie. Od 4 marca 2020 są notowane zakażenia wirusem SARS-CoV-2 w Polsce. 13 marca 2020 WHO podała, że centrum pandemii koronawirusa stała się Europa. Później zachorowania rozlały się na pozostałe kontynenty, a ostatnim, na którym stwierdzono zachorowania, stała się w grudniu 2020 Antarktyda.',
            'footer' => 'Źródło: '
        ]
    ],
    'about' => [
        'card' => [
            'title' => "O mnie",
            'content' => "Cześć, jestem Paweł! Jestem na drugim roku informatyki na wydziale WSB w chorzowie.",

        ]
    ],
    'posts' => [
        'create' => [
            'title' => "Nowy post",
            'description' => "Za pomocą tego formularza można dodawać nowe posty.",
            'fields' => [
                'title' => [
                    'label' => 'Tytuł:',
                    'placeholder' => "Wpisz tytuł"
                ],
                'description' => [
                    'label' => 'Opis:',
                    'placeholder' => 'Wpisz opis',
                ],
                'poster' => [
                    'label' => 'Okładka:',
                    'placeholder' => 'Wybierz okładkę',
                ],
            ]
        ],
        'update' => [
            'title' => "Edycja postu",
            'description' => "Za pomocą tego formularza można edytować istniejące już posty.",
            'fields' => [
                'title' => [
                    'label' => 'Tytuł:',
                    'placeholder' => "Wpisz tytuł"
                ],
                'author_id'=>[
                  'label'=>'Autor:',
                  'placeholder'=> 'Wybierz autora',
                ],
                'description' => [
                    'label' => 'Opis:',
                    'placeholder' => 'Wpisz opis',
                ],
                'poster' => [
                    'label' => 'Okładka:',
                    'placeholder' => 'Wybierz okładkę',
                ],
            ]
        ],
        'datatable' => [
            'title' => 'Posty',
            'json' => '
                                    "processing":     "Przetwarzanie...",
                                    "search":         "Szukaj:",
                                    "lengthMenu":     "Pokaż _MENU_ pozycji",
                                    "info":           "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
                                    "infoEmpty":      "Pozycji 0 z 0 dostępnych",
                                    "infoFiltered":   "(filtrowanie spośród _MAX_ dostępnych pozycji)",
                                    "loadingRecords": "Wczytywanie...",
                                    "zeroRecords":    "Nie znaleziono pasujących pozycji",
                                    "emptyTable":     "Brak danych",
                                    "paginate": {
                                        "first":      "Pierwsza",
                                        "previous":   "Poprzednia",
                                        "next":       "Następna",
                                        "last":       "Ostatnia"
                                    },
                                    "aria": {
                                        "sortAscending": ": aktywuj, by posortować kolumnę rosnąco",
                                        "sortDescending": ": aktywuj, by posortować kolumnę malejąco"
                                    }',
            'fields' => [
                'id' => 'Id',
                'title' => 'Tytuł',
                'author' => "Autor",
                'select' => 'Wybierz',
                'updated_at' => 'Data ostatniej edycji',
                'created_at' => 'Data utworzenia',
            ]

        ],
    ],
    'movies' => [
        'create' => [
            'title' => "Nowy film",
            'description' => "Za pomocą tego formularza można dodawać nowe filmy.",
            'fields' => [
                'title' => [
                    'label' => 'Tytuł: ',
                    'placeholder' => "Wpisz tytuł"
                ],
                'genre' => [
                    'label' => 'Gatunek ',
                    'placeholder' => 'Wpisz gatunek',
                ],
                'releaseDate' => [
                    'label' => 'Data wydania',
                    'placeholder' => 'Wpisz datę premiery',
                ],
                'price' => [
                    'label' => 'Cena',
                    'placeholder' => 'Wpisz cenę',
                ],
                'rating' => [
                    'label' => 'Ocena:',
                    'placeholder' => 'Wpisz ocenę',
                ]
            ]
        ],
        'update' => [
            'title' => "Edycja filmu",
            'description' => "Za pomocą tego formularza można edytować istniejące już filmy.",
            'fields' => [
                'title' => [
                    'label' => 'Tytuł: ',
                    'placeholder' => "Wpisz tytuł"
                ],
                'genre' => [
                    'label' => 'Gatunek ',
                    'placeholder' => 'Wpisz gatunek',
                ],
                'releaseDate' => [
                    'label' => 'Data wydania',
                    'placeholder' => 'Wpisz datę premiery',
                ],
                'price' => [
                    'label' => 'Cena',
                    'placeholder' => 'Wpisz cenę',
                ],
                'rating' => [
                    'label' => 'Ocena:',
                    'placeholder' => 'Wpisz ocenę',
                ]
            ]
        ],
        'datatable' => [
            'title' => 'Filmy',
            'json' => '
                                    "processing":     "Przetwarzanie...",
                                    "search":         "Szukaj:",
                                    "lengthMenu":     "Pokaż _MENU_ pozycji",
                                    "info":           "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
                                    "infoEmpty":      "Pozycji 0 z 0 dostępnych",
                                    "infoFiltered":   "(filtrowanie spośród _MAX_ dostępnych pozycji)",
                                    "loadingRecords": "Wczytywanie...",
                                    "zeroRecords":    "Nie znaleziono pasujących pozycji",
                                    "emptyTable":     "Brak danych",
                                    "paginate": {
                                        "first":      "Pierwsza",
                                        "previous":   "Poprzednia",
                                        "next":       "Następna",
                                        "last":       "Ostatnia"
                                    },
                                    "aria": {
                                        "sortAscending": ": aktywuj, by posortować kolumnę rosnąco",
                                        "sortDescending": ": aktywuj, by posortować kolumnę malejąco"
                                    }',
            'fields' => [
                'id' => 'Id',
                'title' => 'Tytuł',
                'releaseDate' => "Data premiery",
                'genre' => "Gatunek",
                'price' => 'Cena',
                'select' => 'Wybierz',
                'rating' => 'Ocena',
                'updated_at' => 'Data ostatniej edycji',
                'created_at' => 'Data utworzenia',
            ]

        ],
    ],
    'employees' => [
        'create' => [
            'title' => "Nowy pracownik",
            'description' => "Za pomocą tego formularza można dodawać nowych pracowników",
            'fields' => [
                'first_name' => [
                    'label' => 'Imie:',
                    'placeholder' => "Wpisz imie"
                ],
                'last_name' => [
                    'label' => 'Nazwisko:',
                    'placeholder' => 'Wpisz nazwisko',
                ],
                'birth_date' => [
                    'label' => 'Data urodzenia:',
                    'placeholder' => 'Wpisz datę urodzenia',
                ],
                'phone' => [
                    'label' => 'Numer telefonu:',
                    'placeholder' => 'Wpisz numer telefonu',
                ],
            ]
        ],
        'update' => [
            'title' => "Edycja pracownika",
            'description' => "Za pomocą tego formularza można edytować istniejących już pracowników.",
            'fields' => [
                'first_name' => [
                    'label' => 'Imie:',
                    'placeholder' => "Wpisz imie"
                ],
                'last_name' => [
                    'label' => 'Nazwisko:',
                    'placeholder' => 'Wpisz nazwisko',
                ],
                'birth_date' => [
                    'label' => 'Data urodzenia:',
                    'placeholder' => 'Wpisz datę urodzenia',
                ],
                'phone' => [
                    'label' => 'Numer telefonu:',
                    'placeholder' => 'Wpisz numer telefonu',
                ]
            ]
        ],
        'datatable' => [
            'title' => 'Pracownicy',
            'json' => '
                                    "processing":     "Przetwarzanie...",
                                    "search":         "Szukaj:",
                                    "lengthMenu":     "Pokaż _MENU_ pozycji",
                                    "info":           "Pozycje od _START_ do _END_ z _TOTAL_ łącznie",
                                    "infoEmpty":      "Pozycji 0 z 0 dostępnych",
                                    "infoFiltered":   "(filtrowanie spośród _MAX_ dostępnych pozycji)",
                                    "loadingRecords": "Wczytywanie...",
                                    "zeroRecords":    "Nie znaleziono pasujących pozycji",
                                    "emptyTable":     "Brak danych",
                                    "paginate": {
                                        "first":      "Pierwsza",
                                        "previous":   "Poprzednia",
                                        "next":       "Następna",
                                        "last":       "Ostatnia"
                                    },
                                    "aria": {
                                        "sortAscending": ": aktywuj, by posortować kolumnę rosnąco",
                                        "sortDescending": ": aktywuj, by posortować kolumnę malejąco"
                                    }',
            'fields' => [
                'id' => 'Id',
                'first_name' => 'Imie',
                'last_name' => 'Nazwisko',
                'birth_date' => 'Data urodzenia',
                'phone' => 'Numer telefonu',
                'select' => 'Wybierz',
                'updated_at' => 'Data ostatniej edycji',
                'created_at' => 'Data utworzenia',
            ]

        ],
    ]
];
