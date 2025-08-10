import type { Metadata } from 'next';
import pool from "@/lib/db";
import "@/styles/activity.css";

type ActivityProps = {
  id: number;
  title: string;
  description: string;
  image: string;
  date: string;
};


async function getOldActivities() {
  const query = `
    SELECT id, titre, description, image_url, date_evenement
    FROM activites
    WHERE date_evenement < CURRENT_DATE
    ORDER BY date_evenement DESC;
  `;
  try {
    const res = await pool.query(query);
    // Retourne un tableau d'activités
    return res.rows;
  } catch {
    console.log("Erreur lors de la récupération des activités passées");
    return [];
  }
}

export default async function Activites() {
  const response = await getOldActivities();
  let activites: ActivityProps[] = [];

  if (!response || response.length == 0) {
    activites = [];
  } else {
    response.forEach((activity) => {
      activites.push({
        id: activity.id,
        title: activity.title,
        description: activity.description,
        date: new Date(activity.date_evenement).toLocaleDateString("fr-FR"),
        image: activity.image_url
      });
    });
  }

  return (
    <main>
      <div className="past-activities-container">
        <h2 className="past-activities-title">Nos activités passées</h2>
        <p className="past-activities-description">
          Revivez en photos et en récits les événements marquants de la vie de notre église.
        </p>
        <div className="activities-grid">
          {activites.map(activite => (
            <div key={activite.id} className="activity-card">
              <div className="activity-image-container">
                <img src={activite.image} alt={activite.title} className="activity-image" />
              </div>
              <div className="activity-card-content">
                <span className="activity-date">{activite.date}</span>
                <h3 className="activity-title">{activite.title}</h3>
                <p className="activity-description">{activite.description}</p>
              </div>
            </div>
          ))}
        </div>
      </div>
    </main>
  );
}

export const metadata: Metadata = {
  title: "Activités de l'église • Eglise méthodiste du Togo",
};
