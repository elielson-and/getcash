import { defineStore } from "pinia";

// import axios from "../axios";

export const useMainStore = defineStore("mainStore", {
    state: () => ({
        obj: 10
    }),
    getters: {
        csrfStatus: (state) => state.csrfConnectionStatus,
    },
    actions: {
        teste() {
            console.log()
        }

    },
});