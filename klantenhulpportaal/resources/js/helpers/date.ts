export const beautifyDate = (input: number | string | Date) => {
    if (!input) return '';

    let date;

    /*
     * number is in seconds while the date constructor expects in milliseconds,
     * so convert the input
     */
    // eslint-disable-next-line no-magic-numbers
    if (typeof input === 'number') date = new Date(input * 1000);
    else date = new Date(input);

    const formattedDate = new Intl.DateTimeFormat('nl-NL', {
        day: '2-digit',
        month: 'short',
        year: 'numeric',
    }).format(date);

    return formattedDate;
};
