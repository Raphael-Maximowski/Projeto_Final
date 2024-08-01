
import { io } from 'socket.io-client';

const socket = io('http://localhost:3005', {
    withCredentials: true,
    transports: ['websocket', 'polling']
});

let socketId = null;

socket.on('connect', () => {
    socketId = socket.id;
    console.log('Connected to server:', socketId);
});

const getSocketId = () => socketId;

export default { socket, getSocketId };
