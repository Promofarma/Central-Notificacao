import axios from "../../../node_modules/axios/dist/axios.js";
import { baseUrl } from "./baseUrl.js";

export const http = axios.create({
    baseURL: baseUrl + "/api/v1",
    headers: {
        "Content-Type": "application/json",
        Accept: "application/json",
    },
});
