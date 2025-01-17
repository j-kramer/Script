export interface Book {
    id: string;
    title: string;
    author_id: number;
    cover_path: string;
}

export interface NewBook {
    title: string;
    author_id: number;
    cover?: File;
}
