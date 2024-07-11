import axios from "axios";

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
  try {
    const response = await HttpService.post('register', user);
    console.log(response.data);
    return response;
  } catch (error) {
    console.error('Erro ao enviar usuário:', error.response ? error.response.data : error.message);
  }
};

// Enviando Email Novo Password
export const ResetPassword = async(data) => {
    const response = await HttpService.post('forget_password', data);
    return response;
  }

  // Trocando senha no Banco

  export const SendPassword = async(data) => {
    try {
      const response = await HttpService.post('reset_password', data);
      return response;
    } catch (error) {
      console.error('Erro');
    }
  }
export default HttpService;


