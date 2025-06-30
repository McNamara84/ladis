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

    'accepted' => 'Das Feld :attribute muss angenommen werden.',
    'accepted_if' => 'Das Feld :attribute muss angenommen werden, wenn :other den Wert :value hat.',
    'active_url' => 'Das Feld :attribute muss eine gültige URL sein.',
    'after' => 'Das Feld :attribute muss ein Datum nach :date sein.',
    'after_or_equal' => 'Das Feld :attribute muss ein Datum nach oder gleich :date sein.',
    'alpha' => 'Das Feld darf nur Buchstaben enthalten.',
    'alpha_dash' => 'Das Feld :attribute darf nur Buchstaben, Ziffern, Binde- und Unterstriche enthalten.',
    'alpha_num' => 'Das Feld :attribute darf nur Buchstaben und Ziffern enthalten.',
    'any_of' => 'Das Feld :attribute ist ungültig.',
    'array' => 'Das Feld :attribute muss ein Array sein.',
    'ascii' => 'Das Feld :attribute darf nur ein Byte große alphanumerische Zeichen und Symbole enthalten.',
    'before' => 'Das Feld :attribute muss ein Datum vor :date sein.',
    'before_or_equal' => 'Das Feld :attribute muss ein Datum vor oder gleich :date sein.',
    'between' => [
        'array' => 'Das Feld :attribute muss zwischen :min und :max Elemente haben.',
        'file' => 'Das Feld :attribute muss zwischen :min und :max Kilobytes groß sein.',
        'numeric' => 'Das Feld :attribute muss zwischen :min und :max betragen.',
        'string' => 'Das Feld :attribute muss zwischen :min und :max Zeichen haben.',
    ],
    'boolean' => 'Das Feld :attribute muss den Wert Wahr (True) oder Falsch (False) haben.',
    'can' => 'Das Feld :attribute enthält einen unerlaubten Wert.',
    'confirmed' => 'Die Bestätigung des Felds :attribute stimmt nicht überein.',
    'contains' => 'Das Feld :attribute enthält nicht einen benötigten Wert.',
    'current_password' => 'Das Passwort ist inkorrekt.',
    'date' => 'Das Feld :attribute muss ein gültiges Datum sein.',
    'date_equals' => 'Das Feld :attribute muss ein Datum gleich :date sein.',
    'date_format' => 'Das Feld :attribute muss dem Format :format entsprechen.',
    'decimal' => 'Das Feld :attribute muss :decimal Dezimalstellen haben.',
    'declined' => 'Das Feld :attribute muss abgelehnt werden.',
    'declined_if' => 'Das Feld :attribute muss abgelehnt werden, wenn :other den Wert :value hat.',
    'different' => 'Das Feld :attribute und :other müssen unterschiedlich sein.',
    'digits' => 'Das Feld :attribute muss :digits Ziffern haben.',
    'digits_between' => 'Das Feld :attribute muss zwischen :min und :max Ziffern haben.',
    'dimensions' => 'Das Feld :attribute hat ungültige Bildmaßen.',
    'distinct' => 'Das Feld :attribute enthält einen doppelten Wert.',
    'doesnt_end_with' => 'Das Feld :attribute darf nicht mit einem der folgenden Werte enden: :values.',
    'doesnt_start_with' => 'Das Feld :attribute darf nicht mit einem der folgenden Werte beginnen: :values.',
    'email' => 'Das Feld :attribute muss eine gültige E-Mail-Adresse sein.',
    'ends_with' => 'Das Feld :attribute muss mit einem der folgenden Werte enden: :values.',
    'enum' => 'Das ausgewählte Feld :attribute ist ungültig.',
    'exists' => 'Das ausgewählte Feld :attribute ist ungültig.',
    'extensions' => 'Das Feld :attribute muss eines der folgenden Erweiterungen (Extensions) haben: :values.',
    'file' => 'Das Feld :attribute muss eine Datei sein.',
    'filled' => 'Das Feld :attribute muss einen Wert haben.',
    'gt' => [
        'array' => 'Das Feld :attribute muss mehr als :value Elemente haben.',
        'file' => 'Das Feld :attribute muss größer als :value Kilobyte sein.',
        'numeric' => 'Das Feld :attribute muss größer als :value sein.',
        'string' => 'Das Feld :attribute muss mehr als :value Zeichen haben.',
    ],
    'gte' => [
        'array' => 'Das Feld :attribute muss :value Elemente oder mehr haben.',
        'file' => 'Das Feld :attribute muss größer als oder gleich :value Kilobytes sein.',
        'numeric' => 'Das Feld :attribute muss größer als oder gleich :value sein.',
        'string' => 'Das Feld :attribute muss mehr als oder gleich :value Zeichen haben.',
    ],
    'hex_color' => 'Das Feld :attribute muss eine gültige hexadezimale Farbe sein.',
    'image' => 'Das Feld :attribute muss eine Bilddatei sein.',
    'in' => 'Das ausgewählte Feld :attribute ist ungültig.',
    'in_array' => 'Das Feld :attribute muss in :other existieren.',
    'in_array_keys' => 'Das Feld :attribute muss mindestens einen der folgenden Schlüssel (Keys) enthalten: :values.',
    'integer' => 'Das Feld :attribute muss eine Ganzzahl (Integer) sein.',
    'ip' => 'Das Feld :attribute muss eine gültige IP-Adresse sein.',
    'ipv4' => 'Das Feld :attribute muss eine gültige IPv4-Adresse sein.',
    'ipv6' => 'Das Feld :attribute muss eine gültige IPv6-Adresse sein.',
    'json' => 'Das Feld :attribute muss eine gültige JSON-Zeichenkette sein.',
    'list' => 'Das Feld :attribute muss eine Liste sein.',
    'lowercase' => 'Das Feld :attribute muss in Kleinbuchstaben geschrieben sein.',
    'lt' => [
        'array' => 'Das Feld :attribute muss weniger als :value Einheiten haben.',
        'file' => 'Das Feld :attribute muss weniger als :value Kilobytes groß sein.',
        'numeric' => 'Das Feld :attribute muss kleiner als :value sein.',
        'string' => 'Das Feld :attribute muss weniger als :value Zeichen haben.',
    ],
    'lte' => [
        'array' => 'Das Feld :attribute darf nicht mehr als :value Einheiten haben.',
        'file' => 'Das Feld :attribute muss kleiner als oder gleich :value Kilobytes groß sein.',
        'numeric' => 'Das Feld :attribute muss kleiner als oder gleich :value sein.',
        'string' => 'Das Feld :attribute muss weniger als oder gleich :value Zeichen haben.',
    ],
    'mac_address' => 'Das Feld :attribute muss eine gültige MAC-Adresse sein.',
    'max' => [
        'array' => 'Das Feld :attribute darf nicht mehr als :max Einheiten haben.',
        'file' => 'Das Feld :attribute darf nicht größer als :max Kilobytes sein.',
        'numeric' => 'Das Feld :attribute darf nicht größer als :max sein.',
        'string' => 'Das Feld :attribute darf nicht mehr als :max Zeichen haben.',
    ],
    'max_digits' => 'Das Feld :attribute darf nicht mehr als :max Zeichen haben.',
    'mimes' => 'Das Feld :attribute muss eine der folgenden Dateitypen sein: :values.',
    'mimetypes' => 'Das Feld :attribute muss folgender Dateityp sein: :values.',
    'min' => [
        'array' => 'Das Feld :attribute muss wenigstens :min Einheiten haben.',
        'file' => 'Das Feld :attribute muss wenigstens :min Kilobytes groß sein.',
        'numeric' => 'Das Feld :attribute muss wenigstens :min sein.',
        'string' => 'Das Feld :attribute muss wenigstens :min Zeichen haben.',
    ],
    'min_digits' => 'Das Feld :attribute muss wenigstens :min Ziffern haben.',
    'missing' => 'Das Feld :attribute muss fehlen.',
    'missing_if' => 'Das Feld :attribute muss fehlen, wenn :other den Wert :value hat.',
    'missing_unless' => 'Das Feld :attribute muss fehlen, außer :other hat den Wert :value.',
    'missing_with' => 'Das Feld :attribute muss fehlen, wenn :values verfügbar ist.',
    'missing_with_all' => 'Das Feld :attribute muss fehlen, wenn :values verfügbar sind.',
    'multiple_of' => 'Das Feld :attribute muss ein Vielfaches von :value sein.',
    'not_in' => 'Das ausgewählte Feld :attribute ist ungültig.',
    'not_regex' => 'Das Format des Felds :attribute ist ungültig.',
    'numeric' => 'Das Feld :attribute muss eine Ziffer sein.',
    'password' => [
        'letters' => 'Das Feld :attribute muss wenigstens einen Buchstaben enthalten.',
        'mixed' => 'Das Feld :attribute muss wenigstens einen Groß- und einen Kleinbuchstaben enthalten.',
        'numbers' => 'Das Feld :attribute muss wenigstens eine Ziffer enthalten.',
        'symbols' => 'Das Feld :attribute muss wenigstens ein Symbol enthalten.',
        'uncompromised' => 'Angabe :attribute ist in einem Datenleck aufgetreten. Bitte eine andere Angabe :attribute wählen.',
    ],
    'present' => 'Das Feld :attribute muss verfügbar sein.',
    'present_if' => 'Das Feld :attribute muss verfügbar sein, wenn :other den Wert :value hat.',
    'present_unless' => 'Das Feld :attribute muss verfügbar sein, außer :other hat den Wert :value.',
    'present_with' => 'Das Feld :attribute muss verfügbar sein, wenn :values verfügbar ist.',
    'present_with_all' => 'Das Feld :attribute muss verfügbar sein, wenn :values verfügbar sind.',
    'prohibited' => 'Das Feld :attribute wird verwehrt.',
    'prohibited_if' => 'Das Feld :attribute wird verwehrt, wenn :other den Wert :value hat.',
    'prohibited_if_accepted' => 'Das Feld :attribute wird verwehrt, wenn :other angenommen wird.',
    'prohibited_if_declined' => 'Das Feld :attribute wird verwehrt, wenn :other abgelehnt wird.',
    'prohibited_unless' => 'Das Feld :attribute wird verwehrt, außer :other findet sich in :values.',
    'prohibits' => 'Das Feld :attribute verwehrt :other verfügbar zu sein.',
    'regex' => 'Das Format des Felds :attribute ist ungültig.',
    'required' => 'Das Feld :attribute wird benötigt.',
    'required_array_keys' => 'Das Feld :attribute muss Einträge enthalten für: :values.',
    'required_if' => 'Das Feld :attribute wird benötigt, wenn :other den Wert :value hat.',
    'required_if_accepted' => 'Das Feld :attribute wird benötigt, wenn :other angenommen wird.',
    'required_if_declined' => 'Das Feld :attribute wird benötigt, wenn :other abgelehnt wird.',
    'required_unless' => 'Das Feld :attribute wird benötigt, außer :other findet sich in :values.',
    'required_with' => 'Das Feld :attribute wird benötigt, wenn :values verfügbar ist.',
    'required_with_all' => 'Das Feld :attribute wird benötigt, wenn :values verfügbar sind.',
    'required_without' => 'Das Feld :attribute wird benötigt, wenn :values nicht verfügbar ist.',
    'required_without_all' => 'Das Feld :attribute wird benötigt, wenn nichts von :values nicht verfügbar ist',
    'same' => 'Das Feld :attribute muss :other gleichen.',
    'size' => [
        'array' => 'Das Feld :attribute muss :size Einheiten enthalten.',
        'file' => 'Das Feld :attribute muss :size Kilobytes groß sein.',
        'numeric' => 'Das Feld :attribute muss :size sein.',
        'string' => 'Das Feld :attribute muss :size Zeichen haben.',
    ],
    'starts_with' => 'Das Feld :attribute muss mit einem der folgenden Werte beginnen: :values.',
    'string' => 'Das Feld :attribute muss eine Zeichenkette (String) sein.',
    'timezone' => 'Das Feld :attribute muss eine gültige Zeitzone sein.',
    'unique' => 'Das Feld :attribute wird bereits benutzt.',
    'uploaded' => 'Das Feld :attribute konnte nicht hochgeladen werden.',
    'uppercase' => 'Das Feld :attribute muss in Großbuchstaben geschrieben sein.',
    'url' => 'Das Feld :attribute muss eine gültige URL sein.',
    'ulid' => 'Das Feld :attribute muss eine gültige ULID sein.',
    'uuid' => 'Das Feld :attribute muss eine gültige UUID sein.',

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
