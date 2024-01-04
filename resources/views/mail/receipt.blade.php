@component('mail::message')

# Kvitto från MAILADRESSER

* Kvittonummer: {{ $transaction->created_at->format('Ymd') }}-{{ $transaction->id }}
* Köpare: {{ $transaction->order->first_name }} {{ $transaction->order->last_name }} {{ $transaction->order->postal_address }} {{ $transaction->order->area }} {{ $transaction->order->zip }}
* Säljare: MAILADRESSER Sweden AB, Götgatan 87, 116 62 Stockholm. Org no: 556976-1207
* Datum: {{ $transaction->created_at->format('Y-m-d H:i') }}
* Produkt: {{ $transaction->type == \App\Transaction::TYPE_NIX ? 'Kontrollera telefonnummer mot NIX registret' : 'Adressregister Konsumenter' }}
* Totalpris: {{ $transaction->type == \App\Transaction::TYPE_NIX ? number_format($transaction->order->nixValidationTotal, 2) : number_format($transaction->order->total_to_pay, 2) }}
* Momsbelopp: {{ $transaction->type == \App\Transaction::TYPE_NIX ? number_format($transaction->order->nixValidationVat, 2) : number_format($transaction->order->vat, 2) }}
* Momssats: {{ setting('vat_percent', 24) }}

@lang('Thank you for using our application!')<br><br>
@lang('Regards'),<br>
{{ config('app.name') }}
@endcomponent
