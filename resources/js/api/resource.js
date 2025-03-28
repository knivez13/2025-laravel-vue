import request from '@/utils/request';
import CryptoJS from 'crypto-js';

class Resource {
    constructor(uri) {
        this.uri = uri;
    }
    csrf() {
        return request({
            url: 'sanctum/csrf-cookie',
            method: 'get'
        });
    }
    login(data) {
        return request({
            url: 'api/login',
            method: 'post',
            data: data
        });
    }
    register(data) {
        return request({
            url: 'api/registration',
            method: 'post',
            data: data
        });
    }
    logout() {
        return request({
            url: 'api/logout',
            method: 'get'
        });
    }
    list(query) {
        return request({
            url: 'api/' + this.uri,
            method: 'get',
            params: query
        });
    }
    get(id) {
        return request({
            url: 'api/' + this.uri + '/' + id,
            method: 'get'
        });
    }
    store(resource) {
        return request({
            url: 'api/' + this.uri,
            method: 'post',
            data: resource
        });
    }
    update(id, resource) {
        return request({
            url: 'api/' + this.uri + '/' + id,
            method: 'put',
            data: resource
        });
    }
    destroy(id) {
        return request({
            url: 'api/' + this.uri + '/' + id,
            method: 'delete'
        });
    }
    destroy2(resource) {
        return request({
            url: 'api/' + this.uri + '/' + resource.id,
            method: 'delete',
            data: resource
        });
    }
    encrypt(resource) {
        // const key = '12345678901234567890123456789012';
        const key = CryptoJS.lib.WordArray.random(16).toString(CryptoJS.enc.Hex);
        return (
            CryptoJS.AES.encrypt(JSON.stringify(resource), CryptoJS.enc.Utf8.parse(key), {
                iv: CryptoJS.enc.Utf8.parse(key.substring(0, 16)),
                mode: CryptoJS.mode.CBC,
                padding: CryptoJS.pad.Pkcs7
            }).toString() + key
        );
    }

    decrypt(resource) {
        const data = resource;
        const key = data.slice(-32);
        return JSON.parse(
            CryptoJS.enc.Utf8.stringify(
                CryptoJS.AES.decrypt(data.slice(0, data.length - 32), CryptoJS.enc.Utf8.parse(key), {
                    iv: CryptoJS.enc.Utf8.parse(key.substring(0, 16)),
                    mode: CryptoJS.mode.CBC,
                    padding: CryptoJS.pad.Pkcs7
                })
            )
        );
    }
}

export { Resource as default };
