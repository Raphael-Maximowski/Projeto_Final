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

interface RoomUser { //comunicação entre usuários 
  socket_id: string,
  username: string,
  room: string
}

const users: RoomUser[] = [] // aray de usuários para armazenar 

io.on('connection', (socket) => {
  console.log('a user connected');

  socket.join(data.room) //"joga" o user para uma sala

  const userInRoom = users.find(user => user.username === data.username && user.room === data.room)
  if(userInRoom) {
    userInRoom.socket_id = socket.id //se ja existir so altera o socketid, se não ai sim coloca o user na sala
  }else{
    users.push({
      room: data.room,
      username: data.username,
      socket_id: socket.id
      }) // ao selecionar uma "sala" ja salva as infos dentro do array ali na parte de cima
  }
});

const socket = io(); //chat

//é necessário as informações de quais são os usuários conectados e qual "sala"
const urlSearch = new URLSearchParams(window.location.search); // consegue ter acesso as informações que estão vindo na url
const username = urlSearch.get('username');
const room = urlSearch.get("select_user") //aqui ela passa a sala que os usuários vão se comunicar, porém coloquei como "select_user" pq a comunicação vai ser apenas entre dois usuários, talvez possamos usar algo similar para criar grupos

//emits 
socket.emit("select_user", {
  username,
  room,
}); //nome do evento que ele vai emitir (não existe um evento padrão podemos criar quais a gente quiser) nesse caso aqui eu to enviando qual a "sala" que ta concetando esses dois users

document.getElementById("message_input").addEventListener("keypress", (event) => {
  if(event.key === 'Enter'){
    const message = event.target.value;

    const data = {
      room,
      message,
      username
    }

    socket.emit("message", data);

    event.target.value = ""; //esse aqui so limpa o campo depois de digiar e enviar
  }
})//input de quando uma pessoa digta a mensagem e da enter a mensagem é enviada usei "message_id" como id mas podemos mudar de acordo com o front


//recebendo infos (on)
socket.on("select_user", data => {
  console.log(data);
});

socket.on("message", data => {
  //salvar  as mensagens 

  //Enviar para o usuário da sala
})
//window.location.search - Serve para pegar o q tem depois da / no url e consultar essas infos



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