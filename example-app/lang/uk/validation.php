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

    'accepted' => 'Поле :attribute повинно бути прийнято.',
    'accepted_if' => 'Поле :attribute повинно бути прийнято, коли :other є :value.',
    'active_url' => 'Поле :attribute повинно бути дійсним URL.',
    'after' => 'Поле :attribute повинно бути датою після :date.',
    'after_or_equal' => 'Поле :attribute повинно бути датою після чи рівною :date.',
    'alpha' => 'Поле :attribute повинно містити лише літери.',
    'alpha_dash' => 'Поле :attribute може містити лише літери, цифри, дефіси та підкреслення.',
    'alpha_num' => 'Поле :attribute може містити лише літери та цифри.',
    'array' => 'Поле :attribute повинно бути масивом.',
    'ascii' => 'Поле :attribute може містити лише однобайтові буквено-цифрові символи та символи.',
    'before' => 'Поле :attribute повинно бути датою до :date.',
    'before_or_equal' => 'Поле :attribute повинно бути датою до чи рівною :date.',
    'between' => [
        'array' => 'Поле :attribute повинно містити від :min до :max елементів.',
        'file' => 'Поле :attribute повинно бути від :min до :max кілобайт.',
        'numeric' => 'Поле :attribute повинно бути від :min до :max.',
        'string' => 'Поле :attribute повинно містити від :min до :max символів.',
    ],
    'boolean' => 'Поле :attribute повинно бути true або false.',
    'can' => 'Поле :attribute містить несанкціоноване значення.',
    'confirmed' => 'Поле :attribute не співпадає з підтвердженням.',
    'current_password' => 'Пароль невірний.',
    'date' => 'Поле :attribute повинно бути дійсною датою.',
    'date_equals' => 'Поле :attribute повинно бути датою, рівною :date.',
    'date_format' => 'Поле :attribute повинно відповідати формату :format.',
    'decimal' => 'Поле :attribute повинно містити :decimal десяткових знаків.',
    'declined' => 'Поле :attribute повинно бути відхилено.',
    'declined_if' => 'Поле :attribute повинно бути відхилено, коли :other є :value.',
    'different' => 'Поля :attribute і :other повинні бути різними.',
    'digits' => 'Поле :attribute повинно містити :digits цифр.',
    'digits_between' => 'Поле :attribute повинно містити від :min до :max цифр.',
    'dimensions' => 'Поле :attribute має неприпустимі розміри зображення.',
    'distinct' => 'Поле :attribute має повторюване значення.',
    'doesnt_end_with' => 'Поле :attribute не повинно закінчуватися одним із наступних: :values.',
    'doesnt_start_with' => 'Поле :attribute не повинно починатися одним із наступних: :values.',
    'email' => 'Поле :attribute повинно бути дійсною адресою електронної пошти.',
    'ends_with' => 'Поле :attribute повинно закінчуватися одним із наступних: :values.',
    'enum' => 'Вибране значення для :attribute недійсне.',
    'exists' => 'Вибране значення для :attribute недійсне.',
    'file' => 'Поле :attribute повинно бути файлом.',
    'filled' => 'Поле :attribute повинно містити значення.',
    'gt' => [
        'array' => 'Поле :attribute повинно містити більше :value елементів.',
        'file' => 'Поле :attribute повинно бути більше :value кілобайт.',
        'numeric' => 'Поле :attribute повинно бути більше :value.',
        'string' => 'Поле :attribute повинно бути більше :value символів.',
    ],
    'gte' => [
        'array' => 'Поле :attribute повинно містити :value елементів або більше.',
        'file' => 'Поле :attribute повинно бути більше або рівне :value кілобайт.',
        'numeric' => 'Поле :attribute повинно бути більше або рівне :value.',
        'string' => 'Поле :attribute повинно бути більше або рівне :value символів.',
    ],
    'image' => 'Поле :attribute повинно бути зображенням.',
    'in' => 'Вибране значення для :attribute недійсне.',
    'in_array' => 'Поле :attribute повинно існувати в :other.',
    'integer' => 'Поле :attribute повинно бути цілим числом.',
    'ip' => 'Поле :attribute повинно бути дійсною IP-адресою.',
    'ipv4' => 'Поле :attribute повинно бути дійсною IPv4-адресою.',
    'ipv6' => 'Поле :attribute повинно бути дійсною IPv6-адресою.',
    'json' => 'Поле :attribute повинно бути дійсним JSON-рядком.',
    'lowercase' => 'Поле :attribute повинно бути у нижньому регістрі.',
    'lt' => [
        'array' => 'Поле :attribute повинно містити менше :value елементів.',
        'file' => 'Поле :attribute повинно бути менше :value кілобайт.',
        'numeric' => 'Поле :attribute повинно бути менше :value.',
        'string' => 'Поле :attribute повинно бути менше :value символів.',
    ],
    'lte' => [
        'array' => 'Поле :attribute повинно містити не більше :value елементів.',
        'file' => 'Поле :attribute повинно бути менше або рівне :value кілобайт.',
        'numeric' => 'Поле :attribute повинно бути менше або рівне :value.',
        'string' => 'Поле :attribute повинно бути менше або рівне :value символів.',
    ],
    'mac_address' => 'Поле :attribute повинно бути дійсною MAC-адресою.',
    'max' => [
        'array' => 'Поле :attribute не повинно містити більше :max елементів.',
        'file' => 'Поле :attribute не повинно бути більше :max кілобайт.',
        'numeric' => 'Поле :attribute не повинно бути більше :max.',
        'string' => 'Поле :attribute не повинно бути більше :max символів.',
    ],
    'max_digits' => 'Поле :attribute не повинно містити більше :max цифр.',
    'mimes' => 'Поле :attribute повинно бути файлом одного з типів: :values.',
    'mimetypes' => 'Поле :attribute повинно бути файлом одного з типів: :values.',
    'min' => [
        'array' => 'Поле :attribute повинно містити принаймні :min елементів.',
        'file' => 'Поле :attribute повинно бути принаймні :min кілобайт.',
        'numeric' => 'Поле :attribute повинно бути принаймні :min.',
        'string' => 'Поле :attribute повинно бути принаймні :min символів.',
    ],
    'min_digits' => 'Поле :attribute повинно містити принаймні :min цифр.',
    'missing' => 'Поле :attribute повинно бути відсутнім.',
    'missing_if' => 'Поле :attribute повинно бути відсутнім, коли :other є :value.',
    'missing_unless' => 'Поле :attribute повинно бути відсутнім, якщо :other не знаходиться серед :values.',
    'missing_with' => 'Поле :attribute повинно бути відсутнім, якщо присутній :values.',
    'missing_with_all' => 'Поле :attribute повинно бути відсутнім, якщо присутній хоча б один з :values.',
    'multiple_of' => 'Поле :attribute повинно бути кратним :value.',
    'not_in' => 'Вибране значення для :attribute недійсне.',
    'not_regex' => 'Формат поля :attribute недійсний.',
    'numeric' => 'Поле :attribute повинно бути числом.',
    'password' => [
        'letters' => 'Поле :attribute повинно містити принаймні одну літеру.',
        'mixed' => 'Поле :attribute повинно містити принаймні одну велику та одну малу літеру.',
        'numbers' => 'Поле :attribute повинно містити принаймні одну цифру.',
        'symbols' => 'Поле :attribute повинно містити принаймні один символ.',
        'uncompromised' => 'Зазначений :attribute з\'явився в утечці даних. Будь ласка, виберіть інший :attribute.',
    ],
    'present' => 'Поле :attribute повинно бути присутнім.',
    'prohibited' => 'Поле :attribute заборонено.',
    'prohibited_if' => 'Поле :attribute заборонено, коли :other є :value.',
    'prohibited_unless' => 'Поле :attribute заборонено, якщо :other не знаходиться серед :values.',
    'prohibits' => 'Поле :attribute забороняє присутність :other.',
    'regex' => 'Формат поля :attribute недійсний.',
    'required' => 'Поле :attribute обов\'язкове для заповнення.',
    'required_array_keys' => 'Поле :attribute повинно містити ключі для: :values.',
    'required_if' => 'Поле :attribute обов\'язкове, коли :other є :value.',
    'required_if_accepted' => 'Поле :attribute обов\'язкове, коли :other прийняте.',
    'required_unless' => 'Поле :attribute обов\'язкове, якщо :other не знаходиться серед :values.',
    'required_with' => 'Поле :attribute обов\'язкове, коли присутній :values.',
    'required_with_all' => 'Поле :attribute обов\'язкове, коли присутні всі :values.',
    'required_without' => 'Поле :attribute обов\'язкове, коли відсутній :values.',
    'required_without_all' => 'Поле :attribute обов\'язкове, коли відсутні всі :values.',
    'same' => 'Поле :attribute повинно співпадати з :other.',
    'size' => [
        'array' => 'Поле :attribute повинно містити :size елементів.',
        'file' => 'Поле :attribute повинно бути розміром :size кілобайт.',
        'numeric' => 'Поле :attribute повинно бути розміром :size.',
        'string' => 'Поле :attribute повинно бути розміром :size символів.',
    ],
    'starts_with' => 'Поле :attribute повинно починатися одним із наступних: :values.',
    'string' => 'Поле :attribute повинно бути рядком.',
    'timezone' => 'Поле :attribute повинно бути дійсним часовим поясом.',
    'unique' => 'Поле :attribute вже існує.',
    'uploaded' => 'Не вдалося завантажити файл :attribute.',
    'uppercase' => 'Поле :attribute повинно бути великими літерами.',
    'url' => 'Поле :attribute повинно бути дійсним URL.',
    'ulid' => 'Поле :attribute повинно бути дійсним ULID.',
    'uuid' => 'Поле :attribute повинно бути дійсним  UUID.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
