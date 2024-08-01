import { createApp } from 'vue'
import App from './App.vue'
import router from './router'
import store from "./store";
import axios from 'axios';
import "bootstrap/dist/css/bootstrap.min.css";
import "bootstrap";
import ChatService from '../src/services/ChatService.js';
import socket from './services/SocketService.js';


const app = createApp(App)
app.config.globalProperties.$chatService = ChatService;
app.config.globalProperties.$socket = socket;


app.use(router)
app.use(store)

app.mount('#app')
