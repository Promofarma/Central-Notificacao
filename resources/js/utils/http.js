import axios from "../../../node_modules/axios/dist/axios.js";

const baseUrl = import.meta.env.VITE_API_URL;

export const http = axios.create({
    baseURL: baseUrl + "/api/v1",
    headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
    },
});
