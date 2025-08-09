import pool from "@/lib/db";
import "@/styles/daily-verse.css";


async function getDailyVerse() {
  const query = `
    SELECT source, verset FROM versets
    WHERE date_affichage = CURRENT_DATE;
  `;

  try {
    const response = await pool.query(query);
    return response.rows[0] || null;
  } catch {
    console.log("Une erreur s'est produite lors de la récuperation du verset du jour");
  }
}


export default async function DailyVerse() {

  const response = await getDailyVerse();

  let source, verset;

  if (!response) {
    verset = "Aucun verset n'est programmé pour aujourd'hui.";
    source = "";
  } else {
    verset = response.verset;
    source = response.source;
  }


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
