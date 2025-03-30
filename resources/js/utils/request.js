import axios from 'axios';
import router from '@/router';
import { useAuthStore } from '@/stores/useAuthStore.js';

const service = axios.create({
    baseURL: '/',
    timeout: 60000, // Request timeout
    withCredentials: true,
    xsrfCookieName: 'XSRF-TOKEN',
    xsrfHeaderName: 'X-XSRF-TOKEN',
    headers: {
        'Content-Type': 'application/json',
        Accept: 'application/json'
    }
});

// Request Interceptor
service.interceptors.request.use(
    (config) => {
        const authStore = useAuthStore();
        const token = authStore.get_token;

        if (token) {
            config.headers['Authorization'] = `Bearer ${token}`; // Set JWT token
        }

        return config;
    },
    (error) => {
        console.error('Request Error:', error); // Debugging
        return Promise.reject(error);
    }
);

// Response Interceptor
service.interceptors.response.use(
    (response) => {
        console.log('Success Response:', response);
        // Ensure the response data is valid JSON
        try {
            JSON.parse(JSON.stringify(response.data));
        } catch (error) {
            return Promise.reject(new Error('Invalid JSON response'));
        }
        return response;
    },
    (err) => {
        const authStore = useAuthStore();
        const errorResponse = err.response;
        const error = {
            status: errorResponse?.status,
            original: errorResponse?.data?.data || errorResponse?.data?.message,
            validation: {},
            message: null
        };

        if (!errorResponse?.data) {
            return Promise.reject(error);
        }

        const encryptedError = errorResponse?.data?.data || errorResponse?.data?.message;

        // Handle specific HTTP status codes
        switch (errorResponse.status) {
            case 422: // Validation error
                Object.keys(encryptedError).forEach((field) => {
                    error.validation[field] = encryptedError[field][0];
                });
                break;

            case 403: // Forbidden
                error.message = "You're not allowed to do that.";
                break;

            case 401: // Unauthorized
                error.message = encryptedError === 'Wrong Username or Password' ? 'Wrong Username or Password' : 'Please re-login.';
                authStore.clear();
                router.push('/');
                break;

            case 500: // Internal Server Error
                error.message = 'Something went really bad. Sorry.';
                break;

            default: // Other errors
                error.message = 'Something went wrong. Please try again later.';
        }

        return Promise.reject(error);
    }
);

export default service;
