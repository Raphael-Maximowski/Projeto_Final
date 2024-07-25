export default (sequelize, DataTypes) => {
  return sequelize.define('users', {
    name: {
      type: DataTypes.STRING,
      allowNull: false,
    },
    email: {
      type: DataTypes.STRING,
      allowNull: false,
      unique: true,
    },
    created_at: {
      type: DataTypes.DATE,
    }
  }, {timestamps: false});
};