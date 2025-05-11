const cleaveFields = [
    { id: '#idr_price', options: { prefix: 'IDR ' } },
    { id: '#average_nightly_rate', options: { prefix: 'IDR ' } },
    { id: '#estimated_annual_turnover', options: { prefix: 'IDR ' } },
    { id: '#estimated_commision_idr', options: { prefix: 'IDR ' } },
    { id: '#usd_price', options: {} },
    { id: '#cost_meter', options: { prefix: '$ ' } }, // contoh custom config
    { id: '#annual_fees', options: {} },
    { id: '#estimated_rental_income', options: {} },
];

cleaveFields.forEach(field => {
    new Cleave(field.id, {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand',
        prefix: '$ ',
        noImmediatePrefix: true,
        numeralDecimalMark: '.',
        delimiter: ',',
        ...field.options // spread operator untuk custom config
    });
});
