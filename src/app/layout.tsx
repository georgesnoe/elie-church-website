import type { Metadata } from "next";
import { Geist, Geist_Mono } from "next/font/google";
import "@/styles/globals.css";
import Header from "@/components/Header";
import Footer from "@/components/Footer";

const geistSans = Geist({
  variable: "--font-geist-sans",
  subsets: ["latin"],
});

const geistMono = Geist_Mono({
  variable: "--font-geist-mono",
  subsets: ["latin"],
});

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="fr">
      <body
        className={`${geistSans.variable} ${geistMono.variable} antialiased`}
      >
        <Header />
        {children}
        <Footer />
      </body>
    </html>
  );
}

export const metadata: Metadata = {
  title: "Église méthodiste de Tokoin Wuiti",
  description: "L'église méthodiste de Tokoin Wuiti, un lieu d'adoration, d'enseignement et de communion. Découvrez nos activités, enseignements et l'histoire de notre communauté.",
  keywords: "église, méthodiste, Tokoin, Wuiti, culte, enseignement, verset, bible, foi, prière",
  authors: [{ name: "SOSSOU Mawupénukukpoe" }],
  openGraph: {
    title: "Église méthodiste de Tokoin Wuiti",
    description: "Un lieu d'adoration, d'enseignement et de communion.",
    url: "https://eglise-methodiste.vercel.app",
    siteName: "Église méthodiste de Tokoin Wuiti",
    images: [
      {
        url: "https://eglise-methodiste.vercel.app/opengraph-image.jpg",
        width: 800,
        height: 600,
      },
    ],
    locale: "fr_FR",
    type: "website",
  },
};
