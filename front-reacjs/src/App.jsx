import React, { useState } from 'react';
import 'bootstrap/dist/css/bootstrap.min.css';
import UserList from './UserList';

const Alert = ({ message, success, onDismiss }) => {
    return (
        <div className={`alert ${success ? 'alert-success' : 'alert-danger'}`} role="alert" onClick={onDismiss}>
            <div className="d-flex justify-content-center align-items-center">
                {message}
            </div>
        </div>
    );
  };

const App = () => {
  const [alert, setAlert] = useState(null);

  const showAlert = (message, success) => {
    setAlert({ message, success });
  };

    const dismissAlert = () => {
        setAlert(null);
    };    
      
  return (
    <div>
      <header>
        <h1 className="text-center mt-4">Balancetes</h1>
        <nav className="nav justify-content-center">
          <a className="nav-link" href="/usuarios">Usuários</a>
          <a className="nav-link" href="/bancos">Bancos</a>
          <a className="nav-link" href="/categorias">Categorias</a>
          <a className="nav-link" href="/vencimentos">Vencimentos</a>
          <a className="nav-link" href="/faturas">Faturas</a>
          <a className="nav-link" href="/extratos">Extratos</a>
        </nav>
      </header>
      {alert && <Alert message={alert.message} success={alert.success} onDismiss={dismissAlert} />}
      <main>
        <UserList showAlert={showAlert} />
      </main>
    </div>
  );
}

export default App;
