'use client';

import { useRef } from 'react';
import EventCard from "@/components/EventCard";
import type EventProps from '@/lib/EventProps';
import "@/styles/week-schedule.css";

export default function WeekSchedule() { 
  const scrollContainerRef = useRef<HTMLDivElement>(null);

  // Données de la semaine (Exemple) - Remplacez par vos données réelles
  const evenements: EventProps[] = [
    { id: 1, title: 'Culte du dimanche', description: 'Culte d’adoration et de louange', day: 'Dimanche', date: '01', time: '09h30', isPast: true },
    { id: 2, title: 'Étude biblique', description: 'Approfondissement des écritures', day: 'Mardi', date: '03', time: '19h00', isPast: true },
    { id: 3, title: 'Prière communautaire', description: 'Moment de prière pour l’église', day: 'Mercredi', date: '04', time: '18h30', isPast: false },
    { id: 4, title: 'Répétition de la chorale', description: 'Répétition pour la louange', day: 'Jeudi', date: '05', time: '19h00', isPast: false },
    { id: 5, title: 'Veillée de prière', description: 'Nuit de prière et d’intercession', day: 'Vendredi', date: '06', time: '21h00', isPast: false },
    { id: 6, title: 'Visite aux malades', description: 'Action de soutien aux membres', day: 'Samedi', date: '07', time: '10h00', isPast: false },
    { id: 7, title: 'Culte du dimanche', description: 'Culte d’adoration et de louange', day: 'Dimanche', date: '08', time: '09h30', isPast: false },
  ];

  function scroll(direction: string) {
    if (scrollContainerRef.current) {
      const { current } = scrollContainerRef;
      const scrollAmount = current.offsetWidth / 2; // Défilement de la moitié de la largeur
      if (direction === 'left') {
        current.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
      } else {
        current.scrollBy({ left: scrollAmount, behavior: 'smooth' });
      }
    }
  };

  return (
    <div className="programme-container">
      <h3 className="programme-title">Programme de la semaine</h3>
      <p className="programme-description">
        Découvrez les événements de la semaine à l&apos;église. Rejoignez-nous pour nos moments de prière, d&apos;enseignement et d&apos;adoration.
      </p> 
      <div className="carousel-wrapper">
        <button className="scroll-btn left" onClick={() => scroll('left')}>
          <span>&larr;</span>
        </button>
        <div className="events-scroll-container" ref={scrollContainerRef}>
          {evenements.map(event => (
            <EventCard key={event.id} event={event} />
          ))}
        </div>
        <button className="scroll-btn right" onClick={() => scroll('right')}>
          <span>&rarr;</span>
        </button>
      </div>
    </div>
  );
}
