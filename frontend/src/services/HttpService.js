import axios from "axios";
import store from '../store/index.js';

const HttpService = axios.create({
  baseURL: "http://localhost:8000/api/",
  headers: {
    "Content-type": "application/json",
  },
});

export const login = async(data) => {
    const response = await HttpService.post('login', data);
    return response;
}

export const SendUser = async (user) => {
    const response = await HttpService.post('register', user);
    return response;
};

export const ResetPassword = async(data) => {
    const response = await HttpService.post('forget_password', data);
    return response;
  }

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

export const SendFunnel = async (data) => {
    const token =  store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`}
    const response = await HttpService.post('funnels', data, {headers})
}

export const GetFunnel =  async(data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`}
    const collection_id = data.collection_id
    const url = `funnels/collection/${collection_id}`
    const response =  await HttpService.get(url, {headers})
    return response;
}

export const UpdateFunnel = async(data) => {
    const token = store.getters.user_token;
    const id = data.id
    const headers = {
        Authorization: `Bearer ${token}`}
    const url = `funnels/${id}`;
    const response = await HttpService.patch(url, data, {headers})
    return response;
}

export const DeleteFunnel = async(data) => {
    const token = store.getters.user_token;
    const id = data.id
    const headers = {
        Authorization: `Bearer ${token}`}
    const url = `funnels/${id}`;
    const response = await HttpService.delete(url, {headers})
    return response;
}

export const SearchFunnel = async(data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`}
    const response = await HttpService.post('funnels/search', data,{headers})
    return response;
}

export const GetSteps =  async(data) => {
    const token = store.getters.user_token;
    const id =  data.id;
    const headers = {
        Authorization: `Bearer ${token}`}
    const url = `steps/${id}`;
    const response = await HttpService.get(url, {headers})
    return response;
}

export const GetContacts =  async(data) => {
    const token = store.getters.user_token;
    const id =  data.id;
    const headers = {
        Authorization: `Bearer ${token}`}
    const url = `contacts/${id}`;
    const response =  await HttpService.get(url, {headers})
    return response;
}

export const GetOneFunnel = async (data) => {
    const token = store.getters.user_token;
    const id =  data
    const headers = {
        Authorization: `Bearer ${token}`}
    const url = `funnels/${id}`;
    const response = await HttpService.get(url, {headers})
    return response;
}

export const GetOneStep =  async (data) => {
    const token = store.getters.user_token;
    const id = data
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const url = `step/${id}`;
    const response = await HttpService.get(url, {headers})
    return response;
}

export const SendContact = async (data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const response = await HttpService.post('contacts', data,{headers})
    return response;
}

export const Pagination = async (data) => {
    const token = store.getters.user_token;
    const page = data
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const url = `collections/page/${page}`;
    const response = await HttpService.get(url, {headers})
    return response;
}

export const UpdateOwnStep = async (data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const id = data.id
    const url = `contacts/${id}`;
    const response = await HttpService.patch(url , data, {headers})
    return response;
}

export const UpdateOtherStep = async (data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
}

export const SearchContact =  async (data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const response =  await HttpService.post('contacts/search', data, {headers})
    return response;
}

export const DeleteContact = async (data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const id = data
    const url = `contacts/${id}`;
    const response = await HttpService.delete(url, {headers})
    return response;
}

export const UpdateLastStep = async (data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const id = data.id
    const url = `contacts/update-old-step/${id}`;
    const response =  await HttpService.patch(url, data, {headers})
    return response;
}

export const UpdateNewStep = async (data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const id = data.id
    const url = `contacts/update-new-step/${id}`;
    const response =  await HttpService.patch(url, data, {headers})
    return response;
}

export const UpdateInfoContact = async(data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const id = data.id
    const url = `contacts/update-infos/${id}`;
    const response =  await HttpService.patch(url, data, {headers})
    return response;
}

export const UpdateStepPosition = async(data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const id = data.id
    const url = `steps/${id}`;
    const response =  await HttpService.patch(url, data, {headers})
}

export const CreateStep = async(data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const url = `steps`;
    const response =  await HttpService.post(url, data,{headers})
    return response;
}

export const DeleteStep =  async(data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    let id =  data.id
    const url = `steps/${id}`;
    const response =  await HttpService.delete(url, {headers})
    return response
}

export const UpdateStepInfo =  async (data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    let id =  data.id
    const url = `stepedit/${id}`;
    const response =  await HttpService.patch(url, data, {headers})
    return response
}

export const GetListContacts =  async (data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    let id =  data.id
    const url = `contacts/${id}`;
    const response = await HttpService.get(url, {headers})
    return response
}

export const CreateCompany = async (data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const url = `empresas`;
    const response = await HttpService.post(url, data, {headers})
    return response;
}

export const CreateTeam =  async (data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const url =  `teams`
    const response = await HttpService.post(url, data, {headers})
    return response;
}

export const GetUserEmail =  async (data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const url =  `users/search`
    const response = await HttpService.post(url, data, {headers})
    return response;
}

export const SetUser =  async (data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const teamId =  data.team_id
    const url = `teams/${teamId}/add-user`
    const response = await HttpService.post(url, data, {headers})
    return response;
}

export const GetDataTime = async (data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const id = data.id;
    const url = `teams/${id}`
    const response =  await  HttpService.get(url, {headers})
    return response;
}

export const GetCompany = async (data )=> {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const id = data.id;
    const url =  `empresas/${id}`
    const response =  await HttpService.get(url, {headers})
    return response;
}

export const SetTeam =  async (data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const teamId =  data.team_id
    const url = `teams/${teamId}/add-user`
    const response =  await HttpService.post(url, data, {headers})
    window.location.reload();
    return response;
}

export const RemoveTeam =  async (data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const teamId =  data.team_id
    const userId =  data.user_id
    const url = `teams/${teamId}/remove-user/${userId}`
    const response = await HttpService.delete(url, {headers})
    return response
}

export const GetUserProfile =  async (data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const id =  data.id
    const url = `user/${id}`
    const response = await HttpService.get(url, {headers})
    return response;
}

export const GetLogs =  async () => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const url = `logs`
    const response = await HttpService.get(url, {headers})
    return response;
}

export const CreateAdmin = async (data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const email =  data
    const url =  `users/make-admin/${email}`
    const response = await HttpService.put(url, data,{headers})
}

export const GetRoom = async (data) => {
    const token = store.getters.user_token;
    const headers = {
        Authorization: `Bearer ${token}`
    }
    const id  = data
    const url =  `room/${id}`
    const response = await HttpService.get(url, {headers})
    return response
}

export default HttpService;


