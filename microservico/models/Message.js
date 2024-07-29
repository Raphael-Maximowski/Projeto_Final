// models/Message.js
export default (sequelize, DataTypes) => {
    return sequelize.define('Message', {
      text: {
        type: DataTypes.TEXT,
        allowNull: false,
      },
      room: {
        type: DataTypes.STRING,
        allowNull: false,
      },
      username: {
        type: DataTypes.STRING,
        allowNull: false,
      },
      created_at: {
        type: DataTypes.DATE,
      }
    }, {
      timestamps: false,
      tableName: 'messages'
    });
  };
  