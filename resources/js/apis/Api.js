import axios from "axios";

let Api = axios.create({
  baseURL: process.env.VUE_APP_API_ROOT
});

Api.defaults.withCredentials = true;

export default Api;
