import type { Metadata } from 'next';
import pool from "@/lib/db";
import "@/styles/learning-sessions.css";

async function getLearningSessions() {
  const query = `
    SELECT id, type_enseignement, titre, pasteur, date_enseignement, image_url, media_url
    FROM enseignements
    ORDER BY date_enseignement DESC;
  `;

  try {
    const res = await pool.query(query);
    // Retourne un tableau de tous les enseignements
    return res.rows;
  } catch {
    console.log("Erreur lors de la récupération des enseignements");
    return [];
  }
}

type SessionProps = {
  id: number;
  type: string;
  title: string;
  preacher: string;
  date: string;
  image: string;
  url: string;
};

export default async function Enseignements() {

  const response = await getLearningSessions();
  let enseignements: SessionProps[] = [];

  if (!response || response.length == 0) {
    enseignements = [];
  } else {
    response.forEach((session) => {
      enseignements.push({
        id: session.id,
        type: session.type_enseignement,
        title: session.title,
        preacher: session.pasteur,
        date: new Date(session.date_enseignement).toLocaleDateString("fr-FR"),
        image: session.image_url,
        url: session.media_url
      });
    });
  }

  return (
    <main>
      <div className="enseignements-container">
        <h2 className="enseignements-title">Nos Enseignements</h2>
        <p className="enseignements-description">
          Écoutez et regardez les enseignements pour grandir dans la foi.
        </p>
        <div className="teachings-list">
          {enseignements.map(enseignement => (
            <div key={enseignement.id} className="teaching-card">
              <div className="teaching-image-container">
                <img src={enseignement.image} alt={enseignement.title} className="teaching-image" />
              </div>
              <div className="teaching-card-content">
                <h3 className="teaching-card-title">{enseignement.title}</h3>
                <p className="teaching-card-preacher">Par {enseignement.preacher}</p>
                <p className="teaching-card-date">{enseignement.date}</p>
                <div className="teaching-buttons">
                  <a href={enseignement.url} className="ios-text-button listen-button">
                    {enseignement.type === 'audio' ? '▶ Écouter' : '▶ Regarder'}
                  </a>
                  <a href={enseignement.url} download className="ios-text-button download-button">
                    ⬇ Télécharger
                  </a>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </main>
  );
}

export const metadata: Metadata = {
  title: "Enseignements bibliques • Église méthodiste du Togo",
};
