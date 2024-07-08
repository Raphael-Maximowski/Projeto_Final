import axios from "axios";



const HttpService = axios.create({
  baseURL: "http://localhost:8000/api/",
  headers: {
    "Content-type": "application/json",
  },
});

export const login = async(data) => {
  try {
    const response = await HttpService.post('login', data);
    return response;
  } catch (error) {
    console.log('Login Invalido');
  }
}

export const SendUser = async (user) => {
  try {
    const response = await HttpService.post('register', user);
    console.log(response.data);
    return response;
  } catch (error) {
    console.error('Erro ao enviar usuário:', error.response ? error.response.data : error.message);
  }
};

export const SendEmail = async(user) => {
  try {
    const response = await HttpService.post('email/verify', user);
    return response;
  } catch (error) {
    console.error('Erro ao enviar usuário:', error.response ? error.response.data : error.message);
  }
    
}


///////

export const ResetPassword = async(data) => {
  try {
    const response = await HttpService.post('forget_password', data);
    console.log(response.data);
    return response;
  } catch (error) {
    console.error('Erro');
  }
  }


//forget_password
export default HttpService;


