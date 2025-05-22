import { defineStore } from 'pinia';
import Resource from '@/api/resource.js';
import router from '@/router';
const api = new Resource('currency');

export const useSabongConsoleStore = defineStore('admin-sabong-console', {
    state: () => ({
        token: null,
        game: null,
        bet: null,
        round: null,
        sum: null,
        option: null,
        validation: [],
        processing: false,
        error: null
    }),
    getters: {
        get_token: (state) => state.token
    },
    actions: {
        set_game(data) {
            this.game = api.encrypt(data);
            router.push('/admin/liveGames/sabongConsole');
        },
        async fnShow() {
            const id = api.decrypt(this.game)['id'];
            const api2 = new Resource('admin/sabong/console');
            try {
                await api2.csrf();
                const { data } = await api2.get(id);
                this.bet = api.encrypt(api.decrypt(data?.response_data)['bet']);
                this.round = api.encrypt(api.decrypt(data?.response_data)['round']);
                this.option = api.encrypt(api.decrypt(data?.response_data)['option']);
            } catch (e) {
                this.handleError(e);
            } finally {
                this.processing = false;
            }
        },
        async fnSelectRound(res) {
            const api2 = new Resource('admin/sabong/sabongconsole/selectRound');
            try {
                await api2.csrf();
                const { data } = await api2.store(res);
                this.game = api.encrypt(api.decrypt(data?.response_data)['game']);
                this.round = api.encrypt(api.decrypt(data?.response_data)['round']);
            } catch (e) {
                console.log(e);
            } finally {
                this.processing = false;
            }
        },
        async fnNextRound(res) {
            const api2 = new Resource('admin/sabong/sabongconsole/nextRound');
            try {
                await api2.csrf();
                const { data } = await api2.store(res);
                this.game = api.encrypt(api.decrypt(data?.response_data)['game']);
                this.round = api.encrypt(api.decrypt(data?.response_data)['round']);
            } catch (e) {
                console.log(e);
            } finally {
                this.processing = false;
            }
        },
        async fnOpenRound(res) {
            const api2 = new Resource('admin/sabong/sabongconsole/openRound');
            try {
                await api2.csrf();
                const { data } = await api2.store(res);
                this.game = api.encrypt(api.decrypt(data?.response_data)['game']);
                this.round = api.encrypt(api.decrypt(data?.response_data)['round']);
            } catch (e) {
                console.log(e);
            } finally {
                this.processing = false;
            }
        },
        async fnCloseRound(res) {
            const api2 = new Resource('admin/sabong/sabongconsole/closeRound');
            try {
                await api2.csrf();
                const { data } = await api2.store(res);
                this.game = api.encrypt(api.decrypt(data?.response_data)['game']);
                this.round = api.encrypt(api.decrypt(data?.response_data)['round']);
            } catch (e) {
                console.log(e);
            } finally {
                this.processing = false;
            }
        },
        async fnDeclareRound(res) {
            const api2 = new Resource('admin/sabong/sabongconsole/declareRound');
            try {
                await api2.csrf();
                const { data } = await api2.store(res);
                this.game = api.encrypt(api.decrypt(data?.response_data)['game']);
                this.round = api.encrypt(api.decrypt(data?.response_data)['round']);
            } catch (e) {
                console.log(e);
            } finally {
                this.processing = false;
            }
        },
        async fnCancelRound(res) {
            const api2 = new Resource('admin/sabong/sabongconsole/cancelRound');
            try {
                await api2.csrf();
                const { data } = await api2.store(res);
                this.game = api.encrypt(api.decrypt(data?.response_data)['game']);
                this.round = api.encrypt(api.decrypt(data?.response_data)['round']);
            } catch (e) {
                console.log(e);
            } finally {
                this.processing = false;
            }
        },
        async fnBetRound(res) {
            const api2 = new Resource('admin/sabong/sabongconsole/betRound');
            try {
                await api2.csrf();
                const { data } = await api2.store(res);
                console.log(api.decrypt(data?.response_data));
                this.sum = api.encrypt(api.decrypt(data?.response_data)['bet']);
            } catch (e) {
                console.log(e);
            } finally {
                this.processing = false;
            }
        }
    },
    persist: true
});
