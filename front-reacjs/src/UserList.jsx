// src/UserList.js
import React, { useState, useEffect } from 'react';
import { format } from 'date-fns';
import './UserList.css';

const UserList = ({ showAlert }) => {
  const [users, setUsers] = useState([]);

  useEffect(() => {
    // Ao montar o componente, faça a chamada à API para buscar usuários
    fetch('http://localhost/estudo/balancetes/back-lumen/public/usuarios')
      .then(response => response.json())
      .then(data => setUsers(data));
  }, []);

  const handleEdit = userId => {
    // Implemente a lógica para redirecionar para a página de edição com o ID do usuário
    console.log(`Editar usuário com ID ${userId}`);
  };

  const handleDelete = async (userId) => {
    console.log(`Excluir usuário com ID ${userId}`);
    fetch(`http://localhost/estudo/balancetes/back-lumen/public/usuarios/${userId}`, {
      method: 'DELETE',
    })
      .then(response => response.json())
      .then(data => {
        //console.log(data);
        setUsers(users.filter(user => user.id !== userId));
        showAlert(data.mensagem, data.sucesso);
      })
      .catch(error => {
        //console.error('Erro ao excluir usuário:', error);
        showAlert(data.mensagem, data.sucesso);
      });
  };

  const formatDateTime = datetime => {
    return format(new Date(datetime), 'dd/MM/yyyy HH:mm:ss');
  };

  return (
    <div className="mt-4">
      <h1 className="mb-4">Lista de Usuários</h1>
      <table className="table">
        <thead>
          <tr>
            <th>Data de Criação</th>
            <th>Usuário</th>
            <th>Nome</th>
            <th>Ações</th>
          </tr>
        </thead>
        <tbody>
          {users.map((user) => (
            <tr key={user.id}>
              <td>{formatDateTime(user.created_at)}</td>
              <td>{user.usuario}</td>
              <td>{user.nome}</td>
              <td>
                <button className="btn btn-primary me-2" onClick={() => handleEdit(user.id)}>Editar</button>
                <button className="btn btn-danger" onClick={() => handleDelete(user.id)}>Excluir</button>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default UserList;
