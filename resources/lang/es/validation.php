<?php

return [
    'error_message' => 'Datos inválidos',
    'description' => 'Hay errores en :attributes',
    'invalid_token' => 'Token Inválido',

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | following language lines contain default error messages used by
    | validator class. Some of these rules have multiple versions such
    | as size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute debe ser aceptado.',
    'active_url' => ':attribute no es una URL válida.',
    'after' => ':attribute debe ser una fecha posterior a :date.',
    'after_or_equal' => ':attribute debe ser igual o posterior a :date.',
    'alpha' => ':attribute debe contener únicamente caracteres alfabéticos.',
    'alpha_dash' => ':attribute debe contener únicamente caracteres alfanuméricos y guiones.',
    'alpha_num' => ':attribute debe contener únicamente caracteres alfanuméricos.',
    'array' => ':attribute debe ser un conjunto.',
    'before' => ':attribute debe ser un fecha anterior a :date.',
    'before_or_equal' => ':attribute debe ser un fecha anterior o igual a :date.',
    'between' => [
        'numeric' => ':attribute debe ser un número entre :min y :max.',
        'file' => ':attribute debe pesar entre :min y :max kilobytes.',
        'string' => ':attribute debe contener entre :min y :max caracteres.',
        'array' => ':attribute debe contener entre :min y :max elementos.',
    ],
    'boolean' => 'El campo :attribute debe ser un valor verdadero o falso.',
    'confirmed' => 'la confirmación de :attribute no coincide.',
    'date' => ':attribute no es una fecha válida.',
    'date_format' => ':attribute no coincide con el formato :format.',
    'different' => ':attribute y :other deben ser diferentes.',
    'digits' => ':attribute debe tener :digits digitos.',
    'digits_between' => ':attribute debe tener entre :min y :max digits.',
    'dimensions' => 'Las dimensiones de la imagen :attribute no son válidas.',
    'distinct' => 'El campo :attribute contiene un valor duplicado.',
    'email' => ':attribute no es un correo electrónico válido.',
    'exists' => ':attribute no existe.',
    'file' => ':attribute debe ser un archivo.',
    'filled' => 'El campo :attribute es obligatorio.',
    'gt' => [
        'numeric' => 'El campo :attribute debe ser mayor que :value.',
        'file' => 'El campo :attribute debe tener más de :value kilobytes.',
        'string' => 'El campo :attribute debe tener más de :value caracteres.',
        'array' => 'El campo :attribute debe tener más de :value elementos.',
    ],
    'gte' => [
        'numeric' => 'El campo :attribute debe ser igual o mayor que :value.',
        'file' => 'El campo :attribute debe pesar como mínimo :value kilobytes.',
        'string' => 'El campo :attribute debe tener como mínimo :value caracteres.',
        'array' => 'El campo :attribute debe tener como mínimo :value elementos.',
    ],
    'image' => ':attribute debe ser una imagen.',
    'in' => ':attribute es invalido.',
    'in_array' => 'El campo :attribute no existe en :other.',
    'integer' => ':attribute debe ser un número entero.',
    'ip' => ':attribute debe ser una dirección IP valida.',
    'ipv4' => ':attribute debe ser una dirección IPv4 valida.',
    'ipv6' => ':attribute debe ser una dirección IPv6 valida.',
    'json' => 'El campo :attribute debe ser una cadena de texto en formato JSON.',
    'max' => [
        'numeric' => ':attribute no debe ser mayor a :max.',
        'file' => ':attribute no debe ser mayor que :max kilobytes.',
        'string' => ':attribute no debe ser mayor que :max caracteres.',
        'array' => ':attribute no debe tener más de :max elementos.',
    ],
    'mimes' => ':attribute debe ser un archivo con formato: :values.',
    'mimetypes' => ':attribute debe tener uno de los siguientes Mimes: :values.',
    'min' => [
        'numeric' => 'El tamaño de :attribute debe ser de al menos :min.',
        'file' => 'El tamaño de :attribute debe ser de al menos :min kilobytes.',
        'string' => ':attribute debe contener al menos :min caracteres.',
        'array' => ':attribute debe tener al menos :min elementos.',
    ],
    'not_in' => ':attribute es inválido.',
    'numeric' => ':attribute debe ser numérico.',
    'not_regex' => 'El formato de :attribute no es válido',
    'not_special_keys' => 'El :attribute no acepta caracteres especiales',
    'present' => 'El campo :attribute debe estar presente.',
    'regex' => 'El formato de :attribute es inválido.',
    'required' => ':attribute es obligatorio.',
    'required_if' => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_unless' => 'El campo :attribute es obligatorio a menos que :other esté en :values.',
    'required_with' => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all' => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_without' => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de :values estén presentes.',
    'same' => ':attribute y :other deben coincidir.',
    'size' => [
        'numeric' => 'El tamaño de :attribute debe ser :size.',
        'file' => 'El tamaño de :attribute debe ser :size kilobytes.',
        'string' => ':attribute debe contener :size caracteres.',
        'array' => ':attribute debe contener :size elementos.',
    ],
    'string' => 'El campo :attribute debe ser una cadena de caracteres.',
    'timezone' => 'El :attribute debe ser una zona válida.',
    'unique' => ':attribute ya ha sido registrado.',
    'uploaded' => 'Subir :attribute ha fallado.',
    'url' => 'El formato :attribute es inválido.',
    'uuid' => 'El :attribute deber ser un UUID válido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],

        'user_id' => [
            'must_be_regular' => 'Debe ser rol Regular',
            'already_assigned' => 'Ya asignado a este proyecto',
            'max_assignments' => 'Tiene el número máximo de asignaciones',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'id' => 'ID',
        'name' => 'Nombre',
        'user_id' => 'Usuario',
        'role_id' => 'Rol',
        'email' => 'Email',

        'disabled' => 'Desactivado'
    ],

];
