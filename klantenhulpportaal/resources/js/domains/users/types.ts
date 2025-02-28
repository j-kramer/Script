export interface User {
    id: number;
    firstName: string;
    lastName: string;
    isAdmin: boolean;
    email?: string;
    phonenumber?: string;

    readonly fullName: string;
}
