export interface User {
    id: number;
    first_name: string;
    last_name: string;
    is_admin: boolean;
    email?: string;
    phone_number?: string;

    readonly fullName: string;
}
