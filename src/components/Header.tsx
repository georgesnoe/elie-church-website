'use client';

import { useState } from 'react';
import Link from 'next/link';
import "@/styles/header.css";

export default function Header() {
  const [isMenuOpen, setIsMenuOpen] = useState(false);

  return (
    <header className="header">
      {/* --- Conteneur principal du header --- */}
      <div className="header-content">
        {/* Partie gauche : Logo et texte */}
        <div className="header-left">
          {/* Remplacez ceci par votre composant de logo ou une image */}
          <div className="logo-placeholder"></div>
          <div className="header-text">
            <h1 className="header-title">Église méthodiste</h1>
            <p className="header-subtitle">Tokoin Wuiti</p>
          </div>
        </div>

        {/* Partie droite : Menu de navigation desktop */}
        <nav className="desktop-nav">
          <Link href="/">Accueil</Link>
          <Link href="/activites">Activités</Link>
          <Link href="/enseignements">Enseignements</Link>
          <Link href="/histoire">Histoire de l&apos;église</Link>
        </nav>

        {/* Bouton hamburger pour le mobile */}
        <button className="hamburger-btn" onClick={() => setIsMenuOpen(true)}>
          &#9776;
        </button>
      </div>

      {/* --- Menu mobile qui s'affiche en overlay --- */}
      {isMenuOpen && (
        <div className="mobile-overlay">
          <div className="mobile-menu">
            {/* Bouton pour fermer le menu */}
            <button className="close-btn" onClick={() => setIsMenuOpen(false)}>
              &times;
            </button>
            <nav className="mobile-nav">
              <Link href="/" onClick={() => setIsMenuOpen(false)}>Accueil</Link>
              <Link href="/activites" onClick={() => setIsMenuOpen(false)}>Activités</Link>
              <Link href="/enseignements" onClick={() => setIsMenuOpen(false)}>Enseignements</Link>
              <Link href="/histoire" onClick={() => setIsMenuOpen(false)}>Histoire de l'église</Link>
            </nav>
          </div>
        </div>
      )}
    </header>
  );
}
