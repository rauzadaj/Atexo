import React from 'react';
import { createRoot } from 'react-dom/client';
import CardGame from './react/controllers/CardGame'; // Assurez-vous que le chemin est correct

const root = createRoot(document.getElementById('card-game')); // Remplacez 'card-game' par l'id de votre conteneur
root.render(
    <React.StrictMode>
        <CardGame />
    </React.StrictMode>
);