<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => '• El campo :attribute debe ser aceptado.<br>',
    'active_url' => '• The :attribute is not a valid URL.<br>',
    'after' => '• The :attribute must be a date after :date.<br>',
    'after_or_equal' => '• The :attribute must be a date after or equal to :date.<br>',
    'alpha' => '• The :attribute may only contain letters.<br>',
    'alpha_dash' => '• The :attribute may only contain letters, numbers, dashes and underscores.<br>',
    'alpha_num' => '• The :attribute may only contain letters and numbers.<br>',
    'array' => '• The :attribute must be an array.<br>',
    'before' => '• The :attribute must be a date before :date.<br>',
    'before_or_equal' => '• The :attribute must be a date before or equal to :date.<br>',
    'between' => [
        'numeric' => '• El campo debe estar entre :min y :max. dígitos<br>',
        'file' => '• The :attribute must be between :min and :max kilobytes.<br>',
        'string' => '• El campo debe estar entre :min y :max charácteres.<br>',
        'array' => '• The :attribute must have between :min and :max items.<br>',
    ],
    'boolean' => '• The :attribute field must be true or false.<br>',
    'confirmed' => '• The :attribute confirmation does not match.<br>',
    'date' => '• No es una fecha válida<br>',
    'date_equals' => '• The :attribute must be a date equal to :date.<br>',
    'date_format' => '• The :attribute does not match the format :format.<br>',
    'different' => '• The :attribute and :other must be different.<br>',
    'digits' => '• El campo :attribute debe contener :digits dígito(s).<br>',
    'digits_between' => '• El campo :attribute debe estar entre :min y :max dígitos.<br>',
    'dimensions' => '• The :attribute has invalid image dimensions.<br>',
    'distinct' => '• The :attribute field has a duplicate value.<br>',
    'email' => '• Debe ser un correo válido.<br>',
    'ends_with' => '• The :attribute must end with one of the following: :values.<br>',
    'exists' => '• The selected :attribute is invalid.<br>',
    'file' => '• The :attribute must be a file.<br>',
    'filled' => '• The :attribute field must have a value.<br>',
    'gt' => [
        'numeric' => '• The :attribute must be greater than :value.<br>',
        'file' => '• The :attribute must be greater than :value kilobytes.<br>',
        'string' => '• The :attribute must be greater than :value characters.<br>',
        'array' => '• The :attribute must have more than :value items.<br>',
    ],
    'gte' => [
        'numeric' => '• The :attribute must be greater than or equal :value.<br>',
        'file' => '• The :attribute must be greater than or equal :value kilobytes.<br>',
        'string' => '• The :attribute must be greater than or equal :value characters.<br>',
        'array' => '• The :attribute must have :value items or more.<br>',
    ],
    'image' => '• debe ser una imagen válida<br>',
    'in' => '• Opción no válida<br>',
    'in_array' => '• The :attribute field does not exist in :other.<br>',
    'integer' => '• The :attribute must be an integer.<br>',
    'ip' => '• The :attribute must be a valid IP address.<br>',
    'ipv4' => '• The :attribute must be a valid IPv4 address.<br>',
    'ipv6' => '• The :attribute must be a valid IPv6 address.<br>',
    'json' => '• The :attribute must be a valid JSON string.<br>',
    'lt' => [
        'numeric' => '• The :attribute must be less than :value.<br>',
        'file' => '• The :attribute must be less than :value kilobytes.<br>',
        'string' => '• The :attribute must be less than :value characters.<br>',
        'array' => '• The :attribute must have less than :value items.<br>',
    ],
    'lte' => [
        'numeric' => '• The :attribute must be less than or equal :value.<br>',
        'file' => '• The :attribute must be less than or equal :value kilobytes.<br>',
        'string' => '• The :attribute must be less than or equal :value characters.<br>',
        'array' => '• The :attribute must not have more than :value items.<br>',
    ],
    'max' => [
        'numeric' => '• :attribute no puede ser mayor que :max<br>',
        'file' => '• The :attribute may not be greater than :max kilobytes.<br>',
        'string' => '• The :attribute may not be greater than :max characters.<br>',
        'array' => '• The :attribute may not have more than :max items.<br>',
    ],
    'mimes' => '• :attribute debe ser de tipo: :values.<br>',
    'mimetypes' => '• The :attribute must be a file of type: :values.<br>',
    'min' => [
        'numeric' => '• :attribute debe ser mayor a :min.<br>',
        'file' => '• The :attribute must be at least :min kilobytes.<br>',
        'string' => '• The :attribute must be at least :min characters.<br>',
        'array' => '• The :attribute must have at least :min items.<br>',
    ],
    'not_in' => '• The selected :attribute is invalid.<br>',
    'not_regex' => '• The :attribute format is invalid.<br>',
    'numeric' => '• Debe ser un número<br>',
    'password' => '• La clave es incorrecta<br>',
    'present' => '• The :attribute field must be present.<br>',
    'regex' => '• The :attribute format is invalid.<br>',
    'required' => '• Este campo es obligatorio<br>',
    'required_if' => '• The :attribute field is required when :other is :value.<br>',
    'required_unless' => '• The :attribute field is required unless :other is in :values.<br>',
    'required_with' => '• The :attribute field is required when :values is present.<br>',
    'required_with_all' => '• The :attribute field is required when :values are present.<br>',
    'required_without' => '• The :attribute field is required when :values is not present.<br>',
    'required_without_all' => '• The :attribute field is required when none of :values are present.<br>',
    'same' => '• Confirmación es incorrecta.<br>',
    'size' => [
        'numeric' => '• The :attribute must be :size.<br>',
        'file' => '• The :attribute must be :size kilobytes.<br>',
        'string' => '• The :attribute must be :size characters.<br>',
        'array' => '• The :attribute must contain :size items.<br>',
    ],
    'starts_with' => '• The :attribute must start with one of the following: :values.<br>',
    'string' => '• The :attribute must be a string.<br>',
    'timezone' => '• The :attribute must be a valid zone.<br>',
    'unique' => '• Este valor ya está registrado<br>',
    'uploaded' => '• The :attribute failed to upload.<br>',
    'url' => '• The :attribute format is invalid.<br>',
    'uuid' => '• The :attribute must be a valid UUID.<br>',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => '• custom-message<br>',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
