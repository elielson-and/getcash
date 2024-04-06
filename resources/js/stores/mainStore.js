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
        setClientDocStatus(status) {
            this.clientDocStatus = status;
        }

    },
});