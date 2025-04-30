const cleaveFields = [
    { id: '#price', options: {} },
    { id: '#cost_meter', options: { prefix: '$ ' } }, // contoh custom config
    { id: '#annual_fees', options: {} },
    { id: '#estimated_rental_income', options: {} }
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