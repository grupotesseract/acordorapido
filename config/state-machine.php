<?php

return [
    'graphA' => [
        // class of your domain object
        'class' => App\Titulo::class,

        // name of the graph (default is "default")
        'graph' => 'cores',

        // property of your object holding the actual state (default is "state")
        'property_path' => 'estado',

        // list of all possible states
        'states' => [
            'azul',
            'verde',
            'amarelo',
            'vermelho',
            'cinza'
        ],

        // list of all possible transitions
        'transitions' => [
            'fica_verde' => [
                'from' => ['azul'],
                'to' => 'verde',
            ],
            'fica_amarelo' => [
                'from' =>  ['verde'],
                'to' => 'amarelo',
            ],
            'fica_vermelho' => [
                'from' => ['amarelo'],
                'to' => 'vermelho',
            ],
            'fica_cinza' => [
                'from' => ['azul', 'verde', 'amarelo', 'vermelho'],
                'to' =>  'cinza',
            ],
        ],

        // list of all callbacks
        'callbacks' => [
            // will be called when testing a transition
            'guard' => [
            ],

            // will be called before applying a transition
            'before' => [],

            // will be called after applying a transition
            'after' => [
                'mudou_para_verde' => [
                    // call the callback on a specific transition
                    'on' => 'fica_verde',
                    // will call the method of this class
                    'do' => ['App\Titulo', 'ficaVerde'],
                    // arguments for the callback
                    'args' => ['object'],
                ],
            ],
        ],
    ],
];
