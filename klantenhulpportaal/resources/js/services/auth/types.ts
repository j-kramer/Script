import type {AxiosError, AxiosRequestConfig, AxiosResponse} from 'axios';
import type {User} from 'domains/users/types';
import type {LocationQueryValue} from 'vue-router';

export type RequestMiddleware = (request: AxiosRequestConfig) => void;
export type ResponseMiddleware = (response: AxiosResponse) => void;
export type ResponseErrorMiddleware = (error: AxiosError) => void;

export type LoggedInUser = User;

export interface LoginCredentials {
    email: string;
    password: string;
    rememberMe: boolean;
}

export interface ResetPasswordData {
    email: LocationQueryValue | LocationQueryValue[];
    password: string;
    password_confirmation: string;
    token: LocationQueryValue | LocationQueryValue[];
}

export interface RegisterData {
    first_name: string;
    last_name: string;
    email: string;
    phone_number: string;
    password: string;
    password_confirmation: string;
}
