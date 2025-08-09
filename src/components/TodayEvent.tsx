import pool from "@/lib/db";
import "@/styles/today-event.css";

async function getTodayEvent() {
  const query = `
    SELECT titre, description, image_url, conseil, heure_evenement
    FROM activites
    WHERE date_evenement = CURRENT_DATE
    LIMIT 1;
  `;

  try {
    const response = await pool.query(query);
    return response.rows[0] || null;
  } catch {
    console.log("Une erreur s'est produite lors de la récupération de l'événement de ce soir");
    return null;
  }
}

export default async function TodayEvent() {

  const event = await getTodayEvent();
  let titre, description, conseil, image_url, heure_evenement;

  if (!event) {
    titre = "Pas d'événement";
    description = "Aucun événement n'est prévu pour ce soir.";
    conseil = "";
    image_url = "";
    heure_evenement = "";
  } else {
    titre = event.titre;
    description = event.description;
    conseil = event.conseil;
    image_url = event.image_url;
    heure_evenement = event.heure_evenement;
  }



  return (
    <div className="event-page-container">
      <div className="event-card">
        {/* Un petit texte descriptif pour contextualiser l'événement */}
        <p className="card-description">
          {description}
        </p>

        <div className="event-content">
          {/* Section pour l'image */}
          <div className="event-image-container">
            {/* Placeholder d'image - Remplacez par votre image */}
            {image_url.trim() != "" ? <img src={image_url} alt={titre} /> : <div className="event-image-placeholder"></div>}
            {/* Coin affichant l'heure */}
            <div className="event-time-badge">
              {heure_evenement}
            </div>
          </div>

          {/* Nom de l'événement */}
          <h2 className="event-title">
            {titre}
          </h2>

          {/* Conseil aux membres */}
          <div className="advice-box">
            <span className="advice-icon">💡</span>
            <p className="advice-text">{conseil}</p>
          </div>
        </div>
      </div>
    </div>
  );
}
