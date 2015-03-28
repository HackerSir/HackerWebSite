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
    "integer"              => ":attribute 必須是一個整數！",
    "ip"                   => ":attribute 必須是一個合法的IP位址。",
    "max"                  => [
        "numeric" => ":attribute 不得大於 :max！",
        "file"    => ":attribute 不得大於 :max KB！",
        "string"  => ":attribute 不得大於 :max 個字元！",
        "array"   => ":attribute 不得多於 :max 個物件！",
    ],
    "mimes"                => ":attribute 必須是 :values 格式。",
    "min"                  => [
        "numeric" => ":attribute 至少要有 :min！",
        "file"    => ":attribute 至少要有 :min KB！",
        "string"  => ":attribute 至少要有 :min 個字元！",
        "array"   => ":attribute 至少要有 :min 個物件！",
    ],
    "not_in"               => "選擇的 :attribute 是不合法的。",
    "numeric"              => ":attribute 必須是一個數字！",
    "regex"                => ":attribute 格式不正確。",
    "required"             => "欄位 :attribute 必須有資料。",
    "required_if"          => "當 :other 為 :values 時，:attribute 必須有資料。",
    "required_with"        => "當 :values 時，:attribute 必須有資料。",
    "required_with_all"    => "當 :values 時，:attribute 必須有資料。",
    "required_without"     => "當沒有 :values 時，:attribute 必須有資料。",
    "required_without_all" => "當前沒有任何 :values 時，:attribute 必須有資料。",
    "same"                 => ":attribute 和 :other 必須相同。",
    "size"                 => [
        "numeric" => ":attribute 必須是 :size。",
        "file"    => ":attribute 必須是 :size KB。",
        "string"  => ":attribute 必須有 :size 個字元。",
        "array"   => ":attribute 必須有 :size 個物件。",
    ],
    "unique"               => ":attribute 已被使用。",
    "url"                  => ":attribute 格式不正確。",
    "youtube"                  => ":attribute 必須是Youtube網址。",
    "timezone"             => ":attribute 必須是正確的時區。",

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
