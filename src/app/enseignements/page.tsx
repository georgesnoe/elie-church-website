import "@/styles/learning-sessions.css";

export default function Enseignements() {

  const enseignements = [
    {
      id: 1,
      type: 'audio',
      title: "La foi qui déplace les montagnes",
      preacher: "Pasteur John Doe",
      date: "05 Août 2025",
      image: "https://images.unsplash.com/photo-1517404215738-15263e9f9178",
      url: "#", // URL de l'audio à remplacer
    },
    {
      id: 2,
      type: 'video',
      title: "Vivre une vie de prière efficace",
      preacher: "Pasteur Jane Smith",
      date: "28 Juillet 2025",
      image: "https://images.unsplash.com/photo-1517404215738-15263e9f9178",
      url: "#", // URL de la vidéo à remplacer
    },
    {
      id: 3,
      type: 'audio',
      title: "La puissance du Saint-Esprit",
      preacher: "Pasteur John Doe",
      date: "14 Juillet 2025",
      image: "https://images.unsplash.com/photo-1517404215738-15263e9f9178",
      url: "#",
    },
    {
      id: 4,
      type: 'video',
      title: "Le pardon et la réconciliation",
      preacher: "Pasteur Jane Smith",
      date: "07 Juillet 2025",
      image: "https://images.unsplash.com/photo-1517404215738-15263e9f9178",
      url: "#",
    },
  ];

  return (
    <main>
      <div className="enseignements-container">
        <h2 className="enseignements-title">Nos Enseignements</h2>
        <p className="enseignements-description">
          Écoutez et regardez les enseignements de nos pasteurs pour grandir dans votre foi.
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
