export interface Review {
    id: string;
    book_id: string;
    comment: string;
}

export interface NewReview {
    book_id: string;
    comment: string;
}
