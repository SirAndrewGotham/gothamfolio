<?php

declare(strict_types=1);

return [
    'accepted'             => ':Attribute դաշտը պետք է ընդունվի։',
    'accepted_if'          => 'Այս դաշտը պետք է ընդունվի երբ :other համապատասխանում է :value։',
    'active_url'           => ':Attribute դաշտը վավեր URL չէ։',
    'after'                => ':Attribute դաշտի ամսաթիվը պետք է լինի :date-ից հետո։',
    'after_or_equal'       => ':Attribute դաշտի ամսաթիվը պետք է լինի :date կամ դրանից հետո։',
    'alpha'                => ':Attribute դաշտը պետք է պարունակի միայն տառեր։',
    'alpha_dash'           => ':Attribute դաշտը պետք է պարունակի միայն տառեր, թվեր, գծիկներ և ընդգծումներ։',
    'alpha_num'            => ':Attribute դաշտը պետք է պարունակի միայն տառեր և թվեր։',
    'array'                => ':Attribute դաշտը պետք է լինի զանգված։',
    'ascii'                => ':Attribute-ը պետք է պարունակի միայն մեկ բայթանոց տառային թվային նիշեր և նշաններ:',
    'before'               => ':Attribute դաշտի ամսաթիվը պետք է լինի :date-ից առաջ։',
    'before_or_equal'      => ':Attribute դաշտի ամսաթիվը պետք է լինի :date կամ դրանից առաջ։',
    'between'              => [
        'array'   => ':Attribute դաշտում էլեմենտների քանակը պետք է լինի :min-ի և :max-ի միջև։',
        'file'    => ':Attribute դաշտի ֆայլի չափը պետք է լինի :min և :max կիլոբայթի միջև։',
        'numeric' => ':Attribute դաշտը պետք է լինի :min և :max թվերի միջև։',
        'string'  => ':Attribute դաշտը պետք է ունենա :min-ից :max նիշ։',
    ],
    'boolean'              => ':Attribute դաշտի արժեքը պետք է լինի ճշմարիտ կամ կեղծ։',
    'can'                  => ':Attribute դաշտը պարունակում է չթույլատրված արժեք:',
    'confirmed'            => ':Attribute դաշտը չի համապատասխանում հաստատմանը։',
    'contains'             => 'The :attribute field is missing a required value.',
    'current_password'     => 'Այս դաշտը պարունակում է անվավեր գաղտնաբառ։',
    'date'                 => ':Attribute դաշտը վավեր ամսաթիվ չէ։',
    'date_equals'          => ':Attribute դաշտի ամսաթիվը պետք է լինի :date։',
    'date_format'          => ':Attribute դաշտը չի համապատասխանում :format ձևաչափին։',
    'decimal'              => ':Attribute-ը պետք է ունենա :decimal տասնորդական տեղ:',
    'declined'             => ':Attribute-ը պետք է մերժվի:',
    'declined_if'          => ':Attribute-ը պետք է մերժվի, երբ :other-ը :value է:',
    'different'            => ':Attribute և :other դաշտերը պետք է լինեն տարբեր։',
    'digits'               => ':Attribute դաշտի թվանշանների քանակը պետք է լինի :digits։',
    'digits_between'       => ':Attribute դաշտի թվանշանների քանակը պետք է լինի :min-ից :max։',
    'dimensions'           => ':Attribute դաշտը ունի անվավեր նկարի չափեր։',
    'distinct'             => ':Attribute դաշտը ունի կրկնվող արժեք։',
    'doesnt_end_with'      => ':Attribute-ը չի կարող ավարտվել հետևյալներից որևէ մեկով. :values:',
    'doesnt_start_with'    => ':Attribute-ը չի կարող սկսվել հետևյալներից որևէ մեկով՝ :values։',
    'email'                => ':Attribute դաշտը պետք է լինի վավերական Էլ․ հասցե։',
    'ends_with'            => ':Attribute դաշտը պետք է ավարտվի հետևյալ արժեքներից մեկով․ :values։',
    'enum'                 => 'Ընտրված :attribute-ն անվավեր է:',
    'exists'               => ':Attribute դաշտի ընտրված արժեքն անվավեր է։',
    'extensions'           => ':attribute դաշտը պետք է ունենա հետևյալ ընդլայնումներից մեկը՝ :values։',
    'file'                 => ':Attribute-ը պետք է լինի ֆայլ։',
    'filled'               => ':Attribute դաշտը պետք է անպայման ունենա արժեք։',
    'gt'                   => [
        'array'   => ':Attribute դաշտում էլեմենտների քանակը պետք է լինի :value-ից մեծ։',
        'file'    => ':Attribute դաշտի ֆայլի չափը պետք է լինի :value կիլոբայթից մեծ։',
        'numeric' => ':Attribute դաշտը պետք է լինի :value-ից մեծ։',
        'string'  => ':Attribute դաշտի նիշերի քանակը պետք է գերազանցի :value-ը։',
    ],
    'gte'                  => [
        'array'   => ':Attribute դաշտում էլեմենտների քանակը պետք է մեծ կամ հավասար լինի :value-ից։',
        'file'    => ':Attribute դաշտի ֆայլի չափը պետք է մեծ կամ հավասար լինի :value կիլոբայթից։',
        'numeric' => ':Attribute դաշտը պետք է մեծ կամ հավասար լինի :value-ից։',
        'string'  => ':Attribute դաշտի նիշերի քանակը պետք է մեծ կամ հավասար լինի :value-ից։',
    ],
    'hex_color'            => ':attribute դաշտը պետք է լինի վավեր տասնվեցական գույն:',
    'image'                => ':Attribute դաշտը պետք է լինի նկար։',
    'in'                   => ':Attribute դաշտի ընտրված արժեքն անվավեր է։',
    'in_array'             => ':Attribute դաշտը գոյություն չունի :other-ում։',
    'integer'              => ':Attribute դաշտը պետք է լինի ամբողջ թիվ։',
    'ip'                   => ':Attribute դաշտը պետք է լինի վավեր IP հասցե.',
    'ipv4'                 => ':Attribute դաշտը պետք է լինի վավեր IPv4 հասցե։',
    'ipv6'                 => ':Attribute դաշտը պետք է լինի վավեր IPv6 հասցե։',
    'json'                 => ':Attribute դաշտը պետք է լինի վավեր JSON տեքստ։',
    'list'                 => ':attribute դաշտը պետք է լինի ցուցակ:',
    'lowercase'            => ':Attribute-ը պետք է լինի փոքրատառ:',
    'lt'                   => [
        'array'   => ':Attribute դաշտում էլեմենտների քանակը պետք է փոքր լինի :value-ից։',
        'file'    => ':Attribute դաշտի ֆայլի չափը պետք է փոքր լինի :value կիլոբայթից։',
        'numeric' => ':Attribute դաշտը պետք է փոքր լինի :value-ից։',
        'string'  => ':Attribute դաշտը պետք է ունենա :value-ից պակաս նիշեր։',
    ],
    'lte'                  => [
        'array'   => ':Attribute դաշտում էլեմենտների քանակը պետք է փոքր կամ հավասար լինի :value-ից։',
        'file'    => ':Attribute դաշտի ֆայլի չափը պետք է փոքր կամ հավասար լինի :value կիլոբայթից։',
        'numeric' => ':Attribute դաշտը պետք է փոքր կամ հավասար լինի :value-ից։',
        'string'  => ':Attribute դաշտի նիշերի քանակը պետք է փոքր կամ հավասար լինի :value-ից։',
    ],
    'mac_address'          => ':Attribute-ը պետք է լինի վավեր MAC հասցե:',
    'max'                  => [
        'array'   => ':Attribute դաշտում էլեմենտների քանակը չպետք է գերազանցի :max-ը։',
        'file'    => ':Attribute դաշտի ֆայլի չափը չպետք է գերազանցի :max կիլոբայթը։',
        'numeric' => ':Attribute դաշտը չի կարող լինել :max-ից մեծ։',
        'string'  => ':Attribute դաշտի նիշերի քանակը չի կարող լինել :max-ց մեծ։',
    ],
    'max_digits'           => ':Attribute-ը չպետք է ունենա ավելի քան :max թվանշան:',
    'mimes'                => ':Attribute դաշտի ֆայլի տեսակը պետք է լինի հետևյալներից մեկը․ :values։',
    'mimetypes'            => ':Attribute դաշտի ֆայլի տեսակը պետք է լինի հետևյալներից մեկը․ :values։',
    'min'                  => [
        'array'   => ':Attribute դաշտում էլեմենտների քանակը պետք է լինի առնվազն :min։',
        'file'    => ':Attribute դաշտի ֆայլի չափը պետք է լինի առնվազն :min կիլոբայթ։',
        'numeric' => ':Attribute դաշտը պետք է լինի առնվազն :min։',
        'string'  => ':Attribute դաշտի նիշերի քանակը պետք է լինի առնվազն :min։',
    ],
    'min_digits'           => ':Attribute-ը պետք է ունենա առնվազն :min թվանշան:',
    'missing'              => ':Attribute դաշտը պետք է բացակայի։',
    'missing_if'           => ':Attribute դաշտը պետք է բացակայի, երբ :other-ը :value է:',
    'missing_unless'       => ':Attribute դաշտը պետք է բացակայի, եթե :other-ը :value չէ:',
    'missing_with'         => ':Attribute դաշտը պետք է բացակայի, երբ առկա է :values:',
    'missing_with_all'     => ':Attribute դաշտը պետք է բացակայի, երբ առկա է :values:',
    'multiple_of'          => ':Attribute դաշտի արժեքը պետք է լինի բազմապատիկ :value-ին։',
    'not_in'               => ':Attribute դաշտի ընտրված արժեքն անվավեր է։',
    'not_regex'            => ':Attribute դաշտի ձևաչափը սխալ է։',
    'numeric'              => ':Attribute դաշտը պետք է լինի թիվ։',
    'password'             => [
        'letters'       => ':Attribute-ը պետք է պարունակի առնվազն մեկ տառ:',
        'mixed'         => ':Attribute-ը պետք է պարունակի առնվազն մեկ մեծատառ և մեկ փոքրատառ:',
        'numbers'       => ':Attribute-ը պետք է պարունակի առնվազն մեկ թիվ։',
        'symbols'       => ':Attribute-ը պետք է պարունակի առնվազն մեկ նշան:',
        'uncompromised' => 'Տվյալ :attribute-ը հայտնվել է տվյալների արտահոսքի մեջ։ Խնդրում ենք ընտրել մեկ այլ :attribute:',
    ],
    'present'              => ':Attribute դաշտը պետք է առկա լինի։',
    'present_if'           => ':attribute դաշտը պետք է լինի, երբ :other-ը :value է:',
    'present_unless'       => ':attribute դաշտը պետք է լինի, եթե :other-ը :value չէ:',
    'present_with'         => ':attribute դաշտը պետք է ներկա լինի, երբ առկա է :values:',
    'present_with_all'     => ':attribute դաշտը պետք է ներկա լինի, երբ առկա է :values:',
    'prohibited'           => ':Attribute դաշտը արգելված է։',
    'prohibited_if'        => ':Attribute դաշտը արգելված է երբ :other դաշտի արժեքը :value է։',
    'prohibited_unless'    => ':Attribute դաշտը արգելված է քանի դեռ :other դաշտի արժեքը :values միջակայքում չի։',
    'prohibits'            => ':Attribute դաշտն արգելում է :other-ին ներկա գտնվել։',
    'regex'                => ':Attribute դաշտի ձևաչափը սխալ է։',
    'required'             => ':Attribute դաշտը պարտադիր է։',
    'required_array_keys'  => ':Attribute դաշտը պետք է պարունակի գրառումներ՝ :values-ի համար:',
    'required_if'          => ':Attribute դաշտը պարտադիր է երբ :other-ը հավասար է :value։',
    'required_if_accepted' => ':Attribute դաշտը պարտադիր է, երբ ընդունվում է :other:',
    'required_if_declined' => 'The :attribute field is required when :other is declined.',
    'required_unless'      => ':Attribute դաշտը պարտադիր է քանի դեռ :other-ը հավասար չէ :values։',
    'required_with'        => ':Attribute դաշտը պարտադիր է երբ :values արժեքն առկա է։',
    'required_with_all'    => ':Attribute դաշտը պարտադիր է երբ :values արժեքները առկա են։',
    'required_without'     => ':Attribute դաշտը պարտադիր է երբ :values արժեքը նշված չէ։',
    'required_without_all' => ':Attribute դաշտը պարտադիր է երբ :values արժեքներից ոչ մեկը նշված չեն։',
    'same'                 => ':Attribute և :other դաշտերը պետք է համընկնեն։',
    'size'                 => [
        'array'   => ':Attribute դաշտը պետք է պարունակի :size էլեմենտ։',
        'file'    => ':Attribute դաշտում ֆայլի չափը պետք է լինի :size կիլոբայթ։',
        'numeric' => ':Attribute դաշտը պետք է հավասար լինի :size-ի։',
        'string'  => ':Attribute դաշտը պետք է ունենա :size նիշ։',
    ],
    'starts_with'          => ':Attribute դաշտը պետք է սկսվի հետևյալ արժեքներից մեկով․ :values։',
    'string'               => ':Attribute դաշտը պետք է լինի տեքստ։',
    'timezone'             => ':Attribute դաշտը պետք է լինի վավեր ժամային գոտի։',
    'ulid'                 => ':Attribute-ը պետք է լինի վավեր ULID:',
    'unique'               => ':Attribute-ի տվյալ արժեքն արդեն գոյություն ունի։',
    'uploaded'             => ':Attribute-ի վերբեռնումը ձախողվել է։',
    'uppercase'            => ':Attribute-ը պետք է լինի մեծատառ:',
    'url'                  => ':Attribute դաշտի ձևաչափը սխալ է։',
    'uuid'                 => ':Attribute դաշտը պետք է լինի վավեր UUID։',
];
