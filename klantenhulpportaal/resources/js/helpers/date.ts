export const beautifyDate = (input: string | Date) => {
    if (!input) return '';
    const date = new Date(input);

    const formattedDate = new Intl.DateTimeFormat('nl-NL', {
        day: '2-digit',
        month: 'short',
        year: 'numeric',
    }).format(date);

    return formattedDate;
};
