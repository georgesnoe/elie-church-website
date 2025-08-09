export const lienSite = "https://eglise-methodiste.vercel.app";

// Fonction utilitaire pour calculer les dates de début et de fin de la semaine
export function getWeekDates() {
  const today = new Date();
  const day = today.getDay(); // 0 pour Dimanche, 1 pour Lundi, etc.

  // Calcul du lundi de la semaine courante (en considérant Lundi = 1, Dimanche = 7)
  const mondayOffset = day === 0 ? -6 : 1 - day;
  const monday = new Date(today);
  monday.setDate(today.getDate() + mondayOffset);
  monday.setHours(0, 0, 0, 0);

  // Calcul du dimanche de la semaine courante
  const sunday = new Date(monday);
  sunday.setDate(monday.getDate() + 6);
  sunday.setHours(23, 59, 59, 999);

  return { monday, sunday };
}
