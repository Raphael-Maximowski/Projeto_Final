// models/Message.js
export default (sequelize, DataTypes) => {
    return sequelize.define('rooms', {
        room: {
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
