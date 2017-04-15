import axios from 'axios';

let api = axios.create({
  baseURL: '/api/',
  timeout: 1000,
});

export default api;
