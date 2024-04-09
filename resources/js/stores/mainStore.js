import { defineStore } from "pinia";
import { useStorage } from "@vueuse/core";
// import axios from "../axios";

export const useMainStore = defineStore("mainStore", {
    state: () => ({
        clientDocStatus: useStorage("_cds", 0),
    }),
    getters: {
        csrfStatus: (state) => state.csrfConnectionStatus,
    },
    actions: {
        async getClientDocStatus(status) {
            try {
                const response = await axios.get('/api/get-document-status');
                this.clientDocStatus = response.data;
                console.log(response.data);
            } catch (error) {
                console.error('Erro ao buscar dados:', error);
            }

        },
        setClientDocStatus(status) {
            this.clientDocStatus = status;
        }

    },
});