// src/services/ChatService.js
import { io } from "socket.io-client";
const socket = io("http://localhost:3005", {
    withCredentials: true,
});

const callback = (a) => {
    console.log('Callback', a )
}

const ChatService = {
    joinRoom(room, username, socket_id, user_id) {
        socket.emit('select_user', { room, username, socket_id, user_id}, callback);
        console.log('Sala Enviada', room)
        console.log('Conexão Efetuada sala ')
    },
    Message(data) {
        socket.emit('message', data);
        console.log('Mensagem Enviada')
    },
    onReceiveMessage(callback) {
        socket.on('ReceiveMessage', callback);
        console.log('Recebi a Mensagem')
    },
}





export default ChatService;
