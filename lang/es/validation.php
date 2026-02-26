<?php

return [
    'required' => 'El campo :attribute es obligatorio.',
    'string'   => 'El campo :attribute debe ser texto.',
    'email'    => 'El campo :attribute debe ser un correo válido.',
    'max'      => [
        'string' => 'El campo :attribute no debe exceder :max caracteres.',
        'numeric'=> 'El campo :attribute no debe ser mayor a :max.',
    ],
    'min'      => [
        'numeric'=> 'El campo :attribute no debe ser menor a :min.',
    ],
    'integer'  => 'El campo :attribute debe ser un número entero.',
    'array'    => 'El campo :attribute debe ser una lista.',
    'between'  => [
        'numeric'=> 'El campo :attribute debe estar entre :min y :max.',
    ],

    // Nombres amigables de campos (esto arregla "full name")
    'attributes' => [
        'full_name' => 'nombre',
        'phone' => 'teléfono',
        'email' => 'email',
        'notes' => 'notas generales',

        'profile.base_level' => 'nivel base',
        'profile.goal_tone' => 'tono objetivo',
        'profile.brand' => 'marca / línea',
        'profile.color_code' => 'código de color',
        'profile.formula' => 'fórmula',
        'profile.developer_volume' => 'oxidante',
        'profile.ratio' => 'proporción',
        'profile.processing_time_minutes' => 'tiempo de exposición',
        'profile.technique' => 'técnica de aplicación',
        'profile.warnings' => 'advertencias',
        'profile.notes' => 'notas técnicas',
    ],
];