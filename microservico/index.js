import express from 'express';
import { createServer } from 'node:http';
import { Server } from 'socket.io';
import db from './models/index.js';


const app = express();
const server = createServer(app);
const io = new Server(server,  {
  cors: {
    origin: '*',
    methods: ['GET', 'POST']
  }
});

app.use(express.json());
app.use(express.urlencoded({ extended: true }));

//Rotas express
app.get('/', (req, res) => {
  res.json({ message: 'Hello, world!' });
});

app.post('/users', async (req, res) => {
  try {
    const user = await db.User.create({ name: 'John Doe', email: 'john.doe@example.com' });
    res.json(user);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

app.get('/messages/:room'), async (req, res) => {
    const room = req.params.room;
    try {
      const messages = await getMessagesRoom(room);
      res.json(messages);
  }catch {
    res.status(500).json({ error: error.message});
  }
}

// Endpoint para obter todos os usuários
app.get('/users', async (req, res) => {
  try {
    const users = await db.User.findAll();
    res.json(users);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

// Array para armazenar informações dos usuários conectados
const users = [];

// socket.io
io.on('connection', (socket) => {
  console.log('a user connected');

  // Evento quando um usuário seleciona uma sala
  socket.on('select_user', async (data, callback) => {
    socket.join(data.room); // O usuário entra em uma sala específica

    // Verifica se o usuário já está na sala
    const userInRoom = users.find(user => user.username === data.username && user.room === data.room);
    if (userInRoom) {
      userInRoom.socket_id = socket.id; // Atualiza o ID do socket se o usuário já estiver na sala
    } else {
      users.push({
        room: data.room,
        username: data.username,
        socket_id: socket.id
      });
    }

    // Busca as mensagens da sala e chama o callback com as mensagens (é como se salvasse as mensagens pelo q eu entendi)
    const messagesRoom = await getMessagesRoom(data.room);
    callback(messagesRoom);
  });

  //mensagem é enviada
  socket.on('message', async (data) => {
    data = JSON.parse(data)
    // Cria uma nova mensagem no banco de dados
    const message = await db.Message.create({
      text: data.message,
      room: data.room,
      username: data.username,
      created_at: new Date()
    });

    //mensagem para todos os usuários na sala
    io.to(data.room).emit('message', message);
  });
});

// Função para buscar mensagens de uma sala específica
async function getMessagesRoom(room) {
  const messagesRoom = await db.Message.findAll({ where: { room } });
  return messagesRoom; // Retorna as mensagens da sala
}

//Subir servidor
db.sequelize.sync()
  .then(() => {
    server.listen(3005, () => {
      console.log('server running at http://localhost:3005');
    });
  })
  .catch((error) => {
    console.error('Unable to connect to the database:', error);
  });