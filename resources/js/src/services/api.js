import axios from "axios";

const baseURL = document.head.querySelector("[name~=baseUrl][content]").content;

const api = axios.create({
    baseURL: `${baseURL}/api`
});

export default api;
