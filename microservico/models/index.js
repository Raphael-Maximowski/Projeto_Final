import { Sequelize, DataTypes } from 'sequelize';
import UserModel from './User.js';
import MessageModel from './Message.js';

const sequelize = new Sequelize('codeacademy_laravel_vue', 'root', 'root', {
    host: 'mysql',
    dialect: 'mysql',
});

try {
  await sequelize.authenticate();
  console.log('Connection has been established successfully.');
} catch (error) {
  console.error('Unable to connect to the database:', error);
}

const db = {
  Sequelize,
  sequelize,
  User: UserModel(sequelize, DataTypes),
  Message: MessageModel(sequelize, DataTypes),
};

export default db;
