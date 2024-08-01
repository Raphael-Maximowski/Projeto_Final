import express from 'express';
import { createServer } from 'node:http';
import { Server } from 'socket.io';
import db from './models/index.js';
import cors from 'cors';

const app = express();
const server = createServer(app);

// Configuração do CORS
const corsOptions = {
  origin: 'http://localhost:8085', // Substitua pela URL do seu frontend
  methods: ['GET', 'POST'],
  allowedHeaders: ['Content-Type'],
  credentials: true
};

app.use(cors(corsOptions));

const io = new Server(server, {
  cors: {
    origin: 'http://localhost:8085', // Substitua pela URL do seu frontend
    methods: ['GET', 'POST'],
    allowedHeaders: ['Content-Type'],
    credentials: true
  }
});

app.use(express.json());
app.use(express.urlencoded({ extended: true }));


app.get('/messages', async (req, res) => {
  try {
    const message = await db.Message.findAll();
    res.json(message);
  }catch (error) {
    res.status(500).json({ error: error.message });
  }
});

app.get('/messages/:room', async (req, res) => {
    const room = req.params.room;
    try {
      const messages = await getMessagesRoom(room);
      res.json(messages);
  }catch {
    res.status(500).json({ error: error.message});
  }
});


// Array para armazenar informações dos usuários conectados
const users = [];

// socket.io
io.on('connection', (socket) => {
  console.log('a user connected');

  // Evento quando um usuário seleciona uma sala
  socket.on('select_user', async (data, callback) => {
    try {
      socket.join(data.room); // O usuário entra em uma sala específica

      // Verifica se o usuário já está na sala
      const userInRoom = users.find(user => user.username === data.username && user.room === data.room);
      if (userInRoom) {
        userInRoom.socket_id = socket.id; // Atualiza o ID do socket se o usuário já estiver na sala
        console.log('User Joined Room');
      } else {
        users.push({
          room: data.room,
          username: data.username,
          socket_id: socket.id
        });
        console.log('Room Created');
      }

      // Busca as mensagens da sala e chama o callback com as mensagens
      const messagesRoom = await getMessagesRoom(data.room);
      callback(messagesRoom);
    } catch (error) {
      console.error('Error in select_user:', error);
      callback({ error: 'An error occurred' });
    }
  });

  // Evento quando uma mensagem é enviada
  socket.on('message', async (data) => {
    try {
      // Cria uma nova mensagem no banco de dados
      const message = await db.Message.create({
        text: data.text,
        room: data.room,
        ID_FIRST : data.ID_FIRST,
        ID_SECOND : data.ID_SECOND,
        username: data.username,
        created_at: new Date()
      });

      // Emite a mensagem para todos os usuários na sala
      io.to(data.room).emit('ReceiveMessage', message);
    } catch (error) {
      console.error('Error in message:', error);
    }
  });
});

// Função para buscar mensagens de uma sala específica
async function getMessagesRoom(room) {
  const messagesRoom = await db.Message.findAll({ where: { room } });
  return messagesRoom; // Retorna as mensagens da sala
}

// Subir servidor
db.sequelize.sync()
    .then(() => {
      server.listen(3005, () => {
        console.log('server running at http://localhost:3005');
      });
    })
    .catch((error) => {
      console.error('Unable to connect to the database:', error);
    });
