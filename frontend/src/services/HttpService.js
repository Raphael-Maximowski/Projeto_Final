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
    const user = store.getters.logged_in;
    console.log(user)
    const headers = {
        Authorization: `Bearer ${user.token}`
    }
  const response = await HttpService.get('user', { headers });
  return response;
  }

  export const SendCollection = async(data) => {
      const user = store.getters.logged_in;
      console.log(user)
      const headers = {
          Authorization: `Bearer ${user.token}`
      }
    const response = await HttpService.post('collection',data, {headers});
      return response;
  }

  export const GetCollection = async(data) => {
    const user = store.getters.logged_in;
    console.log(user)
    const headers = {
        Authorization: `Bearer ${user.token}`
    }
    const response = await HttpService.post('collections', data);
      return response;
}

export const UpdateCollection = async(data) => {
    const user = store.getters.logged_in;
    console.log(user)
    const headers = {
        Authorization: `Bearer ${user.token}`}
    const response = await HttpService.patch('collections', data);
    return response;
}

export const DeleteCollection = async(data) => {
    const user = store.getters.logged_in;
    console.log(user)
    const headers = {
        Authorization: `Bearer ${user.token}`}
    const response = await HttpService.post('collectionsd', data)
    return response;
}
export default HttpService;


