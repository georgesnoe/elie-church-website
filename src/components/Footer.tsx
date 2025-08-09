import Link from 'next/link';
import "@/styles/footer.css";

export default function Footer() {
  // Coordonnées de l'église (à remplacer par les vôtres)
  const address = 'Rue de l\'Église, Tokoin Wuiti';
  const city = 'Lomé, Togo';
  const phone1 = '(+228) 90 00 00 00';
  const phone2 = '(+228) 91 11 11 11';
  const email = 'contact@eglisemethodiste-tokoin.com';

  return (
    <footer className="footer">
      <div className="footer-content">
        {/* Colonne de gauche: Adresse et contacts */}
        <div className="footer-column contact-column">
          <h3 className="column-title">Contactez-nous</h3>
          <div className="contact-info">
            <p className="contact-item">
              <span className="contact-icon">&#x1F4CD;</span>
              {address} <br /> {city}
            </p>
            <p className="contact-item">
              <span className="contact-icon">&#x260E;</span>
              {phone1}
            </p>
            <p className="contact-item">
              <span className="contact-icon">&#x260E;</span>
              {phone2}
            </p>
            <p className="contact-item">
              <span className="contact-icon">&#x2709;</span>
              <Link href={`mailto:${email}`}>{email}</Link>
            </p>
          </div>
        </div>

        {/* Colonne centrale: Logo et nom de l'église */}
        <div className="footer-column text-center">
          <div className="logo-placeholder"></div>
          <p className="footer-church-name">Église méthodiste</p>
          <p className="footer-subtitle">Tokoin Wuiti</p>
        </div>

        {/* Colonne de droite: Google Maps */}
        <div className="footer-column map-column">
          <h3 className="column-title">Nous trouver</h3>
          {/* Correction et rendu de la carte responsive */}
          <div className="map-container">
            <iframe
              src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.094247738202!2d1.216345674981881!3d6.160166293818314!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1021591880f08969%3A0x93e620576378c353!2sEglise%20Methodiste%20Unie%20de%20Tokoin%20Wuiti%2C%20Lom%C3%A9%2C%20Togo!5e0!3m2!1sfr!2sfr!4e0!3m3!1m2!1s0x1021591880f08969%3A0x93e620576378c353!2sEglise%20Methodiste%20Unie%20de%20Tokoin%20Wuiti%2C%20Lom%C3%A9%2C%20Togo!5e0!3m2!1sfr!2sfr!4e0"
              style={{ border: 0 }}
              allowFullScreen
              loading="lazy"
              referrerPolicy="no-referrer-when-downgrade"
            ></iframe>
          </div>
        </div>
      </div>
      <div className="footer-bottom">
        <p>&copy; {new Date().getFullYear()} Église méthodiste de Tokoin Wuiti. Tous droits réservés.</p>
      </div>
    </footer>
  );
}
