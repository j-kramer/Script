export class MissingTranslationError extends Error {
    constructor(message: string) {
        // Pass remaining arguments (including vendor specific ones) to parent constructor
        super(message);

        this.name = 'MissingTranslationError';
    }
}
