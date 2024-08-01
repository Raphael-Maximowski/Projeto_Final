// models/Message.js
export default (sequelize, DataTypes) => {
    return sequelize.define('messages', {
      text: {
        type: DataTypes.TEXT,
        allowNull: false,
      },
      room: {
        type: DataTypes.STRING,
        allowNull: false,
      },
      ID_FIRST: {
        type: DataTypes.STRING,
        allowNull: true,
      },
      ID_SECOND: {
        type: DataTypes.STRING,
        allowNull: true,
      },
      created_at: {
        type: DataTypes.DATE,
      }
    }, {
      timestamps: false,
      tableName: 'messages'
    });
  };
