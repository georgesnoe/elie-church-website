import "@/styles/today-event.css";

export default function TodayEvent() {
  // Informations sur l'événement (à remplacer par les données réelles)
  const eventName = "Culte d'adoration et de louange";
  const eventTime = "18h30";
  const eventDescription = "Rejoignez-nous ce soir pour notre événement spécial. Un moment de partage et de communion. Préparez votre cœur à recevoir la parole de Dieu.";
  const advice = "Conseil : Venez avec un esprit d'adoration et n'hésitez pas à inviter un ami ou un membre de votre famille.";

  return (
    <div className="event-page-container">
      <div className="event-card">
        {/* Un petit texte descriptif pour contextualiser l'événement */}
        <p className="card-description">
          {eventDescription}
        </p>
        
        <div className="event-content">
          {/* Section pour l'image */}
          <div className="event-image-container">
            {/* Placeholder d'image - Remplacez par votre image */}
            <div className="event-image-placeholder"></div>
            {/* Coin affichant l'heure */}
            <div className="event-time-badge">
              {eventTime}
            </div>
          </div>
          
          {/* Nom de l'événement */}
          <h2 className="event-title">
            {eventName}
          </h2>
          
          {/* Conseil aux membres */}
          <div className="advice-box">
            <span className="advice-icon">💡</span>
            <p className="advice-text">{advice}</p>
          </div>
        </div>
      </div>
    </div>
  );
}
