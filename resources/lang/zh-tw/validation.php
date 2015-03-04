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

    "accepted"             => "你必須同意 :attribute 。",
    "active_url"           => ":attribute 不是合法的URL。",
    "after"                => ":attribute 中的日期必須在 :date 之後！",
    "alpha"                => ":attribute 中的文字只能有字母(A-Z及a-z)！",
    "alpha_dash"           => ":attribute 中的文字只能有字母(A-Z及a-z)、數字、底線和破折號！",
    "alpha_num"            => ":attribute 中的文字只能有字母(A-Z及a-z)和數字！",
    "array"                => ":attribute 必須為陣列。",
    "before"               => ":attribute 中的日期必須在 :date 之前！",
    "between"              => [
        "numeric" => ":attribute 必須介於 :min 到 :max。",
        "file"    => ":attribute 必須介於 :min 到 :max KB。",
        "string"  => ":attribute 必須介於 :min 到 :max 個字元。",
        "array"   => ":attribute 必須有 :min 到 :max 個物件。",
    ],
    "boolean"              => ":attribute 必須為布林值(True or False)。",
    "confirmed"            => ":attribute 的資料不合法。",
    "date"                 => ":attribute 不是一個合法日期。",
    "date_format"          => ":attribute 必須符合 :format。",
    "different"            => ":attribute 和 :other 必須不同。",
    "digits"               => ":attribute 必須要有 :digits 個數字！",
    "digits_between"       => ":attribute 必須要有 :min 到 :max 個數字！",
    "email"                => ":attribute 必須是合法的電子郵件位址。",
    "filled"               => ":attribute 必須有資料。",
    "exists"               => "選擇的 :attribute 是不合法的。",
    "image"                => ":attribute 必須是圖片。",
    "in"                   => "選擇的 :attribute 是不合法的。",
    "integer"              => "The :attribute must be an integer.",
    "ip"                   => "The :attribute must be a valid IP address.",
    "max"                  => [
        "numeric" => "The :attribute may not be greater than :max.",
        "file"    => "The :attribute may not be greater than :max kilobytes.",
        "string"  => "The :attribute may not be greater than :max characters.",
        "array"   => "The :attribute may not have more than :max items.",
    ],
    "mimes"                => "The :attribute must be a file of type: :values.",
    "min"                  => [
        "numeric" => "The :attribute must be at least :min.",
        "file"    => "The :attribute must be at least :min kilobytes.",
        "string"  => "The :attribute must be at least :min characters.",
        "array"   => "The :attribute must have at least :min items.",
    ],
    "not_in"               => "The selected :attribute is invalid.",
    "numeric"              => "The :attribute must be a number.",
    "regex"                => "The :attribute format is invalid.",
    "required"             => "The :attribute field is required.",
    "required_if"          => "The :attribute field is required when :other is :value.",
    "required_with"        => "The :attribute field is required when :values is present.",
    "required_with_all"    => "The :attribute field is required when :values is present.",
    "required_without"     => "The :attribute field is required when :values is not present.",
    "required_without_all" => "The :attribute field is required when none of :values are present.",
    "same"                 => "The :attribute and :other must match.",
    "size"                 => [
        "numeric" => "The :attribute must be :size.",
        "file"    => "The :attribute must be :size kilobytes.",
        "string"  => "The :attribute must be :size characters.",
        "array"   => "The :attribute must contain :size items.",
    ],
    "unique"               => "The :attribute has already been taken.",
    "url"                  => "The :attribute format is invalid.",
    "timezone"             => "The :attribute must be a valid zone.",

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
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
