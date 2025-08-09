import { lienSite } from "@/lib/db-utils";
import { MetadataRoute } from "next";

export default function robots(): MetadataRoute.Robots {
  return {
    rules: {
      allow: "/",
      userAgent: "*",
    },
    host: lienSite,
    sitemap: lienSite + "/sitemap.xml",
  };
}
