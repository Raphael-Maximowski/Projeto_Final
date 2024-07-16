import axios from "axios";
import store from '../store/index.js';

const HttpService = axios.create({
  baseURL: "http://localhost:8000/api/",
  headers: {
    "Content-type": "application/json",
  },
});


// Realizando login
export const login = async(data) => {
    const response = await HttpService.post('login', data);
    return response;
}

// Registrando
export const SendUser = async (user) => {
    const response = await HttpService.post('register', user);
    return response;
};

// Enviando Email Novo Password
export const ResetPassword = async(data) => {
    const response = await HttpService.post('forget_password', data);
    return response;
  }

  // Trocando senha no Banco

  export const SendPassword = async(data) => {
      const response = await HttpService.post('reset_password', data);
      return response;
  }

  export const GetUser = async() => {
    const token = store.getters.user_token
    const headers = {
        Authorization: `Bearer ${token}`
    }
  const response = await HttpService.get('user', { headers });
  return response;
  }

  export const SendCollection = async(data) => {
      const token = store.getters.user_token
      const headers = {
          Authorization: `Bearer ${token}`
      }
    const response = await HttpService.post('collections',data, {headers});
      return response;
  }

  export const GetCollection = async(data) => {
    const token = store.getters.user_token;
    console.log(token)
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const response = await HttpService.get('collections', {headers});
    return response;
}

export const UpdateCollection = async(data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const id =  data.id;
    console.log('id:', id);
    const url = `collections/${id}`;
    const response = await HttpService.put(url, data, {headers});
    return response;
}

export const DeleteCollection = async(data) => {
    const token = store.getters.user_token;
    const id =  data.id;
    const headers = {
        Authorization: `Bearer ${token}`}
    const url = `collections/${id}`;
    const response = await HttpService.delete(url, {headers})
    return response;
}

export const SendFunnel = async(data)=> {
    const response = await HttpService.post('funnels', data)
}
export default HttpService;


