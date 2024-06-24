import React from 'react';
import { createRoot } from 'react-dom/client';
import CardGame from './react/controllers/CardGame'; 

const root = createRoot(document.getElementById('card-game')); 
root.render(
    <React.StrictMode>
        <CardGame />
    </React.StrictMode>
);