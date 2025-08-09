import "@/styles/activity.css";

export default function Activites() {

  const activites = [
    {
      id: 1,
      title: 'Camp d’évangélisation',
      description: 'Un moment de partage et de foi intense qui a permis à de nombreux fidèles de se rapprocher de la parole divine.',
      date: '12-14 Juillet 2025',
      image: 'https://images.unsplash.com/photo-1517404215738-15263e9f9178', // Placeholder, à remplacer
    },
    {
      id: 2,
      title: 'Séminaire sur la famille',
      description: 'Un séminaire inspirant sur les fondations bibliques de la famille et du couple, avec des témoignages forts.',
      date: '22 Juin 2025',
      image: 'https://images.unsplash.com/photo-1490645935378-ab257c161cd0', // Placeholder, à remplacer
    },
    {
      id: 3,
      title: 'Culte de Pâques',
      description: 'Une célébration émouvante de la résurrection, marquée par des chants de louange et un message d’espoir.',
      date: '20 Avril 2025',
      image: 'https://images.unsplash.com/photo-1549420063-42e128669e46', // Placeholder, à remplacer
    },
    {
      id: 4,
      title: 'Concert de la chorale',
      description: 'Un grand concert qui a rassemblé la communauté pour un moment de musique et de célébration.',
      date: '10 Mai 2025',
      image: 'https://images.unsplash.com/photo-1471343729906-8d5f6630f697', // Placeholder, à remplacer
    },
  ];

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
