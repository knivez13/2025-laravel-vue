import request from '@/utils/request';
import CryptoJS from 'crypto-js';

class Resource {
    constructor(uri) {
        this.uri = uri;
    }

    // Fetch CSRF token
    csrf() {
        return request({
            url: 'sanctum/csrf-cookie',
            method: 'get'
        });
    }

    // User login
    login(resource) {
        return request({
            url: 'api/login',
            method: 'post',
            data: { encrypt: this.encrypt(resource) }
        });
    }

    // User registration
    register(resource) {
        return request({
            url: 'api/registration',
            method: 'post',
            data: { encrypt: this.encrypt(resource) }
        });
    }

    // User logout
    logout() {
        return request({
            url: 'api/logout',
            method: 'get'
        });
    }

    // Fetch a list of resources with query parameters
    list(resource) {
        return request({
            url: `api/${this.uri}`,
            method: 'get',
            params: { encrypt: this.encrypt(resource) }
        });
    }

    // Fetch a single resource by ID
    get(id) {
        return request({
            url: `api/${this.uri}/${id}`,
            method: 'get'
        });
    }

    // Create a new resource
    store(resource) {
        return request({
            url: `api/${this.uri}`,
            method: 'post',
            data: { encrypt: this.encrypt(resource) }
        });
    }

    // Update an existing resource by ID
    update(id, resource) {
        return request({
            url: `api/${this.uri}/${id}`,
            method: 'put',
            data: { encrypt: this.encrypt(resource) }
        });
    }

    // Delete a resource by ID
    destroy(id) {
        return request({
            url: `api/${this.uri}/${id}`,
            method: 'delete'
        });
    }

    // Encrypt a resource
    encrypt(resource) {
        const key = CryptoJS.lib.WordArray.random(16).toString(CryptoJS.enc.Hex);
        const iv = CryptoJS.enc.Utf8.parse(key.substring(0, 16));
        const encrypted = CryptoJS.AES.encrypt(JSON.stringify(resource), CryptoJS.enc.Utf8.parse(key), {
            iv,
            mode: CryptoJS.mode.CBC,
            padding: CryptoJS.pad.Pkcs7
        }).toString();
        return encrypted + key;
    }

    // Decrypt a resource
    // decrypt(resource) {
    //     const key = resource.slice(-32);
    //     const encryptedData = resource.slice(0, resource.length - 32);
    //     const iv = CryptoJS.enc.Utf8.parse(key.substring(0, 16));
    //     const decrypted = CryptoJS.AES.decrypt(encryptedData, CryptoJS.enc.Utf8.parse(key), {
    //         iv,
    //         mode: CryptoJS.mode.CBC,
    //         padding: CryptoJS.pad.Pkcs7
    //     });
    //     return JSON.parse(CryptoJS.enc.Utf8.stringify(decrypted));
    // }
    decrypt(resource) {
        if (!resource || typeof resource !== 'string') {
            console.error('Invalid resource:', resource);
            return null;
        }

        const key = resource.slice(-32);
        const encryptedData = resource.slice(0, resource.length - 32);
        const iv = CryptoJS.enc.Utf8.parse(key.substring(0, 16));
        const decrypted = CryptoJS.AES.decrypt(encryptedData, CryptoJS.enc.Utf8.parse(key), {
            iv,
            mode: CryptoJS.mode.CBC,
            padding: CryptoJS.pad.Pkcs7
        });

        try {
            return JSON.parse(CryptoJS.enc.Utf8.stringify(decrypted));
        } catch (e) {
            console.error('Decryption failed:', e);
            return null;
        }
    }
}

export default Resource;
