import React, { useState, useEffect } from 'react';
import Card from './Card'; // Assurez-vous que le chemin est correct

function CardGame() {
    const [hand, setHand] = useState([]);
    const [sortedHand, setSortedHand] = useState([]);
    const [isLoading, setIsLoading] = useState(false);
    const [error, setError] = useState(null);

    useEffect(() => {
        fetchHand();
    }, []);

    const fetchHand = async () => {
        setIsLoading(true);
        try {
            const response = await fetch('http://127.0.0.1:8000/api/card/draw'); // Chemin vers votre endpoint Symfony
            const data = await response.json();
            setHand(data);
        } catch (error) {
            setError(error.message);
        } finally {
            setIsLoading(false);
        }
    };

    const sortHand = async () => {
        setIsLoading(true);
        try {
            const response = await fetch('http://127.0.0.1:8000/api/card/sort', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(hand),
            });
            const data = await response.json();
            setSortedHand(data);
        } catch (error) {
            setError(error.message);
        } finally {
            setIsLoading(false);
        }
    };

    return (
        <div>
            <h1>Jeu de Cartes</h1>
            <button onClick={fetchHand} disabled={isLoading}>
                Tirer une main
            </button>
            <button onClick={sortHand} disabled={isLoading || hand.length === 0}>
                Trier la main
            </button>

            {isLoading ? (
                <p>Chargement...</p>
            ) : error ? (
                <p>Erreur : {error}</p>
            ) : (
                <>
                    <h2>Main non triée :</h2>
                    <div className="hand">
                        {hand.map((card) => (
                            <React.Fragment key={`${card.value}-${card.color}`}>
                                <Card card={card}/>
                                <br/> {/* Saut de ligne après chaque carte */}
                            </React.Fragment>
                        ))}
                    </div>

                    {sortedHand.length > 0 && (
                        <>
                            <h2>Main triée :</h2>
                            <div className="hand">
                                {sortedHand.map((card) => (
                                    <Card key={`${card.value}-${card.color}`} card={card}/>
                                ))}
                            </div>
                        </>
                    )}
                </>
            )}
        </div>
    );
}

export default CardGame;