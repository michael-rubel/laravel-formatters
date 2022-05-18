### Date formatter
```php
format('date', '2022-10-30 15:00:00', 'Europe/Kiev', 'd-m-Y');
format(DateFormatter::class, now(), 'UTC', 'd-m-Y');
format(DateFormatter::class, [
    'date'        => '2022-07-30 15:00:00',
    'timezone'    => 'UTC',
    'date_format' => 'd-m-Y',
]);
```

### DateTime formatter
```php
format('date-time', now(), 'Europe/Warsaw', 'Y-m-d H:i:s');
format(DateTimeFormatter::class,  now(), 'Europe/Kiev', 'Y-m-d H:i:s');
format(DateTimeFormatter::class, [
    'datetime'        => '2022-07-30 15:00:00',
    'timezone'        => 'UTC',
    'datetime_format' => 'Y-m-d H:i:s',
]);
```

### LocaleNumber formatter

```php
format('locale-number', 10000.50, 'en');
format('locale-number', ['number' => 10000.50, 'locale' => 'pl']);
format(LocaleNumberFormatter::class, 10000.50, 'pl');
```

### MaskString formatter

```php
format('mask-string', 'test@example.com');
format(MaskStringFormatter::class, 'test@example.com');
format(MaskStringFormatter::class, ['string' => 'test@example.com']);
```

### TableColumn formatter

```php
format('table-column', 'created_at');
format('table-column', ['attribute' => 'created_at']);
format(TableColumnFormatter::class, 'updated_at');
```

### TaxNumber formatter

```php
format('tax-number', 'UA0123456789');
format(TaxNumberFormatter::class, '0123456789', 'PL');
format(TaxNumberFormatter::class, [
    'tax_number' => 'UA0123456789',
    'country'    => 'UA',
]);
```