import "@/styles/daily-verse.css";

export default function DailyVerse() {
  // Vous pouvez récupérer le verset d'une API ou d'une base de données ici
  const verset = "Car l’Éternel est bon ; Sa bonté dure toujours, Et sa fidélité de génération en génération.";
  const source = "Psaumes 100:5";

  return (
    <div className="verse-page-container">
      <div className="verse-card">
        {/* Le verset */}
        <p className="verse-text">
          &quot;{verset}&quot;
        </p>

        {/* La source */}
        <p className="verse-source">
          — {source}
        </p>
      </div>
    </div>
  );
}
