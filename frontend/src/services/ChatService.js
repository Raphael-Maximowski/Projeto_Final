// src/services/ChatService.js
import axios from 'axios';

const ChatService = {
    async createUser(data) {
        try {
            const response = await axios.post('http://localhost:3005/users', data);
            return response.data;
        } catch (error) {
            throw new Error(error.message);
        }
    },
    async getUsers() {
        try {
            const response = await axios.get('http://localhost:3005/users');
            return response.data;
        } catch (error) {
            throw new Error(error.message);
        }
    }
};

export default ChatService;
