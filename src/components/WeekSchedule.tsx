import pool from "@/lib/db";
import { getWeekDates } from "@/lib/db-utils";

import EventCard from "@/components/EventCard";
import type EventProps from '@/lib/EventProps';
import "@/styles/week-schedule.css";

async function getWeekSchedule() {
  // 1. Calcul de l'intervalle de la semaine
  const { monday, sunday } = getWeekDates();

  // 2. Définition de la requête SQL avec des paramètres ($1, $2)
  const query = `
    SELECT id, titre, description, image_url, date_evenement, heure_evenement
    FROM activites
    WHERE date_evenement BETWEEN $1 AND $2
    ORDER BY date_evenement ASC, heure_evenement ASC;
  `;
  const values = [monday, sunday];

  try {
    const res = await pool.query(query, values);
    return res.rows;
  } catch {
    console.log("Erreur lors de la récupération du programme de la semaine");
    return [];
  }
};

export default async function WeekSchedule() {
  const response = await getWeekSchedule();
  let evenements: EventProps[] = [];

  if (!response || response.length == 0) {
    evenements = [{
      id: 1,
      title: "Pas d'événement",
      description: "Aucun événement n'est prévu pour aujourd'hui",
      day: '',
      date: '',
      time: '',
      isPast: false,
      imageUrl: ''
    }];
  } else {
    response.forEach((event) => {
      evenements.push({
        id: event.id,
        title: event.title,
        description: event.description,
        day: `${new Date(event.date_evenement).getDay()}`,
        date: `${new Date(event.date_evenement).getDate()}`,
        time: event.time,
        isPast: (Date.now() - new Date(event.date_evenement).getTime()) > 0,
        imageUrl: event.image_url
      });
    })
  }

  return (
    <div className="programme-container">
      <h3 className="programme-title">Programme de la semaine</h3>
      <p className="programme-description">
        Découvrez les événements de la semaine à l&apos;église. Rejoignez-nous pour nos moments de prière, d&apos;enseignement et d&apos;adoration.
      </p>
      <div className="carousel-wrapper">
        <button className="scroll-btn left">
          <span>&larr;</span>
        </button>
        <div className="events-scroll-container" id="scroll-container">
          {evenements.map(event => (
            <EventCard key={event.id} event={event} />
          ))}
        </div>
        <button className="scroll-btn right">
          <span>&rarr;</span>
        </button>
      </div>
      <script>
        {`
          const scrollContainer = document.getElementById("scroll-container");
          function scroll(direction) {
            if (scrollContainer) {
              const scrollAmount = scrollContainer.offsetWidth / 2;
              if (direction === 'left') {
                scrollContainer.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
              } else {
                scrollContainer.scrollBy({ left: scrollAmount, behavior: 'smooth' });
              }
            }
          }
          document.querySelector(".scroll-btn.left").addEventListener("click", () => scroll("left"));
          document.querySelector(".scroll-btn.right").addEventListener("click", () => scroll("right"));
        `}
      </script>
    </div>
  );
}
