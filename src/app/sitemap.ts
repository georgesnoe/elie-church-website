import { lienSite } from "@/lib/db-utils";

export default async function sitemap() {
  return [
    {
      url: lienSite,
      lastModified: new Date(),
    },
    {
      url: lienSite + "/histoire",
      lastModified: new Date(),
    },
    {
      url: lienSite + "/activites",
      lastModified: new Date(),
    },
    {
      url: lienSite + "/enseignements",
      lastModified: new Date(),
    },
  ];
}
