export interface Book {
    id: string;
    title: string;
    cover_path: string;
}

export interface NewBook {
    title: string;
    cover?: File;
}
