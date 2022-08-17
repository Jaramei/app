<?php

return [

    'layout'=>[

        'profile'=>'Profil użytkownika',
        'support'=>'Potrzebujesz pomocy?',
        'goToWeb'=>'Strona WWW',
        'info'=>'Informacja',
        'last_updated'=>'Ostatnia aktualizacja',
        'user'=>'Użytkownik',

    ],

    'header'=>[
        'description'=>[

            'users'=>'Moduł do zarządzania użytkownikami w systemie',
            'packages'=>'Zarządzanie modułami w systemie',
            'languages'=>'Zarządzanie wersjami językowymi w systemie'

            ]

        ],

    'modules'=>[
        'roles'=>[
            'description'=>'Dodaj rolę użytkownika w systemie.'
        ],
        'packages'=>[
            'list'=>'Lista modułów',
            'translations'=>'Tłumaczenia',
            'form'=>['add'=>'Dodawanie nowego modułu',
                     'edit'=>'Edytowanie modułu',
                     'description'=>'Wygenerować nowe pliki?'],
        'create-files'=>['title'=>'Generowanie plików',
                       'description'=>'Generowanie nowych plików modułu na serwerze']
        ],
        'metadata'=>[
                      'title'=>'Metadata',
                      'description'=>'Metadane są bardzo ważnym elementem przy pozycjnowaniu witryny przez wyszukiwarki. Zalecamy uzupełnić poniższe pola prawidłowo dobranymi słowami opisującymi charakterystykę podstrony.'

        ],
        'languages'=>[
            'list'=>'Lista dostępnych języków na witrynie',
            'form'=>[
                'add'=>'Dodaj nowy język'
            ]
        ]

        ],

    'menu'=>['users'=>'Użytkownicy',
             'roles'=>'Role',
             'packages'=>'Moduły',
             'languages'=>'Wersje językowe'],

    'fields'=>[

            'name'=>'Nazwa',
            'e-mail'=>'E-mail',
            'slug'=>'Skrót',
            'role'=>'Roles',
            'active'=>'Aktywny',
            'provider'=>'Provider',
            'status'=>'Status',
            'version'=>'Wersja',
            'metadata-title'=>'Tytuł strony',
            'description'=>'Opis',
            'keywords'=>'Słowa kluczowe',
            'action'=>'akcja',
            'lang'=>'Język'


    ],

    'buttons'=>[

        'active'=>'Aktywny',
        'deactivate'=>'Nieaktywny',
        'add'=>'dodaj',
        'edit'=>'edytuj',
        'delete'=>'usuń'

    ],

    'search'=>['products'=>'Szukaj produktu w katalogu']

];