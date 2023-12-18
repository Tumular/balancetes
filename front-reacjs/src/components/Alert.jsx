import React from 'react';

const Alert = ({ message, success }) => {
  return (
    <div
      style={{
        padding: '10px',
        marginBottom: '10px',
        backgroundColor: success ? 'green' : 'red',
        color: 'white',
        borderRadius: '5px',
      }}
    >
      {message}
    </div>
  );
};

export default Alert;
