// src/services/ChatService.js
import { io } from "socket.io-client";
const socket = io("http://localhost:3005", {
    withCredentials: true,
});

const callback = (a) => {
    console.log(a)
}

const ChatService = {
    joinRoom(room, username, socket_id) {
        socket.emit('select_user', { room, username, socket_id}, callback);
        console.log('Conexão Efetuada sala ')
    },
    Message(data) {
        socket.emit('message', data);
        console.log('Mensagem Enviada')
    },
    onReceiveMessage(callback) {
        socket.on('ReceiveMessage', callback);
    }
}





export default ChatService;
