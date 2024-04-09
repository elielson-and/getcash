import { defineStore } from "pinia";
import { useStorage } from "@vueuse/core";
import { router } from '@inertiajs/vue3'
// import axios from "../axios";

export const useMainStore = defineStore("mainStore", {
    state: () => ({
        clientDocumentation: [],
    }),
    getters: {
        documentation: (state) => state.clientDocumentation,
    },
    actions: {
        async getClientDocStatus() {
            try {
                const response = await axios.get('/get-document-status');
                this.clientDocumentation = response.data;
                console.log(response);

            } catch (error) {
                console.error('Erro ao buscar dados:', error);
            }

        },
        setClientDocStatus(status) {
            this.clientDocStatus = status;
        }
        ,
        isDocumentStatus(statusId) {
            return this.clientDocumentation.document?.status_id === statusId;
        }
    },
});