<?php

declare(strict_types=1);

return [
    'accepted'             => 'La :attribute devas esti akceptitaj.',
    'accepted_if'          => 'La :attribute devas esti akceptita kiam :other estas :value.',
    'active_url'           => 'La :attribute ne estas valida URL.',
    'after'                => 'La :attribute devas esti dato post :date.',
    'after_or_equal'       => 'La :attribute devas esti dato post aŭ egala al :date.',
    'alpha'                => 'La :attribute devas enhavi nur literojn.',
    'alpha_dash'           => 'La :attribute devas enhavi nur literojn, ciferojn, streketojn kaj substrekojn.',
    'alpha_num'            => 'La :attribute devas enhavi nur literojn kaj ciferojn.',
    'array'                => 'La :attribute devas esti tabelo.',
    'ascii'                => 'La :attribute-kampo devas enhavi nur unubajtajn alfanombrajn signojn kaj simbolojn.',
    'before'               => 'La :attribute devas esti dato antaŭ :date.',
    'before_or_equal'      => 'La :attribute devas esti dato antaŭ aŭ egala al :date.',
    'between'              => [
        'array'   => 'La :attribute devas havi inter :min kaj :max erojn.',
        'file'    => 'La :attribute devas esti inter :min kaj :max kilobajtoj.',
        'numeric' => 'La :attribute devas esti inter :min kaj :max.',
        'string'  => 'La :attribute devas esti inter :min kaj :max signoj.',
    ],
    'boolean'              => 'La :attribute-kampo devas esti vera aŭ falsa.',
    'can'                  => 'La :attribute-kampo enhavas neaŭtorizitan valoron.',
    'confirmed'            => 'La :attribute-konfirmo ne kongruas.',
    'contains'             => 'The :attribute field is missing a required value.',
    'current_password'     => 'La pasvorto estas malĝusta.',
    'date'                 => 'La :attribute ne estas valida dato.',
    'date_equals'          => 'La :attribute devas esti dato egala al :date.',
    'date_format'          => 'La :attribute ne kongruas kun la formato :format.',
    'decimal'              => 'La :attribute kampo devas havi :decimal decimalojn.',
    'declined'             => 'La :attribute devas esti malakceptita.',
    'declined_if'          => 'La :attribute devas esti malakceptita kiam :other estas :value.',
    'different'            => 'La :attribute kaj :other devas esti malsamaj.',
    'digits'               => 'La :attribute devas esti :digits ciferoj.',
    'digits_between'       => 'La :attribute devas esti inter :min kaj :max ciferoj.',
    'dimensions'           => 'La :attribute havas nevalidajn bildajn dimensiojn.',
    'distinct'             => 'La :attribute-kampo havas duplikatan valoron.',
    'doesnt_end_with'      => 'La :attribute-kampo ne devas finiĝi per unu el la jenaj: :values.',
    'doesnt_start_with'    => 'La :attribute-kampo ne devas komenciĝi per unu el la jenaj: :values.',
    'email'                => 'La :attribute devas esti valida retadreso.',
    'ends_with'            => 'La :attribute devas finiĝi per unu el la jenaj: :values.',
    'enum'                 => 'La elektita :attribute estas malvalida.',
    'exists'               => 'La elektita :attribute estas malvalida.',
    'extensions'           => 'La :attribute-kampo devas havi unu el la sekvaj etendaĵoj: :values.',
    'file'                 => 'La :attribute devas esti dosiero.',
    'filled'               => 'La :attribute-kampo devas havi valoron.',
    'gt'                   => [
        'array'   => 'La :attribute devas havi pli ol :value erojn.',
        'file'    => 'La :attribute devas esti pli granda ol :value kilobajtoj.',
        'numeric' => 'La :attribute devas esti pli granda ol :value.',
        'string'  => 'La :attribute devas esti pli granda ol :value signoj.',
    ],
    'gte'                  => [
        'array'   => 'La :attribute devas havi :value erojn aŭ pli.',
        'file'    => 'La :attribute devas esti pli granda ol aŭ egala al :value kilobajtoj.',
        'numeric' => 'La :attribute devas esti pli granda ol aŭ egala al :value.',
        'string'  => 'La :attribute devas esti pli granda ol aŭ egala al :value signoj.',
    ],
    'hex_color'            => 'La :attribute-kampo devas esti valida deksesuma koloro.',
    'image'                => 'La :attribute devas esti bildo.',
    'in'                   => 'La elektita :attribute estas malvalida.',
    'in_array'             => 'La :attribute kampo ne ekzistas en :other.',
    'integer'              => 'La :attribute devas esti entjero.',
    'ip'                   => 'La :attribute devas esti valida IP-adreso.',
    'ipv4'                 => 'La :attribute devas esti valida IPv4-adreso.',
    'ipv6'                 => 'La :attribute devas esti valida IPv6-adreso.',
    'json'                 => 'La :attribute devas esti valida JSON-ĉeno.',
    'list'                 => 'La :attribute kampo devas esti listo.',
    'lowercase'            => 'La :attribute-kampo devas esti minuskla.',
    'lt'                   => [
        'array'   => 'La :attribute devas havi malpli ol :value erojn.',
        'file'    => 'La :attribute devas esti malpli ol :value kilobajtoj.',
        'numeric' => 'La :attribute devas esti malpli ol :value.',
        'string'  => 'La :attribute devas esti malpli ol :value signoj.',
    ],
    'lte'                  => [
        'array'   => 'La :attribute ne devas havi pli ol :value erojn.',
        'file'    => 'La :attribute devas esti malpli ol aŭ egala al :value kilobajtoj.',
        'numeric' => 'La :attribute devas esti malpli ol aŭ egala al :value.',
        'string'  => 'La :attribute devas esti malpli ol aŭ egala al :value signoj.',
    ],
    'mac_address'          => 'La :attribute devas esti valida MAC-adreso.',
    'max'                  => [
        'array'   => 'La :attribute ne devas havi pli ol :max erojn.',
        'file'    => 'La :attribute ne devas esti pli granda ol :max kilobajtoj.',
        'numeric' => 'La :attribute ne devas esti pli granda ol :max.',
        'string'  => 'La :attribute ne devas esti pli granda ol :max signoj.',
    ],
    'max_digits'           => 'La :attribute-kampo ne devas havi pli ol :max ciferojn.',
    'mimes'                => 'La :attribute devas esti dosiero de tipo: :values.',
    'mimetypes'            => 'La :attribute devas esti dosiero de tipo: :values.',
    'min'                  => [
        'array'   => 'La :attribute devas havi almenaŭ :min erojn.',
        'file'    => 'La :attribute devas esti almenaŭ :min kilobajtoj.',
        'numeric' => 'La :attribute devas esti almenaŭ :min.',
        'string'  => 'La :attribute devas esti almenaŭ :min signoj.',
    ],
    'min_digits'           => 'La :attribute kampo devas havi almenaŭ :min ciferojn.',
    'missing'              => 'La :attribute-kampo devas manki.',
    'missing_if'           => 'La :attribute-kampo devas manki kiam :other estas :value.',
    'missing_unless'       => 'La :attribute-kampo devas manki krom se :other estas :value.',
    'missing_with'         => 'La :attribute-kampo devas manki kiam :values ĉeestas.',
    'missing_with_all'     => 'La :attribute-kampo devas manki kiam :values ĉeestas.',
    'multiple_of'          => 'La :attribute devas esti oblo de :value.',
    'not_in'               => 'La elektita :attribute estas malvalida.',
    'not_regex'            => 'La :attribute-formato estas nevalida.',
    'numeric'              => 'La :attribute devas esti nombro.',
    'password'             => [
        'letters'       => 'La :attribute-kampo devas enhavi almenaŭ unu leteron.',
        'mixed'         => 'La :attribute-kampo devas enhavi almenaŭ unu majusklan kaj unu minusklan literon.',
        'numbers'       => 'La :attribute-kampo devas enhavi almenaŭ unu numeron.',
        'symbols'       => 'La :attribute-kampo devas enhavi almenaŭ unu simbolon.',
        'uncompromised' => 'La donita :attribute aperis en datuma liko. Bonvolu elekti alian :attribute.',
    ],
    'present'              => 'La :attribute-kampo devas ĉeesti.',
    'present_if'           => 'La :attribute-kampo devas ĉeesti kiam :other estas :value.',
    'present_unless'       => 'La :attribute-kampo devas ĉeesti krom se :other estas :value.',
    'present_with'         => 'La :attribute-kampo devas ĉeesti kiam :values ĉeestas.',
    'present_with_all'     => 'La :attribute kampo devas ĉeesti kiam :values ĉeestas.',
    'prohibited'           => 'La :attribute-kampo estas malpermesita.',
    'prohibited_if'        => 'La :attribute-kampo estas malpermesita kiam :other estas :value.',
    'prohibited_unless'    => 'La :attribute-kampo estas malpermesita krom se :other estas en :values.',
    'prohibits'            => 'La :attribute kampo malpermesas :other ĉeesti.',
    'regex'                => 'La :attribute-formato estas nevalida.',
    'required'             => 'La :attribute-kampo estas postulata.',
    'required_array_keys'  => 'La :attribute-kampo devas enhavi enskribojn por: :values.',
    'required_if'          => 'La :attribute-kampo estas postulata kiam :other estas :value.',
    'required_if_accepted' => 'La :attribute-kampo estas postulata kiam :other estas akceptita.',
    'required_if_declined' => 'The :attribute field is required when :other is declined.',
    'required_unless'      => 'La :attribute-kampo estas postulata krom se :other estas en :values.',
    'required_with'        => 'La :attribute-kampo estas postulata kiam :values ĉeestas.',
    'required_with_all'    => 'La :attribute-kampo estas postulata kiam :values ĉeestas.',
    'required_without'     => 'La :attribute-kampo estas postulata kiam :values ne ĉeestas.',
    'required_without_all' => 'La :attribute-kampo estas postulata kiam neniu el :values ĉeestas.',
    'same'                 => 'La :attribute kaj :other devas kongrui.',
    'size'                 => [
        'array'   => 'La :attribute devas enhavi :size erojn.',
        'file'    => 'La :attribute devas esti :size kilobajtoj.',
        'numeric' => 'La :attribute devas esti :size.',
        'string'  => 'La :attribute devas esti :size signoj.',
    ],
    'starts_with'          => 'La :attribute devas komenci per unu el la jenaj: :values.',
    'string'               => 'La :attribute devas esti ŝnuro.',
    'timezone'             => 'La :attribute devas esti valida horzono.',
    'ulid'                 => 'La :attribute-kampo devas esti valida ULID.',
    'unique'               => 'La :attribute jam estis prenita.',
    'uploaded'             => 'La :attribute malsukcesis alŝuti.',
    'uppercase'            => 'La :attribute-kampo devas esti majuskla.',
    'url'                  => 'La :attribute devas esti valida URL.',
    'uuid'                 => 'La :attribute devas esti valida UUID.',
];
