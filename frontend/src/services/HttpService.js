import axios from "axios";



const HttpService = axios.create({
  baseURL: "http://localhost:8000/api/",
  headers: {
    "Content-type": "application/json",
  },
});

export const SendUser = async (user) => {
  try {
    const response = await HttpService.post('register', user);
    console.log(response.data);
    return response;
  } catch (error) {
    console.error('Erro ao enviar usuário:', error.response ? error.response.data : error.message);
  }
};

export default HttpService;

