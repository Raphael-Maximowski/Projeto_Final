import express from 'express';
import { createServer } from 'node:http';
import { Server } from 'socket.io';
import db from './models/index.js';

const app = express();
const server = createServer(app);
const io = new Server(server);

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

// Endpoint para obter todos os usuários
app.get('/users', async (req, res) => {
  try {
    const users = await db.User.findAll();
    res.json(users);
  } catch (error) {
    res.status(500).json({ error: error.message });
  }
});

//socket io
io.on('connection', (socket) => {
  console.log('a user connected');
});

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