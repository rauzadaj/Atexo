import React from 'react';

function Card({ card }) {
    const { value, color } = card;

    const colorSymbols = {
        Carreaux: '♦',
        Coeur: '♥',
        Pique: '♠',
        Trèfle: '♣'
    };

    const colorClasses = {
        Carreaux: 'card-diamonds',
        Coeur: 'card-hearts',
        Pique: 'card-spades',
        Trèfle: 'card-clubs'
    };

    return (
        <div className={`card ${colorClasses[color]}`}>
            <div className="card-value">{value} de {colorSymbols[color]}</div>
        </div>
    );
}

export default Card;