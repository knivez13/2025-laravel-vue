import axios from 'axios';
import router from '@/router';
import { useAuthStore } from '@/stores/useAuthStore.js';

import Resource from '@/api/resource.js';

const service = axios.create({
    baseURL: '/',
    timeout: 60000, // Request timeout
    withCredentials: true,
    xsrfCookieName: 'XSRF-TOKEN',
    xsrfHeaderName: 'X-XSRF-TOKEN',
    headers: {
        'Content-type': 'application/json',
        Accept: 'application/json'
    }
});

service.interceptors.request.use(
    (config) => {
        const authStore = useAuthStore();
        if (authStore.get_token) {
            let token = authStore.get_token;
            if (token) {
                config.headers['Authorization'] = 'Bearer ' + token; // Set JWT token
            }
        }
        return config;
    },
    (error) => {
        console.log(error); // for debug
        return Promise.reject(error);
    }
);

service.interceptors.response.use(
    (response) => {
        try {
            JSON.parse(JSON.stringify(response.data));
        } catch (error) {
            return Promise.reject(new Error('Invalid JSON response'));
        }
        return response;
    },
    (err) => {
        const authStore = useAuthStore();

        const api = new Resource('');

        const error = {
            status: err.response?.status,
            original: err.response?.data?.data ?? err.response?.data?.message,
            validation: {},
            message: null
        };

        if (err.response?.data == undefined) {
            return Promise.reject(error);
        }

        const encrypt_error = err.response?.data?.data ?? err.response?.data?.message;
        // console.log(api.decrypt(err.response.data.data));

        switch (err.response?.status) {
            case 422:
                for (let field in encrypt_error) {
                    error.validation[field] = encrypt_error[field][0];
                }
                break;

            case 403:
                error.message = "You're not allowed to do that.";
                break;
            case 401:
                error.message = encrypt_error.data == 'Wrong Username or Password' ? 'Wrong Username or Password' : 'Please re-login.';
                authStore.clear();
                router.push('/');
                break;
            case 500:
                error.message = 'Something went really bad. Sorry.';
                break;
            default:
                error.message = 'Something went wrong. Please try again later.';
        }

        return Promise.reject(error);
    }
);

export default service;
