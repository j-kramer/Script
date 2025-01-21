export interface Book {
    id: string;
    title: string;
    author_id: string;
    cover_path: string;
}

export interface NewBook {
    title: string;
    author_id: string;
    cover?: File;
}
