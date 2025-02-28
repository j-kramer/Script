/**
 * Compare two numbers or strings, to see their sorting order
 * - returns: -1, 0, 1 when respectively a < b, a == b, a > b
 */
export const compare = (a: number | string, b: number | string, reverse = false): -1 | 0 | 1 => {
    if (a < b) return reverse ? 1 : -1;
    if (a > b) return reverse ? -1 : 1;

    return 0;
};

/**
 * Sort the array w.r.t. a key-value
 * - Key can be:
 *   * A field of each item.
 *   * A custom-computed value, obtained via a function.
 * - Does not modify the original.
 * */
export const sortBy = <Item>(array: Item[], key: keyof Item | ((item: Item) => number | string), reverse = false) => {
    const getValue = key instanceof Function ? key : (item: Item) => item[key] as number | string;

    const compareFn = (one: (number | string | Item)[], other: (number | string | Item)[]) =>
        compare(one[0] as number | string, other[0] as number | string, reverse);

    return array
        .map(item => [getValue(item), item])
        .sort(compareFn)
        .map(([, item]) => item) as Item[];
};
