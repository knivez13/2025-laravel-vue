import { defineStore } from 'pinia';
import Resource from '@/api/resource.js';

const api = new Resource('currency');

export const useLanguage = defineStore('use-language-currency', {
    state: () => ({
        lang_select: null,
        currency_list: [],
        convert: 0,
        language_list: [
            { code: 'en', name: 'English', cname: '英语', ename: 'English', currencyCode: 'USD' },
            { code: 'cy', name: 'Cymraeg', cname: '威尔士语', ename: 'Welsh', currencyCode: 'GBP' },
            { code: 'af', name: 'Afrikaans', cname: '南非语', ename: 'Afrikaans', currencyCode: 'ZAR' },
            { code: 'sq', name: 'Gjuha shqipe', cname: '阿尔巴尼亚语', ename: 'Albanian', currencyCode: 'ALL' },
            { code: 'ar', name: 'العربية', cname: '阿拉伯语', ename: 'Arabic', currencyCode: 'SAR' },
            { code: 'he', name: 'עִברִית', cname: '希伯来语', ename: 'Hebrew', currencyCode: 'ILS' },
            { code: 'hi', name: 'हिंदी', cname: '印地语', ename: 'Hindi', currencyCode: 'INR' },
            { code: 'gu', name: '古吉拉特语', cname: '古吉拉特语', ename: 'Gujarati', currencyCode: 'INR' },
            { code: 'hy', name: 'Հայերեն', cname: '亚美尼亚语', ename: 'Armenian', currencyCode: 'AMD' },
            { code: 'az', name: 'Азәрбајҹан дили', cname: '阿塞拜疆语', ename: 'Azerbaijani', currencyCode: 'AZN' },
            { code: 'eu', name: 'Euskara', cname: '巴斯克语', ename: 'Basque', currencyCode: 'EUR' },
            { code: 'be', name: 'беларуская мова', cname: '白俄罗斯语', ename: 'Belarusian', currencyCode: 'BYN' },
            { code: 'bg', name: 'български език', cname: '保加利亚语', ename: 'Bulgarian', currencyCode: 'BGN' },
            { code: 'ca', name: 'Català', cname: '加泰罗尼亚语', ename: 'Catalan', currencyCode: 'EUR' },
            { code: 'zh-CN', name: '中文 (简体)', cname: '中文 (简体)', ename: 'Chinese (Simplified)', currencyCode: 'CNY' },
            { code: 'zh-TW', name: '中文 (繁体)', cname: '中文 (繁体)', ename: 'Chinese (Traditional)', currencyCode: 'TWD' },
            { code: 'hr', name: 'Српскохрватски језик', cname: '克罗地亚语', ename: 'Croatian', currencyCode: 'HRK' },
            { code: 'cs', name: 'čeština', cname: '捷克语', ename: 'Czech', currencyCode: 'CZK' },
            { code: 'da', name: 'Danmark', cname: '丹麦语', ename: 'Danish', currencyCode: 'DKK' },
            { code: 'nl', name: 'Nederlands', cname: '荷兰语', ename: 'Dutch', currencyCode: 'EUR' },
            { code: 'et', name: 'eesti keel', cname: '爱沙尼亚语', ename: 'Estonian', currencyCode: 'EUR' },
            { code: 'tl', name: 'Filipino', cname: '菲律宾语', ename: 'Filipino', currencyCode: 'PHP' },
            { code: 'fi', name: 'Finnish', cname: '芬兰语', ename: 'Finnish', currencyCode: 'EUR' },
            { code: 'fr', name: 'Français', cname: '法语', ename: 'French', currencyCode: 'EUR' },
            { code: 'de', name: 'Deutsch', cname: '德语', ename: 'German', currencyCode: 'EUR' },
            { code: 'el', name: 'Ελληνικά', cname: '希腊语', ename: 'Greek', currencyCode: 'EUR' },
            { code: 'hu', name: 'magyar', cname: '匈牙利语', ename: 'Hungarian', currencyCode: 'HUF' },
            { code: 'id', name: 'Indonesia', cname: '印度尼西亚语', ename: 'Indonesian', currencyCode: 'IDR' },
            { code: 'ga', name: 'Irish', cname: '爱尔兰语', ename: 'Irish', currencyCode: 'EUR' },
            { code: 'it', name: 'Italiano', cname: '意大利语', ename: 'Italian', currencyCode: 'EUR' },
            { code: 'ja', name: 'にほんご', cname: '日语', ename: 'Japanese', currencyCode: 'JPY' },
            { code: 'ko', name: '한국어', cname: '韩语', ename: 'Korean', currencyCode: 'KRW' },
            { code: 'lt', name: 'lietuvių kalba', cname: '立陶宛语', ename: 'Lithuanian', currencyCode: 'EUR' },
            { code: 'ms', name: 'Melayu', cname: '马来西亚语', ename: 'Malay', currencyCode: 'MYR' },
            { code: 'vi', name: 'Tiếng Việt', cname: '越南语', ename: 'Vietnamese', currencyCode: 'VND' },
            { code: 'no', name: 'norsk', cname: '挪威语', ename: 'Norwegian', currencyCode: 'NOK' },
            { code: 'pl', name: 'Polski', cname: '波兰语', ename: 'Polish', currencyCode: 'PLN' },
            { code: 'pt', name: 'Português', cname: '葡萄牙语', ename: 'Portuguese', currencyCode: 'EUR' },
            { code: 'ro', name: 'limba română', cname: '罗马尼亚语', ename: 'Romanian', currencyCode: 'RON' },
            { code: 'ru', name: 'Русский', cname: '俄语', ename: 'Russian', currencyCode: 'RUB' },
            { code: 'es', name: 'Español', cname: '西班牙语', ename: 'Spanish', currencyCode: 'EUR' },
            { code: 'sv', name: 'Swedish', cname: '瑞典语', ename: 'Swedish', currencyCode: 'SEK' },
            { code: 'th', name: 'ภาษาไทย', cname: '泰语', ename: 'Thai', currencyCode: 'THB' },
            { code: 'tr', name: 'Turkish', cname: '土耳其语', ename: 'Turkish', currencyCode: 'TRY' },
            { code: 'uk', name: 'українська мова', cname: '乌克兰语', ename: 'Ukrainian', currencyCode: 'UAH' }
        ]
    }),
    getters: {
        // get_con_balance: (state) => state.con_balance
    },
    actions: {
        fn_language(id) {
            this.lang_select = this.language_list.filter((i) => {
                return i.code.includes(id);
            });
            this.convert = this.currency_list[this.lang_select[0]['currencyCode'].toLowerCase()];
        },

        set_currency(){

        },

        async fnCurrency() {
            this.error = null;
            this.list = [];
            await api
                .list()
                .then(({ data }) => {
                    this.currency_list = api.decrypt(data?.data);
                })
                .catch((e) => {
                    this.error = e;
                })
                .finally(() => {
                    this.processing = false;
                });
        }
    },
    persist: true
});
