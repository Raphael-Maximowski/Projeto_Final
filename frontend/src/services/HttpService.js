import axios from "axios";


props: {
  user: Object 
}

const HttpService = axios.create({
  baseURL: "http://localhost:8000/api/",
  headers: {
    "Content-type": "application/json",
  },
});

export const SendUser = async(user) => {

  const response = await HttpService.post('register', user);
  console.log(response.data);
}

export default HttpService;

